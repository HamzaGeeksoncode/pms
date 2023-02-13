<?php

namespace App\Http\Requests;

use App\Models\Vendor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateVendorRequest extends FormRequest
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
            'u_id'     => [
                'required',
                'integer',
            ],            

            'password' => [
                request()->password ? 'min:6' : '',
                request()->password ? 'max:15' : ''
            ],            
            'company_name'    => [
                'required',
                'string',
                'max:100'
            ],
            'address'    => [
                'required',
                'string',
                'max:1000',
            ], 
            'price'    => [
                'required',
                'numeric',
            ],                       
        ];
    }
}
