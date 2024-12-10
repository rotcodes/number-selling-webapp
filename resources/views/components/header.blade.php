<div class="page-header">
    <div class="header-wrapper row m-0">
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light" src="{{ asset('assets/images/logo/logo-1.png') }}" alt=""><img class="img-fluid for-dark" src="assets/images/logo/logo.png" alt=""></a></div>
            <div class="toggle-sidebar">
                <svg class="sidebar-toggle">
                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-animation') }}"></use>
                </svg>
            </div>
            🇵🇸 Stand with Palestine. We stand for justice and peace.
        </div>
        <div class="nav-right col-xxl-7 col-xl-6 col-auto box-col-6 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus">
                <li class="onhover-dropdown">
                    <div class="notification-box">
                        <div class="flex-grow-1"><span>{{ Auth::user()->name }}</span>
                            <p class="mb-0">{{ Auth::user()->role }} <i class="middle fa fa-angle-down"></i></p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div mt-1">
                        <li><a href="{{ route('logout') }}"><i data-feather="log-in"> </i><span>Logout</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">
        <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
        <div class="ProfileCard-details">
        <div class="ProfileCard-realName">name</div>
        </div>
        </div>
      </script>
        <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
    </div>
</div>
