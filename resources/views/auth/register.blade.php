@extends('layouts.app')
@section('content')
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <a href="{{route('login')}}"><h1>Petrol Station Management System</h1></a>
                                </div>
                                <h4 class="text-center mb-4">Sign in your account</h4>
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Name</strong></label>
                                        <input  name="name" value="{{ old('name', '') }}" autocomplete="off" type="text" class="form-control" >
                                        @if($errors->has('name'))
                                            <span class="form-reqs-error">
                                               {{ $errors->first('name') }} 
                                            </span>
                                        @endif
                                    </div>                                    
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Email</strong></label>
                                        <input  name="email" value="{{ old('email', '') }}" autocomplete="off" type="email" class="form-control" >
                                        @if($errors->has('email'))
                                            <span class="form-reqs-error">
                                               {{ $errors->first('email') }} 
                                            </span>
                                        @endif                                        
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="mb-1"><strong>Role</strong></label>                                        
                                        <select  name="role" class="default-select wide form-control">
                                            @foreach($roles as $role)
                                                <option value="{{ $role['id'] }}">{{ $role['title'] }}</option>
                                            @endforeach                                        
                                        </select> 
                                        @if($errors->has('role'))
                                            <span class="form-reqs-error">
                                               {{ $errors->first('role') }} 
                                            </span>
                                        @endif                                                                           
                                    </div>                                    
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Password</strong></label>
                                        <input  value="{{ old('password', '') }}" name="password" autocomplete="off" type="password" class="form-control" >
                                        @if($errors->has('password'))
                                            <span class="form-reqs-error">
                                               {{ $errors->first('password') }} 
                                            </span>
                                        @endif                                        
                                        
                                    </div>                                    
                                    <div class="row d-flex justify-content-between mt-4 mb-2">
                                        <div class="mb-3">
                                            <a href="{{ route('login') }}">Already have an account?</a>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection