@extends('layouts.app')

@section('title', 'Dashboard - Show Numbers')

@section('page-content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>All Available numbers shown below</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Numbers List</li>
                    </ol>
                </div>
            </div>
        </div>
        @include('components.message')
        <div class="card alert alert-primary" role="alert">
            <h3 class="mt-1 text-white">(We don't take payment first)</h3>
            <p class="mt-1 text-white">اپنی پسند کا نمبر منتخب کریں، منتخب کرنے کے بعد پروسیس مکمل کریں۔ کچھ دیر میں ایڈمن آپ سے رابطہ کر لے گا۔ شکریہ! پیسے پہلے نہیں لیے جائیں گے، ہم پہلے آپ سے تصدیق کریں گے اور پھر پیمنٹ کا عمل شروع کریں گے۔
            </p>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid basic_table">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Choose any number and tap on buy it to purchase.</h3>
                    </div>
                    <div class="card-block row">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="table-responsive custom-scrollbar">
                                <table class="table table-dashed">
                                    <thead>
                                        <tr>
                                            <th scope="col">Number</th>
                                            <th scope="col">Details</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Is Available</th>
                                            <th scope="col">Buy</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($numbers as $number)
                                        <tr>
                                            <td>{{ $number->name }}</td>
                                            <td>{{ $number->description }}</td>
                                            <td>RS: {{ $number->price }}</td>
                                            <td>
                                                <span class="badge {{ $number->is_available == 1 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $number->is_available == 1 ? 'Yes' : 'Sold' }}
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button"
                                                        class="btn btn-info btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#buyModal{{ $number->id }}"
                                                        {{ $number->is_available == 0 ? 'disabled' : '' }}>
                                                    Buy it
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>

@foreach ($numbers as $number)
<div class="modal fade" id="buyModal{{ $number->id }}" tabindex="-1" aria-labelledby="buyModalLabel{{ $number->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buyModalLabel{{ $number->id }}">Buy Number: {{ $number->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>You've chosen the number: {{ $number->name }}</p>
                <p>Price: RS {{ $number->price }}</p>
                <form id="buyForm{{ $number->id }}" action="{{ route('buy.number', $number->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="name{{ $number->id }}">Your name</label>
                        <input class="form-control" id="name{{ $number->id }}" name="name" type="text">
                        <div></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="phone{{ $number->id }}">Your phone number (use whatsapp number only)</label>
                        <input class="form-control" type="number" id="phone{{ $number->id }}" name="phone" type="text">
                        <div></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@section('customJs')
<script>
    $(document).on('submit', '[id^="buyForm"]', function(e) {
        e.preventDefault();
        var form = $(this);
        var numberId = form.attr('id').replace('buyForm', '');

        // Reset previous error messages
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.invalid-feedback').empty();

        $.ajax({
            url: form.attr('action')
            , type: 'POST'
            , data: form.serialize()
            , dataType: 'json'
            , success: function(response) {
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

                    if (errors.phone) {
                        $("#phone" + numberId).addClass('is-invalid')
                            .siblings('div')
                            .addClass('invalid-feedback')
                            .html(errors.phone);
                    } else {
                        $("#phone" + numberId).removeClass('is-invalid')
                            .siblings('div')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                } else {
                    // On successful form submission
                    window.location.href = '{{ route("showNumbers") }}'; // Redirect
                }
            }
        });
    });

</script>
@endsection
