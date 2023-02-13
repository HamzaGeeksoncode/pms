<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Reading;

class InitialReading
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
        return $next($request);
        // if(!Auth::check() || $request->route()->getName() == "logout"){ return $next($request); }
        // $user_id =Auth::user()->id;
        // $userData = User::where('id', $user_id)->with('roles')->orderBy("id","asc")->get()->toArray();
        // $role = $userData[0]['roles'][0]['title'];
        // session()->put('userRole', $role);
        // if($role=="Cashier"){
        //     $hasReading = true;
        //     $petrol_reading = Reading::whereNull("timeout")->where("user_id",$user_id)->orderBy("id",'desc')->first();
        //     if($petrol_reading){
        //         if($petrol_reading->petrol_reading==null || $petrol_reading->timein==null){
        //             $hasReading =false;
        //         }
        //     }
        //     else{
        //         $hasReading= false;
        //     }
        //     if(!$hasReading){
        //         if($request->route()->getName()!="readings.index" && $request->route()->getName()!="readings.store"){
        //             return redirect(route('readings.index'))->withErrors(["message"=>"Please Enter Timein and initital Reading"]);
        //         }
        //     }
                   
        // }
       
        // return $next($request);
    }
}
