@extends('admin.layouts.main')
@section('content')


    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add User</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" action="{{ route('users.store') }}" method="POST"  >
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Name
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ old('name', '') }}" name="name" class="form-control" placeholder="Name" required>
                                                    @if($errors->has('name'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('name') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Email
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ old('email', '') }}" name="email" class="form-control" placeholder="Email" required>
                                                    @if($errors->has('email'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('email') }} 
                                                        </span>
                                                    @endif                                                    
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Password
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="password" value="{{ old('password', '') }}" name="password" class="form-control" placeholder="Password" required>
                                                    @if($errors->has('password'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('password') }} 
                                                        </span>
                                                    @endif                                                    
                                                </div>
                                            </div>
                                        </div> 
                                                    
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Role
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <select  class="form-control" id="roles" name="roles"  required>
                                                        @foreach($roles as $role)
                                                            @if(session()->get('userRole') == "Super Admin") 
                                                                @if($role['title'] && $role['title'] == "Admin")
                                                                    <option  value="{{ $role['id']  }}" >{{ $role['title'] }}</option>
                                                                @endif     
                                                            @elseif(session()->get('userRole') == "Admin")  
                                                                @if($role['title'] && $role['title'] == "Cashier")
                                                                    <option  value="{{ $role['id']  }}" >{{ $role['title'] }}</option>
                                                                @endif        
                                                            @endif                                               
                                                        @endforeach

                                                    </select>    
                                                    @if($errors->has('roles'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('roles') }} 
                                                        </span>
                                                    @endif                                                    
                                                </div>
                                            </div>
                                        </div>
                                        @if(userRole()=="Super Admin")
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
                                        @endif
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
        $("#roles").select2();
        
        
   /*     $("#roles").on('change', function() {
            var hasIt = false;
            var selectedData = $('#roles').find(':selected');  
            if(selectedData[0]['innerText'] !== undefined && selectedData[0]['innerText'] == "Admin"){
                console.log(selectedData[0]['innerText'] );
                hasIt = true;
            }
            if(hasIt){
                $("#station-div").show();
                $( "#station" ).prop( "disabled", false );
            }else{
                $("#station-div").hide()            
                $( "#station" ).prop( "disabled", true );
            }                    
        }); */        
    </script>
@endsection


