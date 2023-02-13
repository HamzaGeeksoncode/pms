@extends('admin.layouts.main')
@section('content')


    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ trans('cruds.common.add') }} {{ trans('cruds.fuel.price') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" action="{{ route('fuel.store') }}" method="POST" novalidate >
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">{{ trans('cruds.fuel.price') }}
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" value="{{ old('price', '') }}" name="price" class="form-control" placeholder="price" required>
                                                    @if($errors->has('price'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('price') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">{{ trans('cruds.fuel.type') }} (i.e {{ trans('cruds.common.petrol') }},{{ trans('cruds.common.diesel') }})
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <select  class="form-control" id="type" name="type" required>
                                                        <option value="petrol" >{{ trans('cruds.common.petrol') }}</option>
                                                        <option value="diesel" >{{ trans('cruds.common.diesel') }}</option>
                                                    </select> 
                                                    @if($errors->has('type'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('type') }} 
                                                        </span>
                                                    @endif                                                    
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">{{ trans('cruds.fuel.price_change_date') }}
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="date" value="{{ old('price_change_date', '') }}" name="price_change_date" class="form-control" placeholder="date" required>
                                                    @if($errors->has('price_change_date'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('price_change_date') }} 
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


