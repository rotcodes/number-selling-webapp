@extends('layouts.app')
@section('title', 'Login to your account')

@section('page-content')
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card login-dark">
                <div>
                    <div>
                        <a class="logo" href="index.html">
                            <img class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo.png') }}" alt="login page">
                        </a>
                    </div>
                    <div class="login-main">
                        <form class="theme-form" id="loginForm" method="POST" action="{{ route('authenticate') }}">
                            @csrf
                            <h3>Sign in to account</h3>
                            <p>Enter your details to access website.</p>
                            @include('components.message')
                            <div class="form-group">
                                <label class="col-form-label">Email Address</label>
                                <input class="form-control" value="{{ old('email') }}" type="email" id="email" name="email" placeholder="Test@gmail.com">
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Password</label>
                                <div class="form-input position-relative">
                                    <input class="form-control" type="password" id="password" name="password" placeholder="*********">
                                    <div class="show-hide"><span class="show"></span></div>
                                </div>
                                @error('password')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mt-1">
                                <!-- reCAPTCHA Widget -->
                                {!! htmlFormSnippet() !!}
                                <!-- Div for displaying reCAPTCHA error -->
                                @error('g-recaptcha-response')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                            <div class="form-group mb-0">
                                <button class="btn btn-primary btn-block w-100 mt-2" type="submit">Sign In</button>
                            </div>
                            <p class="mt-4 mb-0 text-center">
                                Don't have account?
                                <a class="ms-2" href="{{ route('register') }}">Create Account</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
