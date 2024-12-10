@extends('layouts.app')

@section('title', 'Dashboard - Manage Orders')

@section('page-content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Manage Orders</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Manage Orders</li>
                    </ol>
                </div>
            </div>
        </div>
        @include('components.message')
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid basic_table">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Orders</h3><span>List of all orders.</span>
                    </div>
                    <div class="table-responsive custom-scrollbar">
                        <table class="table table-inverse">
                            <thead>
                                <tr class="border-bottom-light">
                                    <th scope="col">Name</th>
                                    <th scope="col">Customer Email</th>
                                    <th scope="col">Customer Phone</th>
                                    <th scope="col">Number Purchased</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->name }}</td> <!-- Customer Name -->
                                    <td>{{ $order->user->email }}</td> <!-- Customer Email -->
                                    <td>{{ $order->phone }}</td> <!-- Customer Phone -->
                                    <td>{{ $order->number->name }}</td> <!-- Purchased Number -->
                                    <td>RS: {{ $order->number->price }}</td> <!-- Number Price -->
                                    <td>
                                        @if ($order->order_status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif ($order->order_status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($order->order_status) }}</span> <!-- Default badge for other statuses -->
                                        @endif
                                    </td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td> <!-- Order Date -->
                                    <td>
                                        <ul class="action">
                                            <!-- Passing the unique ID for the modal -->
                                            <li class="edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $order->id }}">
                                                <a href="#"><i class="icon-pencil-alt"></i></a>
                                            </li>
                                            <li class="delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $order->id }}">
                                                <a href="#"><i class="icon-trash"></i></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $order->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $order->id }}" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $order->id }}">Edit Order</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <form id="editForm{{ $order->id }}" action="{{ route('orders.update', $order->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <!-- Order Status Field -->
                                            <div class="mb-3">
                                                <label for="order_status{{ $order->id }}" class="form-label">Order Status</label>
                                                <select class="form-select" id="order_status{{ $order->id }}" name="order_status">
                                                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $order->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $order->id }}" aria-hidden="true">
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
                                              <button class="btn btn-danger confirm-delete" data-id="{{ $order->id }}" type="button">Yes, I'm sure</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-3 mb-2">
                            {{ $orders->links() }}
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
    // This function handles the form submission for editing orders.
    $(document).on('submit', '[id^="editForm"]', function(e){
        e.preventDefault();

        var formId = $(this).attr('id'); // Get the current form ID
        var orderId = formId.replace('editForm', ''); // Extract the order ID from the form ID

        $.ajax({
            url: '/account/orders/' + orderId, // Assuming the route uses the order ID
            type: 'PUT',
            data: $(this).serialize(), // Serialize the form data
            dataType: 'json',
            success: function(response) {
                if (response.status == false) {
                    // Handle validation errors
                    var errors = response.errors;

                    // Validate fields (Order Status)
                    if (errors.order_status) {
                        $("#order_status" + orderId).addClass('is-invalid')
                            .siblings('div')
                            .addClass('invalid-feedback')
                            .html(errors.order_status);
                    } else {
                        $("#order_status" + orderId).removeClass('is-invalid')
                            .siblings('div')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                } else {
                    // On successful form submission
                    window.location.href = '{{ route("manageOrders") }}'; // Redirect back to the orders page
                }
            }
        });
    });

    // This function handles the deletion of an order via AJAX
    $(document).on('click', '.confirm-delete', function() {
        var orderId = $(this).data('id'); // Get the order ID

        $.ajax({
            url: '/account/orders/' + orderId, // Assuming your route is set to use the order ID in the URL
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status) {
                    // Hide the modal after successful deletion
                    $('#deleteModal' + orderId).modal('hide');

                    // Reload the page after successful deletion
                    location.reload();

                } else {
                    alert('An error occurred while deleting the order.');
                }
            }
        });
    });

</script>
@endsection

