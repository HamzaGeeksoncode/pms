<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVendorRequest;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use App\Models\Vendor;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class VendorController extends Controller
{
    public function index(Request $request)
    {

        abort_if(Gate::denies('vendor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Vendor::select(sprintf('%s.*', (new Vendor)->table));

            if(isset($request->bid)) {
                $query = $query->where('id', $request->bid);
            }
            $query = $query->where('station_id', getStationId());
            $table = DataTables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {

                $editGate      = 'vendor_create' ;
                $deleteGate    = 'vendor_create';
                $crudRoutePart = 'vendors';

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
            $table->editColumn('company_name', function ($row) {
                return $row->company_name ? $row->company_name : "";
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : "";
            });      
            $table->rawColumns([ 'name', 'company_name', 'address','actions']);

            return $table->make(true);
        }

        return view('admin.vendors.index');
    }

    public function create()
    {
        // abort_if(Gate::denies('vendor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       
        return view('admin.vendors.create');
    }

    public function store(StoreVendorRequest $request)
    {
        abort_if(Gate::denies('vendor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::create(
            ['created_by' => auth()->user()->id,
                      'name' => $request->input("name"),
                      'email' => $request->input("email"),
                      'password' => $request->input("password")
            ]
          );       
        $user->roles()->sync(4);
        $user->stations()->sync(getStationId()); 
        $request->request->remove('password');
        Vendor::create(array_merge($request->all(), ['user_id' => getUserId(),'station_id' => getStationId()])); 
        return redirect(route('vendors.index'));
        
    }

    public function edit(Vendor $vendor)
    {        
        abort_if(Gate::denies('vendor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::where("email",$vendor->email)->withTrashed()->first();

        return view('admin.vendors.edit', compact('vendor','user'));
    }

    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        abort_if(Gate::denies('vendor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $u_id = $request->input("u_id");
        $userOld = User::where("id",$u_id)->first();
        $pass = $request->input("password");
        $oldPass = $userOld->password;
        User::where("id",$u_id)->update(
            [              
              'name' => $request->input("name"),
              'password' => ((isset($pass) && $pass != "" )  ? \Hash::make($pass) : $oldPass  )
            ]
          );       
        $request->request->remove('password');       
        $vendor->update($request->all()); 

        return redirect(route('vendors.index'));
    }



    // public function destroy(Vendor $vendor)
    // {
    //     abort_if(Gate::denies('vendor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $vendor->delete();

    //     return back();
    // }


}
