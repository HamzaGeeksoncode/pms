@extends('admin.layouts.main')
@section('content')


    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Vendor</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" action="{{ route('vendors.update',[$vendor['id']]) }}" method="POST" novalidate  >
                                    @method('PUT')
                                    @csrf                                  
                                    <div class="row">
                                        <input type="hidden" value="{{  $user->id }}" name="u_id" class="form-control"  required>
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Password
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="password" value="{{ old('password', '') }}" name="password" class="form-control" placeholder="password" required>
                                                    @if($errors->has('password'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('password') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Name
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ old('name', $vendor['name']) }}" name="name" class="form-control" placeholder="name" required>
                                                    @if($errors->has('name'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('name') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Price
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ old('price', $vendor['price']) }}" name="price" class="form-control" placeholder="price" required>
                                                    @if($errors->has('price'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('price') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>                                         
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Company Name
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ old('company_name', $vendor['company_name']) }}" name="company_name" class="form-control" placeholder="Company Name" required>
                                                    @if($errors->has('company_name'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('company_name') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Address
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ old('address', $vendor['address']) }}" name="address" class="form-control" placeholder="Address" required>
                                                    @if($errors->has('address'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('address') }} 
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


