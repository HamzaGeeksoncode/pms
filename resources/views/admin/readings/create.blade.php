@extends('admin.layouts.main')
@section('content')

<style type="text/css">
    .JsonFuel{
        display: none;
    }
    .disabledInput {
        background-color: #e3e8e4 !important;
    }    
</style>
    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Reading</h4>
                        </div>
                        @if($errors->has('hose_error'))
                        <div class="card-header">
                            <span class="form-reqs-error">
                               {{ $errors->first('hose_error') }} 
                            </span>
                            </div>
                        @endif                          
                        <div class="card-body">
                            <div class="form-validation">
                                <form  onsubmit="return confirm('Please Confirm the reading , this can not be edited');" class="needs-validation" action="{{ route('readings.store') }}" method="POST"  >
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 row">
                                            <div class="col-lg-12">
                                                <select  class="form-control" id="name" name="name" required>
                                                    @foreach($users as $user)
                                                        <option value="{{ isset($user['id']) ? $user['id'] : '' }}">
                                                            {{ isset($user['name']) ? $user['name'] : '' }}
                                                        </option>
                                                    @endforeach
                                                </select> 
                                                @if($errors->has('name'))
                                                    <span class="form-reqs-error">
                                                       {{ $errors->first('name') }} 
                                                    </span>
                                                @endif                                                    
                                            </div>
                                        </div>
                                    @foreach($readingData as $tanks)
                                                                                  
                                        @foreach($tanks['pumps'] as $pump)
                                        
                                            <fieldset>
                                            <legend>{{ $pump['name'] }} ({{ isset($tanks['type']) ? $tanks['type'] : '' }})</legend> 
                                            @foreach($pump['hoses'] as $hose)
                                                <input type="hidden" value="{{ $tanks['id'] }}_{{ $pump['id'] }}_{{ $hose['id'] }}" name="tank_pump_hoose[]">
                                                
                                                <div class="col-xl-12">
                                                    <label class="col-lg-4 col-form-label" for="validationCustom07">Hose : {{ $hose['name'] }}
                                      
                                                    </label>                                            
                                                    <div class="mb-3 row">
                                                        <div class="col-lg-12">
                                                            <input type="text" value="{{ old('hoose_val', '') }}" name="hoose_val[]" class="form-control" placeholder="Enter Reading for hoose : {{ $hose['name'] }}" >
                                                            @if($errors->has('hoose_val'.$hose['id']))
                                                                <span class="form-reqs-error">
                                                                   {{ $errors->first('hoose_val'.$hose['id']) }} 
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            @endforeach
                                        @endforeach
                                    @endforeach                                     
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


