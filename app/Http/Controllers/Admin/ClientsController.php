<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Yajra\DataTables\Facades\DataTables;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Client::select(sprintf('%s.*', (new Client)->table));

            if(isset($request->bid)) {
                $query = $query->where('id', $request->bid);
            }
            $query = $query->where('user_id', auth()->user()->id);
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $editGate      = 'client_access';
                $deleteGate      = 'client_access';
                $crudRoutePart = 'clients';

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
            $table->editColumn('contact_number_1', function ($row) {
                return $row->contact_number_1 ? $row->contact_number_1 : "";
            }); 
            $table->editColumn('petrol_limit', function ($row) {
                return $row->petrol_limit ? $row->petrol_limit : "";
            });  
            $table->editColumn('diesel_limit', function ($row) {
                return $row->diesel_limit ? $row->diesel_limit : "";
            });                                     


            $table->rawColumns(['actions', 'name', 'contact_number_1','petrol_limit', 'diesel_limit']);

            return $table->make(true);
        }

        return view('admin.clients.index');
    }

    public function create()
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clients.create');
    }

    public function store(StoreClientRequest $request)
    {

        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $petrol = $request->input('petrol_quan');
        $diesel = $request->input('diesel_quan');
        $payType = ($request->input('pay_type') && $request->input('pay_type') == "on") ? 'credit' : 'debit';
        if($petrol && ( !is_numeric($petrol) ) ){
            return \Redirect::back()->withErrors(['petrol_quan'=>'should be number']);
        }
        if($diesel && ( !is_numeric($diesel)) ){
            return \Redirect::back()->withErrors(['diesel_quan'=>'should be number']);
        } 

        $pDis = $request->input('petrol_discount');
        $dDis = $request->input('diesel_discount');

        if(isset($pDis) && !is_numeric($pDis)){
            return \Redirect::back()->withErrors(['petrol_discount'=>'must be number']);            
        }

        if(isset($dDis) && !is_numeric($dDis)){
            return \Redirect::back()->withErrors(['diesel_discount'=>'must be number']);            
        }        

        Client::create(array_merge($request->all(), ['user_id' => auth()->user()->id,'station_id' => getStationId(),'petrol_discount' => $pDis,'diesel_discount' => $dDis,'pay_type'=>$payType,"remaining_diesel_quan"=>$diesel,"remaining_petrol_quan"=>$petrol]) );

        return redirect(route('clients.index'));
    }

    public function edit(Client $client)
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.clients.edit', compact('client'));

    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $petrol = $request->input('petrol_quan');
        $diesel = $request->input('diesel_quan');
        $payType = ($request->input('pay_type') && $request->input('pay_type') == "on") ? 'credit' : 'debit';

        if($petrol && ( !is_numeric($petrol) ) ){
            return \Redirect::back()->withErrors(['petrol_quan'=>'should be number']);
        }
        if($diesel && ( !is_numeric($diesel)) ){
            return \Redirect::back()->withErrors(['diesel_quan'=>'should be number']);
        } 

        $pDis = $request->input('petrol_discount');
        $dDis = $request->input('diesel_discount');

        if(isset($pDis) && !is_numeric($pDis)){
            return \Redirect::back()->withErrors(['petrol_discount'=>'must be number']);            
        }

        if(isset($dDis) && !is_numeric($dDis)){
            return \Redirect::back()->withErrors(['diesel_discount'=>'must be number']);            
        }   
        $remaining_petrol_quan=null;
        if(is_null($client->petrol_quan) && !is_null($petrol)){
            $remaining_petrol_quan = $petrol;
        }else{
            $remaining_petrol_quan=$client->remaining_petrol_quan;
        }
          
        $remaining_diesel_quan=null;
        if(is_null($client->diesel_quan) && !is_null($diesel)){
            $remaining_diesel_quan = $diesel;
        }else{
            $remaining_diesel_quan=$client->remaining_diesel_quan;
        }    
    
        $client->update(array_merge($request->all(), ['petrol_discount' => $pDis,'diesel_discount' => $dDis,'pay_type'=>$payType,"remaining_diesel_quan"=>$remaining_diesel_quan,"remaining_petrol_quan"=>$remaining_petrol_quan])); 
        return redirect(route('clients.index'));
    }

    // public function destroy(Client $client)
    // {
    //     abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    //     $client->delete();

    //     return back();
    // }

}
