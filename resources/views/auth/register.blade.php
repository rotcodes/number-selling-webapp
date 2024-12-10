@extends('layouts.app')

@section('title', 'Create Your Account')

@section('page-content')
<div class="row m-0">
    <div class="col-12 p-0">
        <div class="login-card login-dark">
            <div>
                <div>
                    <a class="logo" href="index.html">
                        <img class="img-fluid for-light" src="{{ asset('assets/images/logo/logo-1.png') }}" alt="login page">
                        <img class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo.png') }}" alt="login page">
                    </a>
                </div>
                <div class="login-main">
                    <form name="registrationForm" id="registrationForm" class="theme-form" action="">
                        @csrf
                        <h4>Create your account</h4>
                        <p>Enter your personal details to create an account</p>

                        <div class="form-group">
                            <label class="col-form-label pt-0">Your Name</label>
                            <input class="form-control" type="text" name="name" id="name" placeholder="Your Name" autocomplete="off">
                            <div></div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Email Address</label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="Test@gmail.com">
                            <div></div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">WhatsApp Number (For good customer support)</label>
                            <input class="form-control" type="number" name="phone" id="phone" placeholder="123456789">
                            <div></div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Password</label>
                            <div class="form-input position-relative">
                                <input class="form-control" type="password" id="password" name="password" placeholder="*********">
                                <div class="show-hide"><span class="show"></span></div>
                            </div>
                            <div id="passwords"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Confirm Password</label>
                            <div class="form-input position-relative">
                                <input class="form-control" type="password" id="confirm_password" name="confirm_password" placeholder="*********">
                                <div class="show-hide"><span class="show"></span></div>
                            </div>
                            <div id="confirm_passwords"></div>
                        </div>

                        <div class="form-group">
                            <!-- reCAPTCHA Widget -->
                            {!! htmlFormSnippet() !!}
                            <!-- Div for displaying reCAPTCHA error -->
                            <div id="g-recaptcha-response-error" class="text-danger"></div> <!-- Error placeholder for reCAPTCHA -->
                        </div>


                        <div class="form-group mb-0">
                            <button class="btn btn-primary btn-block w-100 mt-2" type="submit">Create Account</button>
                        </div>

                        <p class="mt-4 mb-0">Already have an account?
                            <a class="ms-2" href="{{ route('login') }}">Login</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customJs')
<script>
    $("#registrationForm").submit(function(e){
        e.preventDefault();

        $.ajax({
            url: '{{ route("processRegister") }}',
            type: 'post',
            data: $("#registrationForm").serializeArray(),
            dataType: 'json',
            success: function(response) {
                if (response.status == false) {
                    var errors = response.errors;

                    // Name field validation
                    if (errors.name) {
                        $("#name").addClass('is-invalid')
                            .siblings('div')
                            .addClass('invalid-feedback')
                            .html(errors.name);
                    } else {
                        $("#name").removeClass('is-invalid')
                            .siblings('div')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    // Email field validation
                    if (errors.email) {
                        $("#email").addClass('is-invalid')
                            .siblings('div')
                            .addClass('invalid-feedback')
                            .html(errors.email);
                    } else {
                        $("#email").removeClass('is-invalid')
                            .siblings('div')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    // Phone field validation
                    if (errors.phone) {
                        $("#phone").addClass('is-invalid')
                            .siblings('div')
                            .addClass('invalid-feedback')
                            .html(errors.phone);
                    } else {
                        $("#phone").removeClass('is-invalid')
                            .siblings('div')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    // Password field validation
                    if (errors.password) {
                        $("#passwords")
                            .addClass('text-danger') // Add the error class
                            .html(errors.password);  // Set the error message
                    } else {
                        $("#passwords")
                            .removeClass('text-danger') // Remove the error class if no error
                            .html('');  // Clear any existing error message
                    }

                    // Confirm Password field validation
                    if (errors.confirm_password) {
                        $("#confirm_passwords")
                            .addClass('text-danger')
                            .html(errors.confirm_password);
                    } else {
                        $("#confirm_passwords")
                            .removeClass('text-danger')
                            .html('');
                    }

                    // reCAPTCHA field validation
                    if (errors['g-recaptcha-response']) {
                        $("#g-recaptcha-response-error")
                            .addClass('text-danger') // Add the error class
                            .html(errors['g-recaptcha-response'][0]);  // Set the error message
                    } else {
                        $("#g-recaptcha-response-error")
                            .removeClass('text-danger') // Remove the error class if no error
                            .html('');  // Clear any existing error message
                    }

                    // Reset the reCAPTCHA after validation failure
                    if (typeof grecaptcha !== 'undefined') {
                        grecaptcha.reset(); // Reset the reCAPTCHA widget on failure
                    }

                } else {
                    // On successful form submission
                    $("#name").removeClass('is-invalid')
                        .siblings('div')
                        .removeClass('invalid-feedback')
                        .html('');

                    $("#email").removeClass('is-invalid')
                        .siblings('div')
                        .removeClass('invalid-feedback')
                        .html('');

                    $("#password").removeClass('text-danger')
                        .siblings('div')
                        .html('');

                    $("#confirm_password").removeClass('text-danger')
                        .siblings('div')
                        .html('');

                    $("#g-recaptcha-response-error").removeClass('text-danger')
                        .siblings('div')
                        .html('');

                    // Reset the reCAPTCHA on success (optional, in case user navigates back)
                    if (typeof grecaptcha !== 'undefined') {
                        grecaptcha.reset();
                    }

                    // Redirect on successful form submission
                    window.location.href = '{{ route("login") }}';
                }
            }

        });
    });
</script>
@endsection
