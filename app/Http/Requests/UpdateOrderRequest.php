<?php

namespace App\Http\Requests;

use App\Models\Fuel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateOrderRequest extends FormRequest
{
    // public function authorize()
    // {
    //     abort_if(Gate::denies('tank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return true;
    // }

    public function rules()
    {
        return [
            'client_id'     => [
                'required',
                'integer'
            ],
            'date'    => [               
                'required',
                'date_format:Y-m-d'
            ],
        ];
    }

   

 
}
