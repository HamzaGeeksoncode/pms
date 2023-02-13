@extends('admin.layouts.main')
@section('content')


    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ trans('cruds.common.add') }} {{ trans('cruds.clients.client') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" action="{{ route('clients.store') }}" method="POST" novalidate >
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">{{ trans('cruds.clients.name') }}
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ old('name', '') }}" name="name" class="form-control" placeholder="{{ trans('cruds.common.enter') }} {{ trans('cruds.clients.name') }}" required>
                                                    @if($errors->has('name'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('name') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-xl-6">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">{{ trans('cruds.clients.company_name') }}
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ old('company_name', '') }}" name="company_name" class="form-control" placeholder="{{ trans('cruds.common.enter') }} {{ trans('cruds.clients.company_name') }}" required>
                                                    @if($errors->has('company_name'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('company_name') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>   
                                        <div class="col-xl-6">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">{{ trans('cruds.clients.contact_number_1') }}
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ old('contact_number_1', '') }}" name="contact_number_1" class="form-control" placeholder="{{ trans('cruds.common.enter') }} {{ trans('cruds.clients.contact_number_1') }}" required>
                                                    @if($errors->has('contact_number_1'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('contact_number_1') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-xl-6">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">{{ trans('cruds.clients.contact_number_2') }}
                                                <span class="text-danger"></span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ old('contact_number_2', '') }}" name="contact_number_2" class="form-control" placeholder="{{ trans('cruds.common.enter') }} {{ trans('cruds.clients.contact_number_2') }}" required>
                                                    @if($errors->has('contact_number_2'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('contact_number_2') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>   
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Payment Type
                                                <span class="text-danger"></span>
                                            </label>          
                                                                              
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="checkbox" name="pay_type" name="pay_type">  Allow Credit Payment
                                                    <!-- <select  class="form-control" id="pay_type" name="pay_type" required>
                                                        <option seleted value="credit" >Credit</option>
                                                        <option value="debit" >Debit</option>
                                                    </select>  -->
                                                    <!-- @if($errors->has('pay_type'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('pay_type') }} 
                                                        </span>
                                                    @endif -->
                                                </div>
                                            </div>
                                        </div>                                         
                                        <h3>Petrol</h3>                                                                                                                  
                                        <div class="col-xl-12 ">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">{{ trans('cruds.clients.fuel_limit') }}
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <select  class="form-control" id="petrol_limit" name="petrol_limit" required>
                                                        <option selected value="no_limit">No Limit</option>
                                                        <option value="daily" >{{ trans('cruds.clients.daily') }}</option>
                                                        <option value="weekly" >{{ trans('cruds.clients.weekly') }}</option>
                                                        <option value="monthly" >{{ trans('cruds.clients.monthly') }}</option>
                                                    </select> 
                                                    @if($errors->has('petrol_limit'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('petrol_limit') }} 
                                                        </span>
                                                    @endif                                                    
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Petrol Discount
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" value="{{ old('petrol_discount', '') }}" name="petrol_discount" class="form-control" placeholder="Petrol Discount" required>
                                                    @if($errors->has('petrol_discount'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('petrol_discount') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Petrol Quantity
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" value="{{ old('petrol_quan', '') }}" name="petrol_quan" class="form-control" placeholder="Diesel Discount" required>
                                                    @if($errors->has('petrol_quan'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('petrol_quan') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>                                                                              
                                                  

                                        <h3>Diesel</h3>                                                                                                                  
                                        <div class="col-xl-12 ">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">{{ trans('cruds.clients.fuel_limit') }}
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <select  class="form-control" id="diesel_limit" name="diesel_limit" >
                                                        <option selected value="no_limit">No Limit</option>
                                                        <option value="daily" >{{ trans('cruds.clients.daily') }}</option>
                                                        <option value="weekly" >{{ trans('cruds.clients.weekly') }}</option>
                                                        <option value="monthly" >{{ trans('cruds.clients.monthly') }}</option>
                                                    </select> 
                                                    @if($errors->has('diesel_limit'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('diesel_limit') }} 
                                                        </span>
                                                    @endif                                                    
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Diesel Discount
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" value="{{ old('diesel_discount', '') }}" name="diesel_discount" class="form-control" placeholder="Diesel Discount" required>
                                                    @if($errors->has('diesel_discount'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('diesel_discount') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Diesel Quantity
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" value="{{ old('diesel_quan', '') }}" name="diesel_quan" class="form-control" placeholder="Diesel Discount" required>
                                                    @if($errors->has('diesel_quan'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('diesel_quan') }} 
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
@section('scripts')
<script type="text/javascript">
    
    var petrolCounter = 1;
    var dieselCounter = 1;

    function addPetrolDiscount(){
        petrolCounter+=1;
        $("#petrol_discount_append").append(`
                <div class="col-lg-6" id='petrol_remove_1`+petrolCounter+`'>

                    <input type="number" name="petrol_discount[]" value="" class="form-control"  placeholder="Enter discount (in percent %) " required>
             
                </div> 
                 <div class="col-lg-6" id='petrol_remove_2`+petrolCounter+`'>
                    <button type="button" onclick="removeDiscount('petrol',`+petrolCounter+`)" class="btn btn-outline-primary btn-sm">Remove</button>
                 </div>
            `)
      
    }
    function addDieselDiscount(){
        dieselCounter+=1;
        $("#diesel_discount_append").append(`
                <div class="col-lg-6" id='diesel_remove_1`+dieselCounter+`'>

                    <input type="number" name="diesel_discount[]" value="" class="form-control"  placeholder="Enter discount (in percent %) " required>
             
                </div> 
                 <div class="col-lg-6" id='diesel_remove_2`+dieselCounter+`'>
                    <button type="button"  onclick="removeDiscount('diesel',`+dieselCounter+`)" class="btn btn-outline-primary btn-sm">Remove</button>
                 </div>
            `)
      
    }    
    function removeDiscount(type,no){
        $("#"+type+"_remove_2"+no).remove();
        $("#"+type+"_remove_1"+no).remove();
    }

</script>
@endsection

