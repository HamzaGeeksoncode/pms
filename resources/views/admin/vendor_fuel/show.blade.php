@extends('admin.layouts.main')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    Vendor Fuel
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-primary" href="{{ route('vendorFuel.index') }}">
                                {{ trans('cruds.common.back_to_list') }}
                            </a>
                        </div>
                        <br>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        Serial No.
                                    </th>
                                    <td>
                                        {{ isset($vendorFuel->serial_no) ? $vendorFuel->serial_no : '' }}
                                    </td>
                                </tr>                                
                                <tr>
                                    <th>
                                        Vendor Name
                                    </th>
                                    <td>
                                        {{ isset($vendorFuel->vendors->name) ? $vendorFuel->vendors->name : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Petrol Quantity
                                    </th>
                                    <td>
                                        {{ isset($vendorFuel->petrol_quantity) ? $vendorFuel->petrol_quantity : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Diesel Quantity
                                    </th>
                                    <td>
                                        {{ isset($vendorFuel->diesel_quantity) ? $vendorFuel->diesel_quantity : '' }}
                                    </td>
                                </tr>   
                                <tr>
                                    <th>
                                        Petrol Tank
                                    </th>
                                    <td>
                                        {{ isset($vendorFuel->petrolTank->name) ? $vendorFuel->petrolTank->name : '' }}
                                    </td>
                                </tr> 
                                <tr>
                                    <th>
                                        Diesel Tank
                                    </th>
                                    <td>
                                        {{ isset($vendorFuel->dieselTank->name) ? $vendorFuel->dieselTank->name : '' }}
                                    </td>
                                </tr>                                                                 
                                <tr>
                                    <th>
                                        Price
                                    </th>
                                    <td>
                                        {{ isset($vendorFuel->price) ? $vendorFuel->price : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Attachement
                                    </th>
                                    <td>
                                        <a target="_blank" href="{{ \URL('/').'/file/'.$vendorFuel->attachment }}">
                                        <img width="100" height="100" src="{{ \URL('/').'/file/'.$vendorFuel->attachment }}">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Created By
                                    </th>
                                    <td>
                                        {{ isset($vendorFuel->users->name) ? $vendorFuel->users->name : '' }}
                                    </td>
                                </tr>                                                                                                                                                             
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
