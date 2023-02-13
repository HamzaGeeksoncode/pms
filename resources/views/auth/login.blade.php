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
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf

                                    @if($errors->has('messageLogin'))
                                       <span class="form-reqs-error">
                                           {{ $errors->first('messageLogin') }} 
                                        </span>
                                    @endif
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Email</strong></label>
                                        <input autocomplete="off" type="Email" name="email" class="form-control" placeholder="Email">
                                       
                                    </div> 
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Password</strong></label>
                                        <input autocomplete="off" type="password" name="password" class="form-control" placeholder="Password">
                                                                         
                                    </div>   
                                                                                       
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Login</button>
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