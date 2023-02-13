@extends('admin.layouts.main')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit User</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" action="{{ route('users.update',[$user['id']]) }}" method="POST"  >
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Name
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ old('name', $user['name']) }}" name="name" class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Name" required>
                                                    @if($errors->has('name'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('name') }} 
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
                                                    <input type="password" value="" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Password" >
                                                    @if($errors->has('password'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('password') }} 
                                                        </span>
                                                    @endif                                                    
                                                </div>
                                            </div>
                                        </div> 
                                                    
     <!--                                    <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Role
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <select  class="form-control select2" id="roles" name="roles[]"  required>

                                                        @foreach($roles as $role)
                                                            @if(session()->get('userRole') == "Super Admin") 
                                                                @if($role['title'] && $role['title'] == "Admin")
                                                                    <option {{ (in_array($role['id'] , old('roles', [])) || $user->roles->contains($role['id']))  ? 'selected' : '' }}  value="{{ $role['id']  }}" >{{ $role['title'] }}</option>
                                                                @endif     
                                                            @elseif(session()->get('userRole') == "Admin")  
                                                                @if($role['title'] && $role['title'] == "Cashier")
                                                                    <option {{ (in_array($role['id'] , old('roles', [])) || $user->roles->contains($role['id']))  ? 'selected' : '' }}  value="{{ $role['id']  }}" >{{ $role['title'] }}</option>
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
                                        </div> -->
                                      
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
    </script>
@endsection
