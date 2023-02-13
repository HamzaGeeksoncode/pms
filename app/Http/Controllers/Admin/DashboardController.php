<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Vendor;
use App\Models\Fuel;

class DashboardController extends Controller
{
    public function dashboard()
    {   
        $data['corporateClients']   = Client::where("station_id",getStationId())->count();
        $data['vendors']            = Client::where("station_id",getStationId())->count();
        $petrolPrice                = Fuel::select("price")->where("type","petrol")
                                      ->where("station_id",getStationId())->first();   
        $dieselPrice                = Fuel::select("price")->where("type","diesel")
                                      ->where("station_id",getStationId())->first();   
        $data['dieselCurrentPrice'] = $dieselPrice ? $dieselPrice->price : "";
        $data['petrolCurrentPrice'] = $petrolPrice ? $petrolPrice->price : "";
 
        return view('admin.index')->with($data);
    }
}
