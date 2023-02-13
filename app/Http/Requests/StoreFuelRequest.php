<?php

namespace App\Http\Requests;

use App\Models\Fuel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreFuelRequest extends FormRequest
{
    // public function authorize()
    // {
    //     abort_if(Gate::denies('fuel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return true;
    // }

    public function rules()
    {
        return [
            'price'     => [
                'required',
                'numeric',
            ],
            'type'    => [
                'required',
                'string',
                'in:petrol,diesel'
            ],
            'price_change_date'    => [
                'required',
                'date',
            ],            
        ];
    }
}
