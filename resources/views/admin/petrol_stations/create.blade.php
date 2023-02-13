@extends('admin.layouts.main')
@section('content')


    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ trans('cruds.common.add') }} {{ trans('cruds.common.petrol') }} {{ trans('cruds.common.station') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" action="{{ route('petrol-stations.store') }}" method="POST"  >
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">{{ trans('cruds.petrol_stations.name') }}
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ old('name', '') }}" name="name" class="form-control" placeholder="{{ trans('cruds.common.enter') }} {{ trans('cruds.petrol_stations.name') }}" required>
                                                    @if($errors->has('name'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('name') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">{{ trans('cruds.petrol_stations.address') }}
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="address" value="{{ old('address', '') }}" name="address" class="form-control" placeholder="{{ trans('cruds.common.enter') }} {{ trans('cruds.petrol_stations.address') }}" required>
                                                    @if($errors->has('address'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('address') }} 
                                                        </span>
                                                    @endif                                                    
                                                </div>
                                            </div>
                                        </div> 
                                       
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


