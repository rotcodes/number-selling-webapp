@extends('layouts.app')

@section('title', 'Dashboard - Welcome')

@section('page-content')
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6 p-0">
          <h3>Dashboard </h3>
        </div>
        <div class="col-sm-6 p-0">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('dashboard') }}">
                <svg class="stroke-icon">
                  <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                </svg>
              </a>
            </li>
            <li class="breadcrumb-item">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
    @include('components.message')
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid default-dashboard">
    <div class="row">
      <div class="col-xxl-4 col-xl-100 box-col-12 ps-4 pe-4 left-background">
        <div class="row bg-light h-100 p-3 pt-4 pb-4">
          <div class="col-12 col-xl-50 box-col-6">
            <div class="card welcome-card">
              <div class="card-body">
                <div class="d-flex">
                  <div class="flex-grow-1">
                    <h1>Hello, {{ Auth::user()->name }}</h1>
                    <p>Welcome!. Let's explore something that isn't available on surface :)</p>
                    <p class="btn">Explore new </p>
                  </div>
                  <div class="flex-shrink-0"> <img src="{{ asset('assets/images/dashboard/welcome.png') }}" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xxl-3 col-xl-50 col-md-6 box-col-6 proorder-xl-7">
            <div class="card review-slider">
              <div class="card-body">
                <div class="owl-carousel owl-theme owl-loaded owl-drag" id="owl-carousel-dashboard">
                  <div class="owl-stage-outer">
                    <div class="owl-stage"
                      style="transform: translate3d(-1139px, 0px, 0px); transition: all; width: 3990px;">
                      <div class="owl-item cloned" style="width: 559.906px; margin-right: 10px;">
                        <div class="review">
                          <div class="review">
                            <div>
                              <div class="review-content">
                                <h2>Unknown -</h2>
                              </div>
                              <p>“ Strong men don’t follow dreams, they hunt them. <br> Take control, make things happen.”
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span
                        aria-label="Previous">‹</span></button><button type="button" role="presentation"
                      class="owl-next"><span aria-label="Next">›</span></button></div>
                  <div class="owl-dots"><button role="button" class="owl-dot active"><span></span></button><button
                      role="button" class="owl-dot"><span></span></button><button role="button"
                      class="owl-dot"><span></span></button></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-12 col-md-6 notification-card">
      <div class="card custom-scrollbar">
        <div class="card-header card-no-border pb-0">
          <div class="header-top">
            <h4>My Orders History</h4>
          </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid basic_table mt-3">
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
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
    </div>
  </div>
</div>
@endsection
