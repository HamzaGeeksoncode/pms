<?php

namespace App\Http\Requests;

use App\Models\Fuel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreVendorFuelRequest extends FormRequest
{
    // public function authorize()
    // {
    //     abort_if(Gate::denies('tank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return true;
    // }

    public function rules()
    {
        return [
            'petrol_quantity'     => [
                'required_without:diesel_quantity'
            ],
            'diesel_quantity'    => [               
                'required_without:petrol_quantity'
            ],
        ];
    }

    public function messages()
    {
        return [
            'petrol_quantity.required_without' => 'Atleast one field is required in Petrol and Diesel',
            'diesel_quantity.required_without' => 'Atleast one field is required in Petrol and Diesel',
        ];
    }    

 
}
