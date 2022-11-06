@extends('frontend/layouts/app')
@section('title', 'Login')
@section('content')
<style>
    body {
        background: #a7a8d3;
    }
    .login {
        border-radius: 50px;
        box-shadow:  20px 20px 60px #4a4da9,
                -20px -20px 60px #a7a8d3;
    } 
    .container., .login-bar {
        border-radius: 50px;
    }

    #login_img img {
        border-top-left-radius: 50px;
        border-bottom-left-radius: 50px;
    }

    .login-bar img {
        width: 30px;
        height: 30px;
        border-radius: 30px;
    }


</style>
@php 
$categories = App\Models\Category::orderBy('id', 'desc')->limit(5)->get();
$second_categories = App\Models\Category::orderBy('id', 'desc')->offset(5)->limit(10)->get();
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 login">
                <div class="row shadow-lg">
                    <div class="col-md-6" id="login_img">
                        <img src="/images/login.png" alt="" width="100%">
                    </div>
                    <div class="col-md-6 align-items-center" style="margin-top: 5%">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <h3 class="text-center mb-5"> Login To Your Account </h3>
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-start">{{ __('Email Address') }}</label>
        
                                    <div class="col-md-8">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-start">{{ __('Password') }}</label>
        
                                    <div class="col-md-8">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                
                                        <div class="form-check d-flex justify-content-between align-items-center">
                                            <div>
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                            </div>
                                           <div class="col-md-6">
                                            @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                           </div>
                                        @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">
                                            {{ __('Login') }}
                                        </button>
                                    
                            </form>
                            <p class="text-center"> <small>OR </small></p>
                            <p class="text-center"><small> ----------------------------- login with -------------------------</small> </p>
                            <div class="d-flex login-bar justify-content-around">
                                <a href="/auth/google/redirect"> <img src="/images/google.png" alt=""></a>
                                <a href="/auth/facebook/redirect"><img src="/images/facebook.png" alt=""></a>
                                <a href=""> <img src="/images/twitter.png" alt=""></a>
                            </div>
                           <div class="d-flex mt-3">
                            <p class="me-3"> New User? </p> <a href="/register" class="text-muted"> SignUp </a>
                           </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
