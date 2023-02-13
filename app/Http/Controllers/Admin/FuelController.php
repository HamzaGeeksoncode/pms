<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFuelRequest;
use App\Http\Requests\StoreFuelRequest;
use App\Http\Requests\UpdateFuelRequest;
use App\Models\Fuel;
use App\Models\FuelLog;
use Gate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class FuelController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('fuel_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data=[];
        $petrolPrice = Fuel::where("type","petrol")->where("station_id",getStationId())->first();
        $dieselPrice = Fuel::where("type","diesel")->where("station_id",getStationId())->first();
        if($petrolPrice){
            $data['petrolPrice'] = $petrolPrice->price;
        }
        if($dieselPrice){
            $data['dieselPrice'] = $dieselPrice->price;
        }        
        // abort_if(Gate::denies('blog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Fuel::select(sprintf('%s.*', (new Fuel)->table));

            if(isset($request->bid)) {
                $query = $query->where('id', $request->bid);
            }
            $query = $query->where('station_id', getStationId());
            $table = DataTables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'fuel_show';
                $editGate      = 'fuel_edit';
                $deleteGate    = 'fuel_delete';
                $crudRoutePart = 'fuel';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : "";
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : "";
            });
            $table->editColumn('price_change_date', function ($row) {
                return $row->price_change_date ? $row->price_change_date : "";
            });            

            $table->rawColumns(['actions', 'price', 'type', 'price_change_date']);

            return $table->make(true);
        }

        return view('admin.fuel.index')->with($data);
    }

    public function create()
    {
        abort_if(Gate::denies('fuel_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return redirect()->route("fuel.index");
    }

    public function store(StoreFuelRequest $request)
    {
        abort_if(Gate::denies('fuel_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');        
        return redirect()->route("fuel.index");
    }

    public function edit(Fuel $fuel)
    {
        abort_if(Gate::denies('fuel_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('admin.fuel.edit', compact('fuel'));
    }

    public function update(UpdateFuelRequest $request, Fuel $fuel)
    {
        $price = $request->input("price");
        $priceChangeDate = $request->input("price_change_date");
        $oldPrice = $fuel->price;
        $oldpriceChangeDate = $fuel->price_change_date;
        $fuel->update([
            "price" => $price ,
            "price_change_date" => $priceChangeDate,
        ]); 
  
        if($oldPrice!=$price || $oldpriceChangeDate!=$priceChangeDate){
            FuelLog::create([
                "price" => $price ,
                "type" => $fuel->type,
                "station_id" => getStationId(),
                "created_by" => getUserId(),
                "fuel_id" => $fuel->id,
                "price_change_date" => $priceChangeDate
            ]);
        }
        return redirect(route('fuel.index'));
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        $user->load('roles', 'userCategories');

        return view('admin.users.show', compact('user'));
    }

    // public function destroy(User $user)
    // {
    //     abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
    //     if($status) return redirect('/admin');

    //     $user->delete();

    //     return back();
    // }

    // public function massDestroy(MassDestroyUserRequest $request)
    // {
    //     User::whereIn('id', request('ids'))->delete();

    //     return response(null, Response::HTTP_NO_CONTENT);
    // }
}
