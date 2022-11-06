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
                                <h3 class="text-center mb-5"> Register Your Account </h3>
                              
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-start">{{ __('Name') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-start">{{ __('Email Address') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-start">{{ __('Confirm Password') }}</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                    
                                <div class="d-flex justify-content-around align-items-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                     <small> If you have an account, please <a href="/login" class="btn-link fs-6"> Login </a> to continue </small>

                                </div>
                          
                        </div>
                          
                            </form>
                            
                           </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection





{{-- @extends('frontend/layouts/app')

@section('content')
@php 
$categories = App\Models\Category::orderBy('id', 'desc')->limit(5)->get();
$second_categories = App\Models\Category::orderBy('id', 'desc')->offset(5)->limit(10)->get();
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
