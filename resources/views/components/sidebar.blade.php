<div class="sidebar-wrapper" data-layout="fill-svg">
    <div>
        <div class="logo-wrapper">
            <a href="index.html">
                <img class="img-fluid" src="{{ asset('assets/images/logo/logo.png') }}" alt="">
            </a>
            <div class="toggle-sidebar">
                <svg class="sidebar-toggle">
                    <use href="{{ asset('assets/svg/icon-sprite.svg#toggle-icon') }}"></use>
                </svg>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="{{ route('dashboard') }}">
                <img class="img-fluid" src="{{ asset('assets/images/logo/logo-icon.png') }}" alt="">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <a href="{{ route('dashboard') }}">
                            <img class="img-fluid" src="{{ asset('assets/images/logo/logo-icon.png') }}" alt="">
                        </a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan-1">General</h6>
                        </div>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav {{ request()->routeIs(['dashboard']) ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                            </svg>
                            <span class="lan-3">Dashboards</span>
                            <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                        </a>
                    </li>
                    @if (Auth::user()->role == 'admin')
                    {{-- admin area --}}
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Admin Area</h6>
                        </div>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title {{ request()->routeIs(['numbers.index', 'numbers.create', 'numbers.edit']) ? 'active' : '' }}" href="{{ route('numbers.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-animation') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-animation') }}"></use>
                            </svg>
                            <span>Manage Numbers</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title {{ request()->routeIs(['manageUsers']) ? 'active' : '' }}" href="{{ route('manageUsers') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-task') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-task') }}"></use>
                            </svg>
                            <span>Manage Customers</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title {{ request()->routeIs(['manageOrders']) ? 'active' : '' }}" href="{{ route('manageOrders') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-learning') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-learning') }}"></use>
                            </svg>
                            <span>Manage Orders</span>
                        </a>
                    </li>
                    {{-- admin area --}}
                    @endif
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan-8">Numbers Section</h6>
                        </div>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title {{ request()->routeIs(['showNumbers']) ? 'active' : '' }}" href="{{ route('showNumbers') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-contact') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-contact') }}"></use>
                            </svg>
                            <span>Numbers List</span>
                        </a>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Universities & Colleges Database Leaks (PK)</h6>
                        </div>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="javascript:void(0);" onclick="showComingSoonMessage()" disabled>
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-others') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-others') }}"></use>
                            </svg>
                            <span>Database List 🔥</span>
                        </a>
                    </li>

                    <script>
                        function showComingSoonMessage() {
                            alert('COMING SOON, STAY TUNED!');
                        }
                    </script>


                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="">My Profile</h6>
                        </div>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title {{ request()->routeIs(['myOrders']) ? 'active' : '' }}" href="{{ route('myOrders') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
                            </svg>
                            <span>My Orders</span>
                        </a>

                        <a class="sidebar-link sidebar-title" href="{{ route('logout') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-user') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-user') }}"></use>
                            </svg>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
