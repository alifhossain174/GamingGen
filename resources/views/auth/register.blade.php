{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
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

@extends('layouts.app')

@section('content')
<div class="wrap-login100">
    <div class="login100-form-title" style="background-image: url({{url('/')}}/login_assets/images/bg-01.jpg);">
        <span class="login100-form-title-1">
            Gaming Gen Sign Up
        </span>
    </div>


    <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
            <span class="label-input100">Name</span>
            <input id="name" type="text" class="input100 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter Full Name" required autocomplete="name" autofocus>
            <span class="focus-input100">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </span>
        </div>

        <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
            <span class="label-input100">Email</span>
            <input id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email" required autocomplete="email" autofocus>
            <span class="focus-input100">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </span>
        </div>

        <div class="wrap-input100 validate-input m-b-26" data-validate="phone is required">
            <span class="label-input100">Contact</span>
            <input id="phone" type="text" class="input100 @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Enter phone" autocomplete="phone" required autofocus>
            <span class="focus-input100">
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </span>
        </div>

        <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
            <span class="label-input100">Password</span>
            <input id="password" type="password" class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Enter password" required autocomplete="new-password">
            <span class="focus-input100">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </span>
        </div>

        <div class="wrap-input100 validate-input m-b-18">
            <span class="label-input100">Confirm</span>
            <input id="password-confirm" type="password" class="input100" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="wrap-input100 validate-input m-b-26" data-validate="Refferal is required">
            <span class="label-input100">Referral Code</span>
            <input id="referral_code" type="text" class="input100 @error('referral_code') is-invalid @enderror" name="referral_code" value="{{ old('referral_code') }}" placeholder="Enter Referral Code" autocomplete="referral_code" autofocus>
            <span class="focus-input100">
                @error('referral_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </span>
        </div>

        <div class="flex-sb-m w-full p-b-30">
            <div>
                <a class="txt1" href="{{ route('login') }}">
                    Already have an account
                </a>
            </div>
        </div>

        <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn">
                Register
            </button>
        </div>
    </form>


</div>
@endsection



