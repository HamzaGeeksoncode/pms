<?php

namespace App\Http\Requests;

use App\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class RegisterRequest extends FormRequest
{
    // public function authorize()
    // {
    //     abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return true;
    // }

    public function rules()
    {
        return [
            'name'     => [
                'required',
                'string',
                'max:20'
            ],
            'email'    => [
                'required',
                'email',
                'unique:users',
            ],
            'password' => [
                'required',
                'min:6',
                'max:15'
            ],
            'role'  => [
                'integer',
            ],
        ];
    }
}
