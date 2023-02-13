<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientPaymentRequest;
use App\Http\Requests\UpdateClientPaymentRequest;
use App\Models\Client;
use App\Models\ClientsPayment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientsPaymentController extends Controller
{
    public function index(Request $request)
    {

        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ClientsPayment::select(sprintf('%s.*', (new ClientsPayment)->table));

            if(isset($request->bid)) {
                $query = $query->where('id', $request->bid);
            }
        
            $table = DataTables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
      
                $editGate      = 'client_access';
                $deleteGate    = 'client_access';
                $crudRoutePart = 'clients-payments';

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
            $table->editColumn('attachment', function ($row) {
                return $row->capacity ? $row->capacity : "";
            });
                   
            $table->rawColumns([ 'name', 'attachment','actions']);

            return $table->make(true);
        }

        return view('admin.clients_payments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['stations']=PetrolStation::get()->toArray();
        return view('admin.clients_payments.create')->with($data);
    }

    public function store(StoreTankRequest $request)
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $station = PetrolStation::where("id",$request->input('station'))->first();
        if(!$station){
            return redirect(route('tanks.index'));
        }
        $tank = ClientsPayment::create($request->all());
        $tank->stations()->sync($request->input('station')); 
        return redirect(route('tanks.index'));
        
    }

    public function edit(Tank $tank)
    {        
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['stations']=PetrolStation::get()->toArray();
        $data["selectedStation"] = ClientsPayment::with("stations")->where("id",$tank->id)->first();
        if($data['selectedStation']){
            $data['selectedStation'] = $data['selectedStation']->stations[0]->id;
        }
        return view('admin.clients_payments.edit', compact('tank'))->with($data);
    }

    public function update(UpdateTankRequest $request, Tank $tank)
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $station = PetrolStation::where("id",$request->input('station'))->first();
        if(!$station){
            return redirect(route('tanks.index'));
        }
        $tank->update($request->all()); 
        $tank->stations()->sync($request->input('station'));
        return redirect(route('tanks.index'));
    }



    // public function destroy(Tank $tank)
    // {
    //     abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $tank->delete();

    //     return back();
    // }
}
