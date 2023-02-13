<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\PetrolStation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('user_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        // if($status) return redirect('/admin');

        if(session()->get('userRole') == "Super Admin"){
        $users = User::with('roles')->where("created_by",1)->get()->toArray();
        }
        elseif(session()->get('userRole') == "Admin"){
            $users = User::with('roles')->whereHas("roles",function($q){
                $q->where("title","Cashier");
            })->with("stations")->whereHas("stations",function($q){
                $q->where("petrol_station_id",getStationId());
            })->get()->toArray();
        }


        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        // abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        // if($status) return redirect('/admin');
        $stations=PetrolStation::get()->toArray();
        $roles = Role::select('title', 'id')->where("id",'!=',1)->get()->toArray();

        return view('admin.users.create', compact('roles','stations'));
    }

    public function store(StoreUserRequest $request)
    {
        $superAdmin = [2];
        $admin = [3,5];

        if(session()->get('userRole') == "Super Admin"){
            if(!in_array($request->input("roles"), $superAdmin)){
                return redirect(route("users.create"));
            }
        }

        if(session()->get('userRole') == "Admin"){
            if(!in_array($request->input("roles"), $admin)){
                return redirect(route("users.create"));
            }        
        }

        // session()->get('userRole') == "Super Admin"
        $user = User::create(array_merge($request->all(),['created_by' => auth()->user()->id] ));
     
        $user->roles()->sync($request->input('roles', []));
 
        if(userRole()=="Admin"){
            $user->stations()->sync(getStationId()); 
        }
        else if(userRole()=="Super Admin"){
            $user->stations()->sync($request->input("station"));             
        }

        // if (\App::environment('production')) {

        //     if ($request->input('image', false)) {
        //         $user->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->addCustomHeaders([
        //             'ACL' => 'public-read'
        //         ])->toMediaCollection('image','s3');
        //     }

        // } else {

        //     if ($request->input('image', false)) {
        //         $user->addMedia(storage_path('tmp/uploads/' . $request->input('image')));
        //     }

        // }

        return redirect(route('users.index'));
    }

    public function edit(User $user)
    {
        // abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::select('title', 'id')->where("id",'!=',1)->get()->toArray();
        $stations = PetrolStation::get()->toArray();

        $user->load('roles','stations');

        return view('admin.users.edit', compact('roles', 'user','stations'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
      
        // abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($request->input("email")){
            $request->request->remove('email');  
        }
        request()->only(['name', 'password']);
        $user->update($request->all());
        


        // if (\App::environment('production')) {

        //     if ($request->input('image', false)) {
        //         if (!$user->image || $request->input('image') !== $user->image->file_name) {
        //             $user->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->addCustomHeaders([
        //                 'ACL' => 'public-read'
        //             ])->toMediaCollection('image','s3');
        //         }
        //     } elseif ($user->image) {
        //         $user->image->delete();
        //     }

        // } else {

        //     if ($request->input('image', false)) {
        //         if (!$user->image || $request->input('image') !== $user->image->file_name) {
        //             $user->addMedia(storage_path('tmp/uploads/' . $request->input('image')));
        //         }
        //     } elseif ($user->image) {
        //         $user->image->delete();
        //     }

        // }

        return redirect(route('users.index'));
    }

    public function show(User $user)
    {
        // abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

      
        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    // public function destroy(User $user)
    // {
    //     // abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');


    //     $user->delete();

    //     return back();
    // }

    // public function massDestroy(MassDestroyUserRequest $request)
    // {
    //     User::whereIn('id', request('ids'))->delete();

    //     return response(null, Response::HTTP_NO_CONTENT);
    // }
}
