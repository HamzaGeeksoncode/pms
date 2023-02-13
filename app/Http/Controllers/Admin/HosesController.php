<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyHoseRequest;
use App\Http\Requests\StoreHoseRequest;
use App\Http\Requests\UpdateHoseRequest;
use App\Models\Hose;
use App\Models\Pump;
use App\Models\Tank;
use App\Models\PetrolStation;
use Gate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class HosesController extends Controller
{
    public function index(Request $request)
    {

        abort_if(Gate::denies('hose_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {

            $query = Hose::select(sprintf('%s.*', (new Hose)->table));

            if(isset($request->bid)) {
                $query = $query->where('id', $request->bid);
            }
     
            $query = $query->where('station_id',getStationId());
            $query = $query->with("hosePump");
            $table = DataTables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
      
                $editGate      = 'hose_access';
                $deleteGate    = 'hose_access';
                $crudRoutePart = 'hoses';

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

            $table->editColumn('pump', function ($row) {

               return isset($row->hosePump->name) ? $row->hosePump->name : '';

            });            
    
            $table->rawColumns([ 'name', 'pump','actions']);

            return $table->make(true);
        }

        return view('admin.hoses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('hose_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['pumps'] = Pump::where("station_id",session()->get('stationId'))->get()->toArray();


        return view('admin.hoses.create')->with($data);
    }

    public function store(StoreHoseRequest $request)
    {
        abort_if(Gate::denies('hose_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
   
  
        $hose = Hose::create(array_merge($request->all(),['created_by'=>auth()->user()->id,'station_id'=>session()->get('stationId'),'pump_id'=>$request->input('pump')]));
        $hose->pumps()->sync($request->pump);
    
      
        return redirect(route('hoses.index'));
        
    }

    public function edit(Hose $hose)
    {        
        abort_if(Gate::denies('hose_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $checkIfExists = Hose::where('id',$hose->id)->where('station_id',session()->get('stationId'))->first();
        if(!$checkIfExists){
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $data['pumps'] = Pump::where("station_id",session()->get('stationId'))->get()->toArray();        
        return view('admin.hoses.edit', compact('hose'))->with($data);
    }

    public function update(UpdateHoseRequest $request, Hose $hose)
    {
        abort_if(Gate::denies('hose_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkIfExists = Hose::where('id',$hose->id)->where('station_id',session()->get('stationId'))->first();
        if(!$checkIfExists){
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }    

        $hose->update(array_merge($request->all(),['pump_id'=>$request->input('pump')  ]));
        $hose->pumps()->sync($request->pump); 

        return redirect(route('hoses.index'));
    }



    // public function destroy(Hose $hose)
    // {
    //     abort_if(Gate::denies('hose_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    //     $checkIfExists = Hose::where('id',$hose->id)->where('station_id',session()->get('stationId'))->first();
    //     if(!$checkIfExists){
    //         abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
    //     }  
        
    //     $hose->delete();

    //     return back();
    // }


}
