<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVendorFuelRequest;
use App\Http\Requests\StoreVendorFuelRequest;
use App\Http\Requests\UpdateVendorFuelRequest;
use App\Models\VendorFuel;
use App\Models\Vendor;
use App\Models\Tank;
use App\Models\PetrolStation;
use Illuminate\Support\Str;
use Gate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;

class VendorFuelController extends Controller
{
    public function index(Request $request)
    {


        abort_if(Gate::denies('vendorFuel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = VendorFuel::select(sprintf('%s.*', (new VendorFuel)->table));

            if(isset($request->bid)) {
                $query = $query->where('id', $request->bid);
            }
            $query = $query->where('station_id',  getStationId());
            $query = $query->with("vendors");
            $table = DataTables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
      
                $editGate      = 'vendorFuel_access';
                $viewGate    = 'vendorFuel_access';
                $crudRoutePart = 'vendorFuel';

                return view('partials.datatablesActions', compact(
                   
                    'editGate',
                    'viewGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            $table->editColumn('serial_no', function ($row) {
                return $row->serial_no ? $row->serial_no : "";
            });
            $table->editColumn('petrol_quantity', function ($row) {
                return $row->petrol_quantity ? $row->petrol_quantity : "";
            });
            $table->editColumn('diesel_quantity', function ($row) {
                return $row->diesel_quantity ? $row->diesel_quantity : "";
            });      
            $table->editColumn('vendor', function ($row) {
                return isset($row->vendors->name) ? $row->vendors->name : "";
            });                     

            $table->rawColumns([ 'serial_no', 'petrol_quantity', 'diesel_quantity','vendor','actions']);

            return $table->make(true);
        }

        return view('admin.vendor_fuel.index');
    }

    public function create()
    {
        abort_if(Gate::denies('vendorFuel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['vendors'] = Vendor::select("id","name")->where("user_id",auth()->user()->id)->get()->toArray();
        $data['tanks'] = Tank::where("station_id",getStationId())->get()->toArray();
        // abort_if(Gate::denies('vendorFuel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.vendor_fuel.create')->with($data);
    }

    public function store(StoreVendorFuelRequest $request)
    {
        abort_if(Gate::denies('vendorFuel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fileName = null;
        // dd($request->all());
        if($request->file('file')!=null){

            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,png,pdf',
            ]);
        
            $fileName = time().'.'.$request->file->extension();  

            $request->file->move(public_path('file'), $fileName);
        }
        
        
        $vendor = Vendor::where("id",$request->input('vendor'))->first();
        if(!$vendor){
            return redirect(route('vendorFuel.create'));
        }
        $petrol = $request->input('petrol_quantity');
        $diesel = $request->input('diesel_quantity');

        if($petrol && ( !is_numeric($petrol) || strlen($petrol)>8) ){
            return \Redirect::back()->withErrors(['petrol_quantity'=>'must be required , not be greater than 8 digits and not be empty']);
        }
        if($diesel && ( !is_numeric($diesel) || strlen($diesel)>8) ){
            return \Redirect::back()->withErrors(['diesel_quantity'=>'must be required , not be greater than 8 digits and not be empty']);
        }        
        $serial = auth()->user()->id.'#'.$request->input('vendor').'#'.getStationId().'#'.$this->generateRandomNumber(8);
        $vendorCreateArr=array_merge($request->all(), ['user_id' => auth()->user()->id,'vendor_id' => $request->input('vendor'),'station_id' => getStationId(),'serial_no' => $serial,'attachment'=>$fileName,'price'=>$vendor->price,'petrol_tank_id'=>$vendor->price,'diesel_tank_id'=>$vendor->price]);
        
        try {
            $petrol_tank_id = null;
            $diesel_tank_id = null;
            if($petrol){
                if(!$request->input('petrol_tank') || !is_numeric($request->input('petrol_tank'))){
                    return \Redirect::back()->withErrors(['petrol_tank'=>'Please select this field']);  
                }
                $petrol_tank_id = $request->input("petrol_tank");
                $petrolTank = Tank::where("id",$petrol_tank_id)->where("station_id",getStationId())->where("type","petrol")->first();
                if($petrolTank){
                    $lastQuan = $petrolTank->quantity;
                    $petrolTank->quantity = $lastQuan + $petrol;
                    $petrolTank->save();
                }else{
                    return abort(Response::HTTP_FORBIDDEN);
                }
            }
            if($diesel){
                if(!$request->input('diesel_tank') || !is_numeric($request->input('diesel_tank'))){
                    return \Redirect::back()->withErrors(['diesel_tank'=>'Please select this field']);  
                }            
                $diesel_tank_id = $request->input("diesel_tank");
                $dieselTank = Tank::where("id",$diesel_tank_id)->where("station_id",getStationId())->where("type","diesel")->first();
                if($dieselTank){
                    $lastQuan = $dieselTank->quantity;
                    $dieselTank->quantity = $lastQuan + $diesel;
                    $dieselTank->save();
                }else{
                    return abort(Response::HTTP_FORBIDDEN);
                }
                
            }
            VendorFuel::create( array_merge($vendorCreateArr,["diesel_tank_id"=>$diesel_tank_id,"petrol_tank_id"=>$petrol_tank_id]));       
        }
        catch(\PDOException $e){
            dd(1);
        }
         
 
        return redirect(route('vendorFuel.index'));
        
    }

    public function edit(VendorFuel $vendorFuel)
    {        
        abort_if(Gate::denies('vendorFuel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['vendors'] = Vendor::select("id","name")->where("user_id",auth()->user()->id)->get()->toArray();
        return view('admin.vendor_fuel.edit', compact('vendorFuel'))->with($data);
    }

    public function update(Request $request,VendorFuel $vendorFuel)
    {

        $vendor = Vendor::where("id",$vendorFuel->vendor_id)->where("station_id",getStationId())->first();
  
        if(!$vendor){
            return redirect(route('vendorFuel.create'));
        }
      
        $fileName = $vendorFuel->attachment;

        if($request->file('file')!=null){
            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,png,pdf',
            ]);
        
            $fileName = time().'.'.$request->file->extension();  

            $request->file->move(public_path('file'), $fileName);
        }

        $vendorFuel->update(['attachment'=>$fileName ]); 

        return redirect(route('vendorFuel.index'));
    }



    // public function destroy(VendorFuel $vendorFuel)
    // {
    //     abort_if(Gate::denies('vendorFuel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $vendorFuel->delete();

    //     return back();
    // }
    public function show(VendorFuel $vendorFuel)
    {

        abort_if(Gate::denies('vendorFuel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      
        $vendorFuel->load('vendors');

        return view('admin.vendor_fuel.show', compact('vendorFuel'));
    }

    public function generateRandomNumber($length = 8)
    {
      $random = "";
      srand((double) microtime() * 1000000);

      $data = "123456123456789071234567890890";
      // $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz"; // if you need alphabatic also

      for ($i = 0; $i < $length; $i++) {
              $random .= substr($data, (rand() % (strlen($data))), 1);
      }

      return $random;

    }    


}
