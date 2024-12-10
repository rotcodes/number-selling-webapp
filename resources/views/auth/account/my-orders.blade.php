@extends('layouts.app')

@section('title', 'Dashboard - My Orders')

@section('page-content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>My Orders</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">My Orders</li>
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
                        <h3>Your Order History</h3>
                    </div>
                    <div class="card-block row">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="table-responsive custom-scrollbar">
                                <table class="table table-dashed">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Number</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Purchase Date</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($purchases as $purchase)
                                        <tr>
                                            <td>{{ $purchase->id }}</td>
                                            <td>{{ $purchase->number->name }}</td>
                                            <td>RS: {{ $purchase->total_price }}</td>
                                            <td>{{ $purchase->created_at->format('d M Y, h:i A') }}</td>
                                            <td>
                                                <span class="badge bg-{{ $purchase->order_status === 'completed' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($purchase->order_status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No orders found.</td>
                                        </tr>
                                        @endforelse
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
@endsection
