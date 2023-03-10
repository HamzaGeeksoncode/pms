<?php

namespace App\Http\Requests;

use App\Models\Vendor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePetrolStationRequest extends FormRequest
{
    // public function authorize()
    // {
    //     abort_if(Gate::denies('vendor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return true;
    // }

    public function rules()
    {
        return [
            'name'     => [
                'required',
                'string',
                'max:100',
            ],
            'address'     => [
                'required',
                'string',
                'max:200',
            ],                       
        ];
    }
}
