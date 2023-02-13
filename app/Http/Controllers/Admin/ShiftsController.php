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

class ShiftsController extends Controller
{
    public function index(Request $request)
    {
       
        abort_if(Gate::denies('shift_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {

            $query = User::select(sprintf('%s.*', (new User)->table));

 
            $query = $query->with("roles")->whereHas("roles",function($q){
                $q->where("title","Cashier");
            })->with("stations")->whereHas("stations",function($q){
                $q->where("petrol_station_id",getStationId());
            });
           
          
            $table = DataTables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');


            $table->editColumn('shift', function ($row) {
                $shift = Shift::where("employee_id",$row->id)->orderBy("id","desc")->first();
                $btn="";
                $status=true;
                if($shift){
                    if(is_null($shift->time_out)){
                        $time = Carbon::parse($shift->time_in);
                        $now = \Carbon\Carbon::now();
                        $hour = $now->diffInHours($time);
       
                        $minute=$now->diffInMinutes($time);
                        $loop=true;
                        while($loop){                            
                            if($minute>=60){
                                $minute-=60;
                            }
                            else{
                                $loop=false;
                            }
                        }
                        $second=$now->diffInSeconds($time);
                        $loop=true;
                        while($loop){                            
                            if($second>=60){
                                $second-=60;
                            }
                            else{
                                $loop=false;
                            }
                        }                        

                        $btn = '
                        <div style="float:left" id="shift_'.$row->id.'">
                        <a class="btn btn-xs shift_id_'.$row->id.' btn-danger" onclick="shiftManagement('.$row->id.')" > End Shift</a>
                        </div>
                        <span style="float:left;margin-top:5px;margin-left:10px;" id="clock_'.$row->id.'"> 
                        <span class="timer" style="display:none;" id="hour_'.$row->id.'">'.$hour.'</span>    
                        <span class="timer" style="display:none;" id="minute_'.$row->id.'">'.$minute.'</span>    
                        <span class="timer" style="display:none;" id="second_'.$row->id.'">'.$second.'</span>
                        ';    
                        $status=false;
                    }                   
                }
                if($status){
                    $btn = '
                    <div style="float:left" id="shift_'.$row->id.'">
                    <a  class="btn btn-xs btn-info" onclick="shiftManagement('.$row->id.')" id="'.$row->id.'" >
                                Start Shift
                        </a>
                        </div>
                        <span style="float:left;margin-top:5px;margin-left:10px;" id="clock_'.$row->id.'"> 
                        ';
                }
                return $btn;
                
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });            



           
    
            $table->rawColumns([ 'name','shift','actions']);

            return $table->make(true);
        }

        return view('admin.shifts.index');
    }

        public function shiftManagement(Request $request){
            abort_if(Gate::denies('shift_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            $id = $request->data['id'];
            $user = User::where("id",$id)->with("stations")->whereHas("stations",function($q){
                    $q->where("petrol_station_id",getStationId());
            })->first();
            if(!$user){
                return;
            }
            $status=true;
            $current = Carbon::now();
            if($id){
                $shift = Shift::where("employee_id",$id)->orderBy("id","desc")->first();
                if($shift){
                    if(is_null($shift->time_out)){
                        $shift->update(["time_out"=>$current]);
                        $status=false;
                        echo '<a class="btn btn-xs btn-info" onclick="shiftManagement('.$id.')" id="'.$id.'" >
                                Start Shift
                        </a>';                        
                    }
                }
                if($status){
                    Shift::create([
                            "time_in"=>$current,
                            "created_by"=>auth()->user()->id,
                            "station_id"=>getStationId(),
                            "employee_id"=>$id
                    ]);
                    echo '<a class="btn btn-xs shift_id_'.$id.' btn-danger" onclick="shiftManagement('.$id.')" id="'.$id.'" >
                                End Shift
                        </a>';                    
                }
            }
        }


}
