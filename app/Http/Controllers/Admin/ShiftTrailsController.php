<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyShiftRequest;
use App\Http\Requests\StoreShiftRequest;
use App\Http\Requests\UpdateShiftRequest;
use App\Models\Shift;
use App\Models\User;
use App\Models\Pump;
use App\Models\Tank;
use App\Models\PetrolStation;
use Gate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class ShiftTrailsController extends Controller
{
    public function index(Request $request)
    {
         
        abort_if(Gate::denies('shift_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {

            $query = Shift::select(sprintf('%s.*', (new Shift)->table));

            if(isset($request->bid)) {
                $query = $query->where('id', $request->bid);
            }
            $query = $query->with("user");            
            $query = $query->where('station_id', getStationId())
                     ->whereNotNull("time_out");
          
            $table = DataTables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');


            $table->editColumn('id', function ($row) {

                return $row->id;
            });


            $table->editColumn('name', function ($row) {

                return $row->user->name;
            });
            $table->editColumn('time_in', function ($row) {
                return $row->time_in ? $row->time_in : "";
            });  
            $table->editColumn('time_out', function ($row) {
                return $row->time_out ? $row->time_out : "";
            });
            $table->editColumn('orders', function ($row) {
                return '<a target="_blank" href="'.route('orders-trail').'?id='.$row->id.'" class="btn btn-xs btn-info" onclick="showOrders('.$row->id.')" >
                                Show Orders
                        </a>';
            });                                                   



           
    
            $table->rawColumns([ 'name','id','time_in','time_out','orders','actions']);

            return $table->make(true);
        }

        return view('admin.shift_trails.index');
    }

     


}
