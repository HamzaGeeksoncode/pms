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
                            <h4 class="card-title">Add Order</h4>
                        </div>                        
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" id='orderForm' action="{{ route('order.store') }}" method="POST" novalidate >
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
                                                    <input type="date" value="{{ old('date', '') }}" name="date"   class="form-control "  required> 

                                                    @if($errors->has('date'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('date') }} 
                                                        </span>
                                                    @endif       
                                                </div>
                                            </div>
                                        </div>                      



                                        <div id='corporate' class="row"  >                                    
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Clients
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <select  class="form-control" required id="client" name="client_id" required>
                                                            <option selected disabled>Select</option>
                                                        @foreach($clients as $client)
                                                            <option value="{{ $client['id'] }}" >{{ $client['name'] }}</option>
                                                        @endforeach
                                                    </select> 
                                                    @if($errors->has('client_id'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('client_id') }} 
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
                                                    <input type="text" readonly name="petrol_limit"  class="form-control disabledInput petrolClass" id="jsonPetrol"  required>    
                                                </div>
                                            </div>
                                        </div>
                                        <div  class="col-xl-6 JsonFuel">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Diesel Limit
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" readonly name="diesel_limit"   class="form-control disabledInput dieselClass" id="jsonDiesel"  required>    
                                                </div>
                                            </div>
                                        </div>  
                                        <div  class="col-xl-6 JsonFuel">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Petrol Quantity Limit
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" readonly name=""  class="form-control disabledInput petrolClass" id="jsonPetrolQuan"  required>    
                                                </div>

                                            </div>
                                        </div>
                                        <div  class="col-xl-6 JsonFuel">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Diesel Quantity Limit
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" readonly name=""   class="form-control disabledInput dieselClass" id="jsonDieselQuan"  required>    
                                                </div>
                                            </div>
                                        </div> 
                                        <div  class="col-xl-6 JsonFuel">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Petrol Remaining Limit 
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" readonly name=""  class="form-control disabledInput petrolClass" id="jsonpetrolOldConsum"  required>    
                                                </div>
                                            </div>
                                        </div>
                                        <div  class="col-xl-6 JsonFuel">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Diesel Remaining Limit
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" readonly name=""   class="form-control disabledInput dieselClass" id="jsondieselOldConsum"  required>    
                                                </div>
                                            </div>
                                        </div>

                                        <div  class="col-xl-12 JsonFuel">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Pay Type
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" readonly name=""   class="form-control disabledInput" id="jsonPayType"  required>    
                                                </div>
                                            </div>
                                        </div>                                                                                                                           
                                        <div  class="col-xl-6 JsonFuel">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Petrol Discount (per litre)
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <select  class="form-control petrolCal petrolClass" name="petrol_discount" id="jsonPetrolDiscount"  >
                                                        <option value="none" disabled selected>Select Discount Here</option> 
                                                    </select>
                                                </div>
                                            </div>
                                        </div>   
                                        <div  class="col-xl-6 JsonFuel">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Diesel Discount (per litre)
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">    
                                                    <select  class="form-control dieselCal  dieselClass" name="diesel_discount" id="jsonDieselDiscount"  >
                                                        <option value="none" disabled selected>Select Discount Here</option> 
                                                    </select>                                                    
                                                </div>
                                            </div>
                                        </div>  
                                        <div  class="col-xl-6 ">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Petrol Quantity
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" name="petrol_quan" id="petrol_quan"   class="form-control petrolCal petrolClass"   required>
                                                    @if($errors->has('petrol_quan'))
                                                        <span id='petrolQuanError' class="form-reqs-error">
                                                           {{ $errors->first('petrol_quan') }} 
                                                        </span>
                                                    @else
                                                    <span style="color:red" id='petrolQuanError'> </span>                                                        
                                                    @endif  
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div  class="col-xl-6 ">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Diesel Quantity
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="number" name="diesel_quan" id="diesel_quan"  class="form-control dieselCal dieselClass"   required>
                                                    @if($errors->has('diesel_quan'))
                                                        <span id='dieselQuanError' class="form-reqs-error">
                                                           {{ $errors->first('diesel_quan') }} 
                                                        </span>
                                                    @else
                                                    <span style="color:red" id='dieselQuanError'> </span>                                                       
                                                    @endif    
                                                </div>
                                            </div>
                                        </div> 
                                        <div  class="col-xl-6 ">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Petrol Hose
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">    
                                                    <select  class="form-control petrolClass" name="petrol_hose"   >
                                                        <option value="none" disabled selected>Select hose here</option> 
                                                        @foreach($petrolHose as $val)
                                                        <option value="{{ $val['hose_id'] }}">
                                                            Tank : {{ $val['tank_name'] }} , Pump : {{ $val['pump_name'] }} , Hose : {{ $val['hose_name'] }}
                                                        </option>
                                                        @endforeach
                                                    </select>  
                                                    @if($errors->has('petrol_hose'))
                                                        <span id='petrol_hose_error' class="form-reqs-error">
                                                           {{ $errors->first('petrol_hose') }} 
                                                        </span>
                                                    @endif                                                                                                      
                                                </div>
                                            </div>
                                        </div>                                         
                                        <div  class="col-xl-6 ">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Diesel Hose
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">    
                                                    <select  class="form-control dieselClass" name="diesel_hose"   >
                                                        <option value="none" disabled selected>Select hose here</option> 
                                                        @foreach($dieselHose as $val)
                                                        <option value="{{ $val['hose_id'] }}">
                                                            Tank : {{ $val['tank_name'] }} , Pump : {{ $val['pump_name'] }} , Hose : {{ $val['hose_name'] }}
                                                        </option>
                                                        @endforeach
                                                    </select>  
                                                    @if($errors->has('diesel_hose'))
                                                        <span id='diesel_hose_error' class="form-reqs-error">
                                                           {{ $errors->first('diesel_hose') }} 
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
                                                    <input type="number" readonly name="petrol_total" id="petrol_total"  class="form-control disabledInput petrolClass"   required>
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
                                                    <input type="number" readonly name="diesel_total" id="diesel_total"  class="form-control disabledInput dieselClass"   required>
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
                                                    <input type="number" readonly name="petrol_after_discount" id="petrol_discount_price"  class="form-control disabledInput petrolClass"   required>
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
                                                    <input type="number" readonly name="diesel_after_discount" id="diesel_discount_price"  class="form-control disabledInput dieselClass"   required>
                                                    @if($errors->has('diesel_discount_price'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('diesel_discount_price') }} 
                                                        </span>
                                                    @endif                                                           
                                                </div>
                                            </div>
                                        </div>                                                                                        </div> 

                                
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
                var cId =  $(this).find(":selected").val();
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
                        console.log(details);
                 

                        if(details[0]['petrol_quan']==null){
                            $("input.petrolClass").attr("disabled", "disabled");
                        }
                        if(details[0]['diesel_quan']==null){
                            $("input.dieselClass").attr("disabled", "disabled");
                        }                        
                        $(".JsonFuel").show();
                        $("#jsonPetrol").val(details[0]['petrol_limit']);
                        $("#jsonDiesel").val(details[0]['diesel_limit']);
                        $("#jsonPetrolQuan").val(details[0]['petrol_quan']);
                        $("#jsonDieselQuan").val(details[0]['diesel_quan']);
                        $("#jsonPayType").val(details[0]['pay_type']);
                        $("#jsonpetrolOldConsum").val(details[0]['remaining_petrol_quan']);
                        $("#jsondieselOldConsum").val(details[0]['remaining_diesel_quan']);

                        $( JSON.parse(details[0]['petrol_discount'])).each(function( index ,val) {
                            $('#jsonPetrolDiscount').append($('<option>', {
                                value: val,
                                text: val
                            }));                          
                        });
                        $( JSON.parse(details[0]['diesel_discount'])).each(function( index ,val) {
                            $('#jsondieselDiscount').append($('<option>', {
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
        }); 

        
        $("#orderForm").submit(function(e){
            if($("#jsonPayType").val()=="debit"){
                if(!remainingPetrolQuan()){
                    e.preventDefault();
                }
                 if(!remainingDieselQuan()){
                    e.preventDefault();
                }           
            }
             
        });

        function remainingPetrolQuan(){
            
            if($("#jsonpetrolOldConsum").val() == 0){
                return false;
            }
            var previousRemain =  $("#jsonpetrolOldConsum").val()  - $("#petrol_quan").val();
            var newRemain = previousRemain 
            if(newRemain >= 0){
                $("#petrolQuanError").html("");
                return true;
            }
            else{
                $("#petrolQuanError").html("Limit Exceeds");
                return false;                
            }      
        }   

        function remainingDieselQuan(){
            
       
            if($("#jsondieselOldConsum").val() == 0){
                return false;
            }
            var previousRemain =  $("#jsondieselOldConsum").val()  - $("#diesel_quan").val();
            var newRemain = previousRemain 
            if(newRemain >= 0){
                $("#dieselQuanError").html("");
                return true;
            }
            else{
                $("#dieselQuanError").html("Limit Exceeds");
                return false;                
            } 
        }               
    </script>
@endsection

