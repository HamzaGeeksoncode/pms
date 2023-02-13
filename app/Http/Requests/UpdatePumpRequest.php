<?php

namespace App\Http\Requests;

use App\Models\Fuel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePumpRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pump_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'     => [
                'required',
                'string',
                'max:200',
            ],
            'tank'     => [
                'required',
                'integer',
            ],            
        ];
    }
}
