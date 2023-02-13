@extends('admin.layouts.main')
@section('content')


    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Supply</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" action="{{ route('vendorFuel.store') }}" method="POST" novalidate enctype="multipart/form-data" >
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Vendor
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <select  class="form-control" id="vendor" name="vendor" required>
                                                        @foreach($vendors as $vendor)
                                                            <option value="{{ $vendor['id'] }}" >{{ $vendor["name"] }}</option>
                                                        @endforeach
                                                    </select> 
                                                    @if($errors->has('vendor'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('vendor') }} 
                                                        </span>
                                                    @endif                                                    
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="col-xl-6">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Petrol Quantity
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" value="{{ old('petrol_quantity', '') }}" name="petrol_quantity" class="form-control" placeholder="Petrol Quantity" >
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
                                                    <input type="number" value="{{ old('diesel_quantity', '') }}" name="diesel_quantity" class="form-control" placeholder="Diesel Quantity" >
                                                    @if($errors->has('diesel_quantity'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('diesel_quantity') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>    

                                        <div class="col-xl-6">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Petrol tank
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <select  class="form-control" id="petrol_tank" name="petrol_tank" required>
                                                        <option selected disabled >Please Select</option>
                                                        @foreach($tanks as $tank)
                                                            @if($tank['type'] == 'petrol')
                                                                <option value="{{ $tank['id'] }}" >{{ $tank['name'] }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select> 
                                                    @if($errors->has('petrol_tank'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('petrol_tank') }} 
                                                        </span>
                                                    @endif                                                    
                                                </div>
                                            </div>
                                        </div> 

                                        <div class="col-xl-6">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Diesel tank
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <select  class="form-control" id="diesel_tank" name="diesel_tank" required>
                                                        <option selected disabled >Please Select</option>
                                                        @foreach($tanks as $tank)
                                                            @if($tank['type'] == 'diesel')
                                                                <option value="{{ $tank['id'] }}" >{{ $tank['name'] }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select> 
                                                    @if($errors->has('diesel_tank'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('diesel_tank') }} 
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
                                                <div class="col-lg-12">
                                                    <input type="file"  name="file" class="form-control" placeholder="capacity" >
                                                    @if($errors->has('file'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('file') }} 
                                                        </span>
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


