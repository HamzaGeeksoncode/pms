<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTankRequest;
use App\Http\Requests\StoreTankRequest;
use App\Http\Requests\UpdateTankRequest;
use App\Models\Tank;
use App\Models\PetrolStation;
use Gate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class TanksController extends Controller
{
    public function index(Request $request)
    {

        abort_if(Gate::denies('tank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Tank::select(sprintf('%s.*', (new Tank)->table));

            if(isset($request->bid)) {
                $query = $query->where('id', $request->bid);
            }
            $query = $query->where('station_id',session()->get('stationId'));
            $table = DataTables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
      
                $editGate      = 'tank_access';
                $deleteGate    = 'tank_access';
                $crudRoutePart = 'tanks';

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
            $table->editColumn('capacity', function ($row) {
                return $row->capacity ? $row->capacity : "";
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : "";
            });      
            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : "";
            });             
                            

            $table->rawColumns([ 'name', 'capacity', 'type', 'quantity','actions']);

            return $table->make(true);
        }

        return view('admin.tanks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['stations']=PetrolStation::get()->toArray();
        return view('admin.tanks.create')->with($data);
    }

    public function store(StoreTankRequest $request)
    {
        abort_if(Gate::denies('tank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
   
  
        $tank = Tank::create(array_merge($request->all(),['created_by'=>auth()->user()->id,'station_id'=>session()->get('stationId')]));
      
        return redirect(route('tanks.index'));
        
    }

    public function edit(Tank $tank)
    {        
        abort_if(Gate::denies('tank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $checkIfExists = Tank::where('id',$tank->id)->where('station_id',session()->get('stationId'))->first();
        if(!$checkIfExists){
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        return view('admin.tanks.edit', compact('tank'));
    }

    public function update(UpdateTankRequest $request, Tank $tank)
    {
        abort_if(Gate::denies('tank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checkIfExists = Tank::where('id',$tank->id)->where('station_id',session()->get('stationId'))->first();
        if(!$checkIfExists){
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }    

        $tank->update($request->all()); 

        return redirect(route('tanks.index'));
    }



    // public function destroy(Tank $tank)
    // {
    //     abort_if(Gate::denies('tank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $tank->delete();

    //     return back();
    // }


}
