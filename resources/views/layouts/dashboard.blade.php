<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @stack('prepen-style')
    @include('include.style')
    @stack('addon-style')

</head>

<body>
    <div class="page-dashboard">
        <div class="d-flex" id="wrapper" data-aos="fade-right">
            <!-- Side Bar -->
            <div class="border-right" id="sidebar-wrapper">
                <div class="sidebar-heading text-center">
                    <a href="{{ route('home') }}"><img src="/images/dashboard-logo.svg" alt=""
                            class="my-4" /></a>

                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }} "
                        class="list-group-item list-group-item-action {{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('dashboard/transactions') }}"
                        class="list-group-item list-group-item-action {{ request()->is('dashboard/transactions*') ? 'active' : '' }}">My
                        Race
                        Event</a>
                    <a href="{{ route('dashboard/validate') }}"
                        class="list-group-item list-group-item-action {{ request()->is('dashboard/validate*') ? 'active' : '' }}">Submision
                        Form</a>
                    <a href="{{ route('dashboard-settings-account') }}"
                        class="list-group-item list-group-item-action {{ request()->is('dashboard/account*') ? 'active' : '' }}">My
                        Account</a>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"
                        class="list-group-item list-group-item-action">Sign
                        Out</a>
                </div>
            </div>


            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top" data-aos="fade-down">
                    <div class="container-fluid">
                        <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">&laquo; Menu</button>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Desktop Menu -->
                            <ul class="navbar-nav d-none d-lg-flex ml-auto">
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link" id="navbarDropdown" role="button"
                                        data-toggle="dropdown"> <img src="/images/user-icon.png" alt=""
                                            class="rounded-circle mr-2 profile-picture" />Hai,
                                        {{ Auth::user()->name }} </a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('home') }}" class="dropdown-item">Home</a>
                                        <a href="{{ route('dashboard-settings-account') }}"
                                            class="dropdown-item">Settings</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();"
                                            class="dropdown-item">Logout</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                                        @php
                                            $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                                        @endphp
                                        @if ($carts > 0)
                                            <img src="/images/icon-chart-filled.svg" alt="" />
                                            <div class="card-badge">{{ $carts }}</div>
                                        @else
                                            <img src="/images/icon-chart-empty.svg" alt="" />
                                        @endif

                                    </a>
                                </li>
                            </ul>
                            <!-- Mobile Menu -->
                            <ul class="navbar-nav d-block d-lg-none">
                                <li class="nav-item">
                                    <a href="" class="nav-link d-inline-block"> Hi, {{ Auth::user()->name }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link d-inline-block"> Cart </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Secction Content -->
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    @stack('prepen-script')
    <script src="/vendor/jquery/jquery.slim.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        $('#menu-toggle').click(function(e) {
            e.preventDefault();
            $('#wrapper').toggleClass('toggled');
        });
    </script>
    <script>
        AOS.init();
    </script>
    @stack('addon-script')
</body>

</html>
