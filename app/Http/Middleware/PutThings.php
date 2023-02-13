<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Shift;

class PutThings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check() || $request->route()->getName() == "logout"){ return $next($request); }
 
        $user = User::where('id',Auth::user()->id)->with(['stations','roles'])->first();
        
        $role = $user['roles'][0]['title'];
        session()->put('userRole', $role);
        if($user->roles[0]->title == "Admin" || $user->roles[0]->title == "Cashier" || $user->roles[0]->title == "vendor"){
            session()->put('stationId', $user->stations[0]->id);
        }
        if($user->roles[0]->title == "Cashier"){
           
            $shift = Shift::where("station_id",$user->stations[0]->id)->where("employee_id",Auth::user()->id)->whereNull("time_out")->orderBy("id","desc")->first();
            if($shift){
                session()->put("shift_id",$shift->id);
            }
            else{
                if($request->route()->getName()!="order.index"){

                    return redirect(route('order.index'))->withErrors(["shift_start_error"=>"Please ask your admin to start shift"]);
                }
            }
        }
        return $next($request);
    }
}
