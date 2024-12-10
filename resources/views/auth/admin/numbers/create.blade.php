@extends('layouts.app')

@section('title', 'Dashboard - Add new number')

@section('page-content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Create Number</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Create New Number</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-12 project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 p-0">
                        <ul class="nav nav-tabs border-tab d-flex" id="top-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <p class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <circle cx="12" cy="12" r="6"></circle>
                                        <circle cx="12" cy="12" r="2"></circle>
                                    </svg></p>
                            </li>
                            <li class="nav-item" role="presentation">
                                <p class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12" y2="8"></line>
                                    </svg></p>
                            </li>
                            <li class="nav-item" role="presentation">
                                <p class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather arrow-left">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg></p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 p-0">
                        <div class="form-group mb-0 me-0"></div>
                        <a class="btn btn-primary" href="{{ route('numbers.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>Back
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <h3>Number form</h3>
                        <p class="f-m-light mt-1">
                            Create numbers here to show on user side.
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="card-wrapper border rounded-3">
                            <form class="row g-3" name="numberForm" id="numberForm">
                                <div class="col-md-12">
                                    <label class="form-label" for="name">Number</label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Enter Number">
                                    <div></div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="price">Number Price</label>
                                    <input class="form-control" id="price" name="price" type="number" placeholder="RS">
                                    <div></div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="is_available">Is Available</label>
                                    <select class="form-select" id="is_available" name="is_available">
                                        <option value="" selected>Select availability</option>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                    <div></div>
                                </div>
                                <div class="col">
                                    <div>
                                        <label class="form-label" for="desc">Number Description</label>
                                        <textarea placeholder="Enter number description" class="form-control btn-square" id="desc" name="desc" rows="3"></textarea>
                                        <div></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Save </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection

@section('customJs')
<script>
    $("#numberForm").submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: '{{ route("numbers.store") }}'
            , type: 'post'
            , data: $("#numberForm").serializeArray()
            , dataType: 'json'
            , success: function(response) {
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
                    if (errors.price) {
                        $("#price").addClass('is-invalid')
                            .siblings('div')
                            .addClass('invalid-feedback')
                            .html(errors.price);
                    } else {
                        $("#price").removeClass('is-invalid')
                            .siblings('div')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    // Phone field validation
                    if (errors.desc) {
                        $("#desc").addClass('is-invalid')
                            .siblings('div')
                            .addClass('invalid-feedback')
                            .html(errors.desc);
                    } else {
                        $("#desc").removeClass('is-invalid')
                            .siblings('div')
                            .removeClass('invalid-feedback')
                            .html('');
                    }


                    if (errors.is_available) {
                        $("#is_available").addClass('is-invalid')
                            .siblings('div')
                            .addClass('invalid-feedback')
                            .html(errors.is_available);
                    } else {
                        $("#is_available").removeClass('is-invalid')
                            .siblings('div')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                } else {
                    // On successful form submission
                    $("#name").removeClass('is-invalid')
                        .siblings('div')
                        .removeClass('invalid-feedback')
                        .html('');

                    $("#price").removeClass('is-invalid')
                        .siblings('div')
                        .removeClass('invalid-feedback')
                        .html('');

                    $("#desc").removeClass('text-danger')
                        .siblings('div')
                        .html('');

                    $("#is_available").removeClass('text-danger')
                        .siblings('div')
                        .html('');

                    // Redirect on successful form submission
                    window.location.href = '{{ route("numbers.index") }}';
                }
            }

        });
    });

</script>
@endsection
