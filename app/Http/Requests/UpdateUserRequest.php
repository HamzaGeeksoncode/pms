<?php

namespace App\Http\Requests;

use App\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserRequest extends FormRequest
{
    // public function authorize()
    // {
    //     abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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

            'password' => [
                request()->password ? 'min:6' : '',
                request()->password ? 'max:15' : ''
            ],
          

        ];
    }
}
