<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPumpRequest;
use App\Http\Requests\StorePumpRequest;
use App\Http\Requests\UpdatePumpRequest;
use App\Models\Pump;
use App\Models\Tank;
use App\Models\PetrolStation;
use Gate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class PumpsController extends Controller
{
    public function index(Request $request)
    {

        abort_if(Gate::denies('pump_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Pump::select(sprintf('%s.*', (new Pump)->table));

            if(isset($request->bid)) {
                $query = $query->where('id', $request->bid);
            }
     
            $query = $query->where('station_id',session()->get('stationId'));
            $query = $query->with("pumpTank");
            $table = DataTables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
      
                $editGate      = 'pump_access';
                $deleteGate    = 'pump_access';
                $crudRoutePart = 'pumps';

                return view('partials.datatablesActions', compact(
                   
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });

            $table->editColumn('tank', function ($row) {

                return isset($row->pumpTank->name) ? $row->pumpTank->name : '';  

            });            
    
            $table->rawColumns([ 'name', 'tank','actions']);

            return $table->make(true);
        }

        return view('admin.pumps.index');
    }

    public function create()
    {
        abort_if(Gate::denies('pump_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['tanks'] = Tank::where("station_id",session()->get('stationId'))->get()->toArray();

        return view('admin.pumps.create')->with($data);
    }

    public function store(StorePumpRequest $request)
    {
        abort_if(Gate::denies('pump_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
   
  
        $pump = Pump::create(array_merge($request->all(),['created_by'=>auth()->user()->id,'station_id'=>session()->get('stationId'),'tank_id'=>$request->input('tank')]));
        $pump->tanks()->sync($request->tank);
    
      
        return redirect(route('pumps.index'));
        
    }

    public function edit(Pump $pump)
    {        
        abort_if(Gate::denies('pump_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $checkIfExists = Pump::where('id',$pump->id)->where('station_id',session()->get('stationId'))->first();
        if(!$checkIfExists){
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $data['tanks'] = Tank::where("station_id",session()->get('stationId'))->get()->toArray();        
        return view('admin.pumps.edit', compact('pump'))->with($data);
    }

    public function update(UpdatePumpRequest $request, Pump $pump)
    {
        abort_if(Gate::denies('pump_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkIfExists = Pump::where('id',$pump->id)->where('station_id',session()->get('stationId'))->first();
        if(!$checkIfExists){
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }    

        $pump->update(array_merge($request->all(),['tank_id'=>$request->input('tank') ]));
        $pump->tanks()->sync($request->tank); 

        return redirect(route('pumps.index'));
    }



    // public function destroy(Pump $pump)
    // {
    //     abort_if(Gate::denies('pump_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    //     $checkIfExists = Pump::where('id',$pump->id)->where('station_id',session()->get('stationId'))->first();
    //     if(!$checkIfExists){
    //         abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
    //     }  
        
    //     $pump->delete();

    //     return back();
    // }


}
