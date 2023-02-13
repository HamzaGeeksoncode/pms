<?php

namespace App\Http\Requests;

use App\Models\Fuel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreClientRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'     => [
                'required',
                'string',
                'max:600',
            ],
            'company_name'    => [
                'required',
                'string',
                'max:600',
            ],
            // 'pay_type'    => [
            //     'required',
            //     'string',
            //     'in:credit,debit',
            // ],            
            'contact_number_1'    => [
                'required',
                'string',
                'max:200',
            ],       
            'contact_number_2'    => [
                'string',
                'max:200',
            ],  
            'petrol_limit'    => [
                'in:daily,weekly,monthly,no_limit',
                'required',
            ],  
            'diesel_limit'    => [
                'in:daily,weekly,monthly,no_limit',
                'required',
            ],  
            'petrol_quan'     => [
                'required_without:diesel_quan'
            ],
            'diesel_quan'    => [               
                'required_without:petrol_quan'
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
