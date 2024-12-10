@extends('layouts.app')

@section('title', 'Dashboard - Manage Customers')

@section('page-content')
<div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-sm-6 ps-0">
            <h3>Manage Customers</h3>
          </div>
          <div class="col-sm-6 pe-0">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                  <svg class="stroke-icon">
                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                  </svg></a></li>
              <li class="breadcrumb-item">Manage Customers</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid basic_table">
      <div class="row">
        <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3>My Customers</h3><span>List of all customers.</span>
              </div>
              <div class="table-responsive custom-scrollbar">
                <table class="table table-inverse">
                    <thead>
                      <tr class="border-bottom-light">
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Total Orders</th>
                        <th scope="col">Joined At</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($customers as $customer)
                      <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->purchases->count() }}</td> <!-- Counting related purchases -->
                        <td>{{ $customer->created_at->format('d M Y') }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

              </div>
            </div>
          </div>
      </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection
