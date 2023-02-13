<?php

use App\Models\Fuel;
function getPrice(){
    $petrolPrice = Fuel::select("price")->where("type","petrol")->where("station_id",session()->get("stationId"))->orderBy("id","desc")->first();
    $dieselPrice = Fuel::select("price")->where("type","diesel")->where("station_id",session()->get("stationId"))->orderBy("id","desc")->first();
    $pPrice = 0;
    $dPrice=0;
    if($dieselPrice){
    	$dPrice = $dieselPrice->price;
    }
    if($petrolPrice){
    	$pPrice = $petrolPrice->price;
    }    
    $resultArr = ['petrolPrice'=> $pPrice , 'dieselPrice'=> $dPrice];
    return $resultArr;
}
function getStationId(){
    return session()->get("stationId");
}
function getUserId(){
    return auth()->user()->id;
}
function userRole(){
    return  session()->get('userRole');
}
function getCurrentDate($format){
    return \Carbon\Carbon::now()->format($format);
}
