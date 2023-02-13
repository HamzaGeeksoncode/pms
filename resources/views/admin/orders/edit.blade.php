@extends('admin.layouts.main')
@section('content')

<style type="text/css">
    .JsonFuel{
        
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
                            <h4 class="card-title">Add Order</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" action="{{ route('order.update',[$order['id']]) }}" method="POST"  novalidate>
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div  class="col-xl-6 ">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Petrol Current Price
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ $price['petrolPrice'] }}" readonly  class="form-control disabledInput"  required>    
                                                </div>
                                            </div>
                                        </div>
                                        <div  class="col-xl-6 ">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Diesel Current Price
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ $price['dieselPrice'] }}" readonly  class="form-control disabledInput"  required>    
                                                </div>
                                            </div>
                                        </div>     
                                        <div  class="col-xl-6 ">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Date
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="date" value="{{ old('date', $order->date) }}" name="date"   class="form-control "  required> 

                                                    @if($errors->has('date'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('date') }} 
                                                        </span>
                                                    @endif       
                                                </div>
                                            </div>
                                        </div>                                                                                                                   
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Clients
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <select  class="form-control"  required id="client" name="client_id" required>
                                                            
                                                        @foreach($clients as $client)
                                                            <option {{ $client['id'] == $order->client_id ? 'selected' : '' }} value="{{ $client['id'] }}" >{{ $client['name'] }}</option>
                                                        @endforeach
                                                    </select> 
                                                    @if($errors->has('client'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('client') }} 
                                                        </span>
                                                    @endif                                                    
                                                </div>
                                            </div>
                                        </div>   
                                        <div  class="col-xl-6 JsonFuel">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Petrol Limit
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" readonly name="petrol_limit"  class="form-control disabledInput" value="{{ old('petrol_limit', $order->petrol_limit) }}" id="jsonPetrol"  required>    
                                                </div>
                                            </div>
                                        </div>
                                        <div  class="col-xl-6 JsonFuel">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Diesel Limit
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" readonly value="{{ old('diesel_limit', $order->diesel_limit) }}" name="diesel_limit"   class="form-control disabledInput" id="jsonDiesel"  required>    
                                                </div>
                                            </div>
                                        </div>      
                                        <div  class="col-xl-6 JsonFuel">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Petrol Discount (per litre)
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" readonly value="{{ old('petrol_discount', $order->petrol_discount) }}" name="petrol_discount"   class="form-control disabledInput" id="jsonDiesel"  required>                                                        
                                                </div>
                                            </div>
                                        </div>   
                                        <div  class="col-xl-6 JsonFuel">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Diesel Discount (per litre)
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">    
                                                    <input type="text" readonly value="{{ old('diesel_discount', $order->diesel_discount) }}" name="diesel_discount"   class="form-control disabledInput" id="jsonDiesel"  required>                                                  
                                                </div>
                                            </div>
                                        </div>  
                                        <div  class="col-xl-6 ">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Petrol Quantity
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" value="{{ old('petrol_quan', $order->petrol_quan) }}" name="petrol_quan" id="petrol_quan"   class="form-control petrolCal"   required>
                                                    @if($errors->has('petrol_quan'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('petrol_quan') }} 
                                                        </span>
                                                    @endif                                                           
                                                </div>
                                            </div>
                                        </div>
                                        <div  class="col-xl-6 ">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Diesel Quantity
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" value="{{ old('diesel_quan', $order->diesel_quan) }}" name="diesel_quan" id="diesel_quan"  class="form-control dieselCal"   required>
                                                    @if($errors->has('diesel_quan'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('diesel_quan') }} 
                                                        </span>
                                                    @endif                                                           
                                                </div>
                                            </div>
                                        </div> 
                                        <div  class="col-xl-6 ">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Petrol Total
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" value="{{ old('petrol_total', $order->petrol_total) }}"  readonly name="petrol_total" id="petrol_total"  class="form-control disabledInput"   required>
                                                    @if($errors->has('petrol_total'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('petrol_total') }} 
                                                        </span>
                                                    @endif                                                           
                                                </div>
                                            </div>
                                        </div>                                          
                                        <div  class="col-xl-6 ">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Diesel Total
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" value="{{ old('diesel_total', $order->diesel_total) }}" readonly name="diesel_total" id="diesel_total"  class="form-control disabledInput"   required>
                                                    @if($errors->has('diesel_total'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('diesel_total') }} 
                                                        </span>
                                                    @endif                                                           
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div  class="col-xl-6 ">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Petrol Price After Discount
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" value="{{ old('petrol_after_discount', $order->petrol_after_discount) }}"  readonly name="petrol_after_discount" id="petrol_discount_price"  class="form-control disabledInput"   required>
                                                    @if($errors->has('petrol_discount_price'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('petrol_discount_price') }} 
                                                        </span>
                                                    @endif                                                           
                                                </div>
                                            </div>
                                        </div>                                          
                                        <div  class="col-xl-6 ">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Diesel Price After Discount
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" value="{{ old('diesel_after_discount', $order->diesel_after_discount) }}" readonly name="diesel_after_discount" id="diesel_discount_price"  class="form-control disabledInput"   required>
                                                    @if($errors->has('diesel_discount_price'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('diesel_discount_price') }} 
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
@section('scripts')
@parent
    <script type="text/javascript">

    $("document").ready(function() {        
        var petrolDefaultPrice = "{{ $price['petrolPrice'] }}";
        var dieselDefaultPrice = "{{ $price['dieselPrice'] }}";
        $('.petrolCal').on('change', function() {
            var petrol =1;
            var petrolDis =0;
            var Petroldiscount=0;
            var Petroldiscounted=0;
            if($("#petrol_quan").val()){
                petrol_quan = $("#petrol_quan").val();
            }
            
            if($('#jsonPetrolDiscount').val()){
                petrolDis = $('#jsonPetrolDiscount').find(":selected").text();
            }
            let petrolTotalPrice = petrolDefaultPrice*petrol_quan;
            if(petrolDis!=0){
                Petroldiscount = petrolDis*petrol_quan;
            }
            if(Petroldiscount!=0){
                Petroldiscounted = petrolTotalPrice-Petroldiscount;
            }
            $("#petrol_total").val(petrolTotalPrice);            
            $("#petrol_discount_price").val(Petroldiscounted);
           
         
        });
        $('.dieselCal').on('change', function() {
            var diesel =1;
            var dieselDis =0;
            var dieselDiscount=0;
            var dieselDiscounted=0;
            if($("#diesel_quan").val()){
                diesel_quan = $("#diesel_quan").val();
            }
            
            if($('#jsonDieselDiscount').val()){
                dieselDis = $('#jsonDieselDiscount').find(":selected").text();
                console.log(dieselDis);
            }
            let DieselTotalPrice = dieselDefaultPrice*diesel_quan;
            if(dieselDis!=0){
                dieselDiscount = dieselDis*diesel_quan;
            }
            if(dieselDiscount!=0){
                dieselDiscounted = DieselTotalPrice-dieselDiscount;
            }
            $("#diesel_total").val(DieselTotalPrice);            
            $("#diesel_discount_price").val(dieselDiscounted);
           
         
        });      

        var details ;
        $('#client').on('change', function() {
            clientData();
        }); 
        
        function clientData(){
                var cId =  $("#client").find(":selected").val();
                alert(cId);
                $.ajax({
                url: '{{ route('order.getFuelDetails') }}',
                type: 'POST',
                data: {
                    "_token" : "{{ csrf_token() }}",
                    "dataType" : "JSON",
                    'data' : {
                        'c_id'       : cId,
                    },
                },
                success : function(data) {
                    details = JSON.parse(data);
                    if(details.length > 0){  
                        $(".JsonFuel").show();
                        $("#jsonPetrol").val(details[0]['petrol_limit']);
                        $("#jsonDiesel").val(details[0]['diesel_limit']);

                        $( JSON.parse(details[0]['petrol_discount'])).each(function( index ,val) {
                            $('#jsonPetrolDiscount').append($('<option>', {
                                value: val,
                                text: val
                            }));                          
                        });
                        $( JSON.parse(details[0]['diesel_discount'])).each(function( index ,val) {
                            $('#jsonDieselDiscount').append($('<option>', {
                                value: val,
                                text: val
                            }));                          
                        });                        
                    }
                },
                error : function(data) {
                    console.log(data);
                }
            });            
        } 
    });      
    </script>
@endsection

