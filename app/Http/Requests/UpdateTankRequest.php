<?php

namespace App\Http\Requests;

use App\Models\Fuel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateTankRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'     => [
                'required',
                'string',
                'max:40',
            ],
            'capacity'    => [
                'required',
                'integer',
                'max:100000',
            ],
                     
            'type'    => [
                'required',
                'string',
                'in:petrol,diesel'
            ],
        ];
    }
}
