@extends('admin.layouts.main')
@section('content')


    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Tank</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" action="{{ route('tanks.store') }}" method="POST" novalidate >
                                    @csrf
                                    <div class="row">                                        
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Type
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
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Station
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <select  class="form-control" id="station" name="station" required>
                                                        @foreach($stations as $station )
                                                            <option value="{{ isset($station['id']) ? $station['id'] : '' }}" >{{ isset($station['name']) ? $station['name'] : '' }}</option>
                                                        @endforeach
                                                    </select> 
                                                    @if($errors->has('station'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('station') }} 
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


