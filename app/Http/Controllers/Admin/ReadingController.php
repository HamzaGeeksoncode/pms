<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReadingRequest;
use App\Http\Requests\TimeoutRequest;
use App\Models\Reading;
use App\Models\Hose;
use App\Models\Pump;
use App\Models\Tank;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class ReadingController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('reading_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Reading::select(sprintf('%s.*', (new Reading)->table));

            if(isset($request->bid)) {
                $query = $query->where('id', $request->bid);
            }
            $query = $query->where('station_id', getStationId());
            $query = $query->with(['users','tanks','pumps','hoses']);                        
            $query = $query->orderBy('id',"desc");

            $table = DataTables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
  
                // $editGate      = 'reading_management_access';
                $deleteGate    = 'reading_management_access';
                $crudRoutePart = 'readings';

                return view('partials.datatablesActions', compact(
                
                    // 'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            $table->editColumn('name', function ($row) {
                return isset($row->users->name) ? $row->users->name : "";
            });
            $table->editColumn('fuel_type', function ($row) {
                return isset($row->tanks->type) ? $row->tanks->type : "";
            });            
            $table->editColumn('tank', function ($row) {
                return isset($row->tanks->name) ? $row->tanks->name : "";
            });
            $table->editColumn('pump', function ($row) {
                return isset($row->pumps->name) ? $row->pumps->name : "";
            });  
            $table->editColumn('hose', function ($row) {
                return isset($row->hoses->name) ? $row->hoses->name : "";        
            });       
            $table->editColumn('reading', function ($row) {
                return $row->hose_val ? $row->hose_val : "";
            }); 
            $table->editColumn('litre', function ($row) {
                return $row->litre ? $row->litre : "";
            });                                                      

            $table->rawColumns(['actions', 'name', 'fuel_type' ,'tank','pump','hose','reading','litre']);

            return $table->make(true);
        }
       

        return view('admin.readings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('reading_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');        

        $data['users'] = User::with('roles')->whereHas("roles",function($q){
            $q->where("title",'Cashier');
        })->with("stations")->whereHas("stations",function($q2){
            $q2->where('petrol_station_id',session()->get('stationId'));
        })->get()->toArray();
       

        $data['readingData'] = Tank::with(["pumps"=>function($q){
            $q->with("hoses");
        }])->where("station_id",getStationId())->get()->toArray();
      
        return view('admin.readings.create')->with($data);
    }

    public function store(StoreReadingRequest $request)
    {
        if(empty($request->input('hoose_val'))){
            return redirect(route("hoses.create"));
        }
        foreach($request->input('hoose_val') as $key => $hose){
            $ids = explode('_', $request->input('tank_pump_hoose')[$key]);
            $litre=0;
            if(!isset($ids[0]) || !isset($ids[1]) || !isset($ids[2])){
                return redirect(route("hoses.create"));
            }
            if(!empty($hose)){ 
                $lastHoseVal = Reading::select("hose_val","litre")->where("station_id",getStationId())->where("hose_id",$ids[2])->orderBy("id","desc")->first();
                if($lastHoseVal){                    
                    if((int)$hose < $lastHoseVal->hose_val){                  
                        return \Redirect::back()->withErrors(["hoose_val".$ids[2]=>"Hose reading cant be less than the last reading"]);
                    }
                    $litre = (int)$hose - $lastHoseVal->hose_val;
                }
               
                Reading::create( [
                      'employee_id' => $request->input('name'),
                      'created_by' => auth()->user()->id ,
                      'station_id'=>session()->get('stationId'),
                      'hose_val'=>(int)$hose,
                      'tank_id'=>$ids[0],
                      'pump_id'=>$ids[1],
                      'hose_id'=>$ids[2],
                      'litre'=>$litre
                  ]  );
            }
        }
      

        

        return redirect(route('readings.index'));
    }

    // public function edit(Reading $reading)
    // {        
    //     abort_if(Gate::denies('reading_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');


    //     return view('admin.readings.edit', compact('reading'));
    // }

    // public function update(StoreReadingRequest $request, Reading $reading)
    // {
    //     abort_if(Gate::denies('reading_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    //     $finalReading = $request->input("final_reading");
    //     if(isset($finalReading) && !is_numeric($finalReading)){
    //         return \Redirect::back()->withErrors(['final_reading'=>'must be a number']); 
    //     }
    //     $finalReading = empty($finalReading) ? 0 : $finalReading;

    //     $reading->update(array_merge($request->all(), [ 'final_reading'=>$finalReading]) ); 
    
    //     return redirect(route('readings.index'));
    // }

    // public function massDestroy(MassDestroyUserRequest $request)
    // {
    //     User::whereIn('id', request('ids'))->delete();

    //     return response(null, Response::HTTP_NO_CONTENT);
    // }

    // public function destroy(Reading $reading)
    // {
    //     abort_if(Gate::denies('reading_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $reading->delete();

    //     return back();
    // }    

    // public function timeout(TimeoutRequest $request){
    //     $readingData = Reading::where("user_id",auth()->user()->id)->orderBy("id","desc")->first();
    //     if($readingData){
    //         if(!$readingData->timeout){
    //             Reading::where("id",$readingData->id)->update(["timeout"=>$request->timeout]);
    //         }
    //     }
    //     return redirect(route('readings.index'));     
    // }
}
