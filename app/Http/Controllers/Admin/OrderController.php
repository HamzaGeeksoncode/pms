<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTankRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Client;
use App\Models\Tank;
use App\Models\Pump;
use App\Models\Hose;
use App\Models\PetrolStation;
use Gate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Order::select(sprintf('%s.*', (new Order)->table));

            if(isset($request->bid)) {
                $query = $query->where('id', $request->bid);
            }
           
            $query = $query->with('clients',function($q){
                $q->where('station_id',getStationId());
            });

            $table = DataTables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
      
               
                $deleteGate    = 'order_access';
                $crudRoutePart = 'order';

                return view('partials.datatablesActions', compact(
                   
                    
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            $table->editColumn('name', function ($row) {
                // $clientName = Client::where("id",$row->client_id)->first();
                // $name = "<b><i>Client Record Deleted</i></b>";
                // if($clientName){
                //     $name = $clientName->name;
                // }
                return isset($row->clients->name) ? $row->clients->name : "";
            });
            $table->editColumn('petrol_quan', function ($row) {
                return $row->petrol_quan ? $row->petrol_quan : "";
            });
            $table->editColumn('diesel_quan', function ($row) {
                return $row->diesel_quan ? $row->diesel_quan : "";
            });      
            $table->editColumn('date', function ($row) {
                return $row->date ? $row->date : "";
            });                                 
 
            $table->rawColumns([ 'name', 'petrol_quan', 'diesel_quan','date','actions']);

            return $table->make(true);
        }

        return view('admin.orders.index');
    }

    public function create()
    {
        $readingData = Tank::with(["pumps"=>function($q){
            $q->with("hoses");
        }])->where("station_id",getStationId())->get()->toArray();
        $dieselHose=[];
        $petrolHose=[];
        if(!empty($readingData)){
            foreach($readingData as $tank){
                foreach($tank['pumps'] as $pump){
                    foreach($pump['hoses'] as $hose){
                        if($tank['type']=="petrol"){
                            $petrolHose[]=["tank_name"=>$tank["name"] , "pump_name"=>$pump["name"] , "hose_name"=>$hose['name'],"hose_id"=>$hose['id']];
                        }else{
                            $dieselHose[]=["tank_name"=>$tank["name"] , "pump_name"=>$pump["name"] , "hose_name"=>$hose['name'],"hose_id"=>$hose['id']];                            
                        }
                    }
                }
            }
        }
        $data['dieselHose'] = $dieselHose;
        $data['petrolHose'] = $petrolHose;
        // abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');        
        $data['clients']=Client::select("id","name")->where("station_id",getStationId())->get()->toArray();
        $data['price'] = getPrice();
        return view('admin.orders.create')->with($data);
    }
    private function checkLimit($request){

        $client = Client::where("id",$request->input("client_id"))->first();

        if(!$client) { return false; }

        if(!is_null($client->petrol_quan)){

            if($request->input("petrol_quan") > $client->remaining_petrol_quan){
                return false;
            }
        }
        if(!is_null($client->diesel_quan)){
            if($request->input("diesel_quan") > $client->remaining_diesel_quan){
                return false;
            }
        }  
        return true;      
    }
    public function store(StoreOrderRequest $request)
    {

            abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            if(!$this->checkLimit($request)){
                return \Redirect::back()->withErrors(['orderError'=>'Limit Exceeds']);  
            }
            $client_id = $request->input("client_id");
            if(empty($client_id) || !is_numeric($client_id)){
               return \Redirect::back()->withErrors(['client_id'=>'must select a client']);  
            }
            $clientData = Client::where("id",$client_id)->first();
            if(!$clientData){
                return abort(Response::HTTP_FORBIDDEN);
            }
            $pQuan = $request->input('petrol_quan');
            $dQuan = $request->input('diesel_quan');
            $pHose = $request->input('petrol_hose');
            $dHose = $request->input('diesel_hose');            
          
            if(isset($pQuan) && !is_numeric($pQuan)){
                return \Redirect::back()->withErrors(['petrol_quan'=>'must be number']); 
            }

            if(isset($dQuan) && !is_numeric($dQuan)){
                return \Redirect::back()->withErrors(['diesel_quan'=>'must be number']); 
            } 

            if(isset($pHose) && !is_numeric($pHose)){
                return \Redirect::back()->withErrors(['petrol_hose'=>'Please Select Again']); 
            }

            if(isset($dHose) && !is_numeric($dHose)){
                return \Redirect::back()->withErrors(['diesel_hose'=>'Please Select Again']); 
            }                     

            if( !$pQuan && !$dQuan )   {
                return \Redirect::back()->withErrors(['petrol_quan'=>'Petrol Or Diesel Must have a value',
                                                      'diesel_quan'=>'Petrol Or Diesel Must have a value']);            
            }

            if(!is_null($pQuan)){
                $pump = Pump::whereHas("hoses",function($q) use ($pHose){
                    $q->where("hose_id",$pHose);
                })->first();
                $pumpId = $pump->id;
                $tank= Tank::whereHas("pumps",function($q) use ($pumpId){
                    $q->where("pump_id",$pumpId);
                })->first();
                if($tank->type!="petrol"){
                    return abort(Response::HTTP_FORBIDDEN);
                }
                if($tank->quantity<$pQuan){
                    return \Redirect::back()->withErrors(['petrol_hose'=>'The available petrol in tank : '.$tank->name.' is '.$tank->quantity]);
                }
                Tank::where("id",$tank->id)->update(["quantity"=>$tank->quantity-$pQuan]);
            }

            if(!is_null($dQuan)){
                $pump = Pump::whereHas("hoses",function($q) use ($dHose){
                    $q->where("hose_id",$dHose);
                })->first();
                $pumpId = $pump->id;
                $tank= Tank::whereHas("pumps",function($q) use ($pumpId){
                    $q->where("pump_id",$pumpId);
                })->first();
                if($tank->type!="diesel"){
                    return abort(Response::HTTP_FORBIDDEN);
                }
                if($tank->quantity<$dQuan){
                    return \Redirect::back()->withErrors(['diesel_hose'=>'The available diesel in tank : '.$tank->name.' is '.$tank->quantity]);
                }
                Tank::where("id",$tank->id)->update(["quantity"=>$tank->quantity-$dQuan]);
            }            
         

            $order = Order::create(array_merge($request->all(), ['created_by' => auth()->user()->id,'station_id' => getStationId(),'shift_id'=>session()->get("shift_id"),'client_id'=>$client_id])) ;
            $updateArr=[];
            if(!is_null($clientData->petrol_quan)){
                $updateArr = array_merge(["remaining_petrol_quan"=>$clientData->remaining_petrol_quan-$pQuan],$updateArr);
            }
            if(!is_null($clientData->diesel_quan)){
                 $updateArr = array_merge(["remaining_diesel_quan"=>$clientData->remaining_diesel_quan-$dQuan],$updateArr);               
            }            
          
            Client::where('id',$client_id)->update($updateArr);
        


        return redirect(route('order.index'));
        
    }

    public function corporate($request){
           
            
    }


    // public function destroy(Order $order)
    // {
    //     abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $order->delete();

    //     return back();
    // }

    public function getFuelDetails(Request $request){
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cId = $request['data']['c_id'];
        $clients=[];        
        $petrolOldTotal = 0;
        $dieselOldTotal = 0;        
        if($cId && is_numeric($cId)){

            $clients=Client::select("petrol_limit","diesel_limit","diesel_discount","petrol_discount","diesel_quan","petrol_quan","pay_type","remaining_petrol_quan","remaining_diesel_quan")->where("station_id",getStationId())->where("id",$cId)->get()->toArray();

        }

     
       
        echo json_encode($clients);
    }


    public function ordersTrail(Request $request){
            $id = isset($request['id']) ? (int)$request['id'] : null;
            if ($request->ajax()) {
            if(!isset($id) || !is_numeric($request['id'])){
                abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
            }
            $query = Order::select(sprintf('%s.*', (new Order)->table));

            if(isset($request->bid)) {
                $query = $query->where('id', $request->bid);
            }
           
            $query = $query->with('clients',function($q){
                $q->where('station_id',getStationId());
            });

            $query = $query->where("shift_id",$id )->where("station_id",getStationId());
            $table = DataTables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
      
               
                $deleteGate    = 'order_access';
                $crudRoutePart = 'order';

                return view('partials.datatablesActions', compact(
                   
                    
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            $table->editColumn('name', function ($row) {                
                return isset($row->clients->name) ? $row->clients->name : "";
            });
            $table->editColumn('petrol_quan', function ($row) {
                return $row->petrol_quan ? $row->petrol_quan : "";
            });
            $table->editColumn('diesel_quan', function ($row) {
                return $row->diesel_quan ? $row->diesel_quan : "";
            });      
            $table->editColumn('date', function ($row) {
                return $row->date ? $row->date : "";
            });                                 
            $table->editColumn('client_type', function ($row) {
                return $row->client_id == 0 ? "Walk in" : 'corporate';
            });  
            $table->rawColumns([ 'name', 'petrol_quan', 'diesel_quan','date','client_type','actions']);

            return $table->make(true);
            }
            return view('admin.orders.show_orders');
    }

}
