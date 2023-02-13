@extends('admin.layouts.main')
@section('content')


    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Supply</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                               <form class="needs-validation" action="{{ route('vendorFuel.update',[$vendorFuel['id']]) }}" method="POST" enctype="multipart/form-data"  >
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Vendor
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                 <input class="form-control" type="text" disabled value="{{ $vendorFuel->vendors->name }}">  
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="col-xl-6">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Petrol Quantity
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ old('petrol_quantity', $vendorFuel['petrol_quantity']) }}" name="petrol_quantity" disabled class="form-control" placeholder="Petrol Quantity" >
                                                    @if($errors->has('petrol_quantity'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('petrol_quantity') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-xl-6">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Diesel Quantity
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ old('diesel_quantity', $vendorFuel['diesel_quantity']) }}" name="diesel_quantity" disabled class="form-control" placeholder="Diesel Quantity" >
                                                    @if($errors->has('diesel_quantity'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('diesel_quantity') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>                                                                                

                                       <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Billing Attachment
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-6">
                                                    <input type="file"  name="file" class="form-control" placeholder="capacity" >
                                                    @if($errors->has('file'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('file') }} 
                                                        </span>
                                                    @endif               
                                                                                                                                       
                                                </div>
                                                <div class="col-lg-6">
                                                     @if(!empty($vendorFuel['attachment']))
                                                         <a target="_blank" href="{{ 
                                                            \URL('/').'/file/'.$vendorFuel['attachment'] 
                                                            }}" class="btn btn-success" >Show File</a>
                                                    @endif 
                                                </div>

                                            </div>
                                        </div>                                                                              



                                                    
<!--                                                                                 
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Image
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="file"  name="image" class="form-control" placeholder="Name" required>
                                                </div>
                                                @if($errors->has('image'))
                                                    <span class="form-reqs-error">
                                                       {{ $errors->first('image') }} 
                                                    </span>
                                                @endif                                                
                                            </div>
                                        </div> -->                                        
                                    </div>
                                    <div class="col-xl-0">                                           
                                        <div class="mb-0 row">
                                            <div class="col-lg-0 ms-auto">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>                                                                        
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


