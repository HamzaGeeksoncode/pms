@extends('admin.layouts.main')
@section('content')


    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Reading</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" action="{{ route('readings.update',[$reading['id']]) }}" method="POST"  novalidate>
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Name
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ old('name', $reading['name']) }}" name="name" class="form-control" placeholder="Name" required>
                                                    @if($errors->has('name'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('name') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Fuel Type
                                                <span class="text-danger">*</span>
                                            </label>                                         
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <select  class="form-control" id="fuel_type" name="fuel_type" required>
                                                         <option {{ $reading['fuel_type'] == 'petrol' ? 'selected' : '' }} value="petrol" >{{ trans('cruds.common.petrol') }}</option>
                                                        <option {{ $reading['fuel_type'] == 'diesel' ? 'selected' : '' }} value="diesel" >{{ trans('cruds.common.diesel') }}</option>
                                                    </select> 
                                                    @if($errors->has('fuel_type'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('fuel_type') }} 
                                                        </span>
                                                    @endif 
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Initial Reading
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" value="{{ old('initial_reading', $reading['initial_reading']) }}" name="initial_reading" class="form-control" placeholder="Initial Reading" required>
                                                    @if($errors->has('initial_reading'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('initial_reading') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Final Reading
                                                <span class="text-danger"></span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" value="{{ old('final_reading', $reading['final_reading']) }}" name="final_reading" class="form-control" placeholder="Final Reading" >
                                                    @if($errors->has('final_reading'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('final_reading') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Total Litre
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" value="{{ old('total_litre', $reading['total_litre']) }}" name="total_litre" class="form-control" placeholder="total_litre" required>
                                                    @if($errors->has('total_litre'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('total_litre') }} 
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


