<?php

namespace App\Http\Requests;

use App\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateReadingRequest extends FormRequest
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
                'string'
            ],
            'fuel_type'     => [
                'required',
                'in:petrol,diesel'
            ],
            'initial_reading'     => [
                'required',
                'numeric'
            ],     
            // 'total_litre'     => [
            //     'required',
            //     'numeric'
            // ],                             
        ];
    }
}
