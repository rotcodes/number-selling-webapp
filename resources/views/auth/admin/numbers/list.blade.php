@extends('layouts.app')

@section('title', 'Dashboard - Manage Numbers')

@section('page-content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Numbers List</h3>
                </div>
                <div class="col-sm-6 pe-0 d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb me-3">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Numbers List</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-12 project-list">
            <div class="card">
              <div class="row">
                <div class="col-md-6 p-0">
                  <ul class="nav nav-tabs border-tab d-flex" id="top-tab" role="tablist">
                    <li class="nav-item" role="presentation"><p class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg></p></li>
                    <li class="nav-item" role="presentation"><p class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="8"></line></svg></p></li>
                    <li class="nav-item" role="presentation"><p class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></p></li>
                  </ul>
                </div>
                <div class="col-md-6 p-0">
                  <div class="form-group mb-0 me-0"></div><a class="btn btn-primary" href="{{ route('numbers.create') }}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>Create New Project</a>
                </div>
              </div>
            </div>
        </div>
        @include('components.message')
    </div>

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Scroll - vertical dynamic Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3>All Numbers</h3>
                        <span>This is all numbers you created.</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive custom-scrollbar user-datatable">
                            <table class="table table-dashed">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Number</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Details</th>
                                        <th scope="col">Available</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($numbers as $number)
                                    <tr>
                                        <td>{{ $number->id }}</td>
                                        <td>{{ $number->name }}</td>
                                        <td>RS: {{ $number->price }}</td>
                                        <td>{{ $number->description }}</td>
                                        <td>
                                            <span class="badge {{ $number->is_available == 1 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $number->is_available == 1 ? 'Yes' : 'Sold' }}
                                            </span>
                                        </td>
                                        <td>
                                            <ul class="action">
                                                <!-- Passing the unique ID for the modal -->
                                                <li class="edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $number->id }}" data-id="{{ $number->id }}">
                                                    <a href="#"><i class="icon-pencil-alt"></i></a>
                                                </li>
                                                <li class="delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $number->id }}" data-id="{{ $number->id }}">
                                                    <a href="#"><i class="icon-trash"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Scroll - vertical dynamic Ends-->
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
{{-- THIS MODAL CALL WHEN CLICK ON EDIT BUTTON --}}
@foreach ($numbers as $number)
<div class="modal fade" id="editModal{{ $number->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $number->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-toggle-wrapper social-profile text-start">
        <h3 class="modal-header justify-content-center border-0">Edit Number</h3>
        <div class="modal-body">
          <form class="row g-3" id="editForm{{ $number->id }}">
            @method('PUT')
            @csrf
            <div class="col-md-6">
              <label class="form-label" for="name{{ $number->id }}">Number</label>
              <input value="{{ $number->name }}" class="form-control" id="name{{ $number->id }}" name="name" type="text">
              <div></div>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="price{{ $number->id }}">Price</label>
              <input value="{{ $number->price }}" class="form-control" id="price{{ $number->id }}" name="price" type="text">
              <div></div>
            </div>
            <div class="col-md-12">
              <div class="mb-3">
                <label class="form-label" for="desc{{ $number->id }}">Description</label>
                <input value="{{ $number->description }}" class="form-control" id="desc{{ $number->id }}" name="desc" type="text">
                <div></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label" for="is_available{{ $number->id }}">Is Available</label>
                <select class="form-select" id="is_available{{ $number->id }}" name="is_available">
                    <option value="" {{ $number->is_available === null ? 'selected' : '' }}>Select availability</option>
                    <option value="0" {{ $number->is_available == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ $number->is_available == 1 ? 'selected' : '' }}>Yes</option>
                </select>
                <div></div>
              </div>
            </div>
            <div class="col-md-12">
              <button class="btn btn-primary" type="submit">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
{{-- THIS MODAL CALL WHEN CLICK ON EDIT BUTTON --}}

{{-- this modal calls when click on delete button --}}
@foreach ($numbers as $number)
<div class="modal fade" id="deleteModal{{ $number->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $number->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-toggle-wrapper text-center">
                    <ul class="modal-img">
                        <li>
                            <img src="{{ asset('assets/images/gif/danger.gif') }}" alt="error">
                        </li>
                    </ul>
                    <h4 class="text-center pb-2">Are you sure!, <br> You want to delete it?</h4>
                    <br>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-info me-2" type="button" data-bs-dismiss="modal">No</button>
                        <button class="btn btn-danger confirm-delete" data-id="{{ $number->id }}" type="button">Yes, I'm sure</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- this modal calls when click on delete button --}}
@endsection

@section('customJs')
<script>
    $(document).on('submit', '[id^="editForm"]', function(e){
        e.preventDefault();

        var formId = $(this).attr('id'); // Get the current form ID
        var numberId = formId.replace('editForm', ''); // Extract the number ID from the form ID

        $.ajax({
            url: '/account/numbers/' + numberId, // Assuming the route uses the number ID
            type: 'PUT',
            data: $(this).serialize(), // Serialize the form data
            dataType: 'json',
            success: function(response) {
                if (response.status == false) {
                    // Handle validation errors
                    var errors = response.errors;

                    // Validate fields
                    if (errors.name) {
                        $("#name" + numberId).addClass('is-invalid')
                            .siblings('div')
                            .addClass('invalid-feedback')
                            .html(errors.name);
                    } else {
                        $("#name" + numberId).removeClass('is-invalid')
                            .siblings('div')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    if (errors.price) {
                        $("#price" + numberId).addClass('is-invalid')
                            .siblings('div')
                            .addClass('invalid-feedback')
                            .html(errors.price);
                    } else {
                        $("#price" + numberId).removeClass('is-invalid')
                            .siblings('div')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    if (errors.desc) {
                        $("#desc" + numberId).addClass('is-invalid')
                            .siblings('div')
                            .addClass('invalid-feedback')
                            .html(errors.desc);
                    } else {
                        $("#desc" + numberId).removeClass('is-invalid')
                            .siblings('div')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                } else {
                    // On successful form submission
                    window.location.href = '{{ route("numbers.index") }}'; // Redirect
                }
            }
        });
    });


    // this is for delete method
    $(document).on('click', '.confirm-delete', function() {
        var numberId = $(this).data('id'); // Get the number ID

        $.ajax({
            url: '/account/numbers/' + numberId, // Assuming your route is set to use the number ID in the URL
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status) {
                    // Hide the modal after successful deletion
                    $('#deleteModal' + numberId).modal('hide');

                    // Reload the page after successful deletion
                    location.reload();

                } else {
                    alert('An error occurred while deleting the number.');
                }
            }
        });
    });

</script>
@endsection
