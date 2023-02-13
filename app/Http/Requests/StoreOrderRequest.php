<?php

namespace App\Http\Requests;

use App\Models\Fuel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreOrderRequest extends FormRequest
{
    // public function authorize()
    // {
    //     abort_if(Gate::denies('tank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return true;
    // }

    public function rules()
    {
        return [

            'date'    => [               
                'required',
                'date_format:Y-m-d'
            ],
            'client_id'    => [               
                'required',
                'integer'
            ],   
            'petrol_quan'     => [
                'required_without:diesel_quan'
            ],
            'diesel_quan'    => [               
                'required_without:petrol_quan'
            ],   
            'petrol_hose'     => [
                'required_without:diesel_hose'
            ],
            'diesel_hose'    => [               
                'required_without:petrol_hose'
            ],                              
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'The client field is required',
            'petrol_quan.required_without' => 'Atleast one field is required in Petrol and Diesel',
            'diesel_quan.required_without' => 'Atleast one field is required in Petrol and Diesel',            
            'petrol_hose.required_without' => 'Atleast one field is required in Petrol hose and Diesel hose',
            'diesel_hose.required_without' => 'Atleast one field is required in Petrol hose and Diesel hose',            
        ];
    }      

 
}
