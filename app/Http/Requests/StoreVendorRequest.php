<?php

namespace App\Http\Requests;

use App\Models\vendor_create;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreVendorRequest extends FormRequest
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
            'email'    => [
                'required',
                'email',
                'unique:users',
                'max:100'
            ],
            'password' => [
                'required',
                'min:6',
                'max:15'
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
