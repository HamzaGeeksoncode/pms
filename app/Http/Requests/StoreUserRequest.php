<?php

namespace App\Http\Requests;

use App\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreUserRequest extends FormRequest
{
    // public function authorize()
    // {
    //     abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return true;
    // }

    public function rules()
    {
        $in= userRole() == "Super Admin" ? "2" : "3,4,5";
        return [
            'name'     => [
                'required',
                'string',
                'max:100'
            ],
            'email'    => [
                'required',
                'email',
                'unique:users',
                'max:100'
            ],
            'password' => [
                'required',
                'min:6',
                'max:15'
            ],
           'station' => [
                userRole() == 'Super Admin' ? 'required' : '',
                userRole() == 'Super Admin' ? 'integer' : '',
            ],            
            'roles'  => [
                'integer',
                'in:'.$in
            ],
        ];
    }
}
