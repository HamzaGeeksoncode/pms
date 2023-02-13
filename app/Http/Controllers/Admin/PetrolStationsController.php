<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPetrolStationRequest;
use App\Http\Requests\StorePetrolStationRequest;
use App\Http\Requests\UpdatePetrolStationRequest;
use App\Models\PetrolStation;
use App\Models\Fuel;
use Yajra\DataTables\Facades\DataTables;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PetrolStationsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('petrol_station_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['stations'] = PetrolStation::get()->toArray();

        return view('admin.petrol_stations.index')->with($data);
    }

    public function create()
    {
        abort_if(Gate::denies('petrol_station_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.petrol_stations.create');
    }

    public function store(StorePetrolStationRequest $request)
    {
        abort_if(Gate::denies('petrol_station_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $station = PetrolStation::create($request->all());
        Fuel::create(
                [
                "price" => 1,
                "type" => "diesel",
                "station_id" => $station->id,
                "price_change_date" => getCurrentDate("Y-m-d")
                ]
        );
        Fuel::create(
                [
                "price" => 1,
                "type" => "petrol",
                "station_id" => $station->id,
                "price_change_date" => getCurrentDate("Y-m-d")
                ]
        );        
        
        return redirect(route('petrol-stations.index'));
    }

    public function edit(PetrolStation $petrolStation)
    {
        abort_if(Gate::denies('petrol_station_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.petrol_stations.edit', compact('petrolStation'));
    }

    public function update(UpdatePetrolStationRequest $request, PetrolStation $petrolStation)
    {
        abort_if(Gate::denies('petrol_station_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $petrolStation->update($request->all());
        return redirect(route('petrol-stations.index'));
    }

}
