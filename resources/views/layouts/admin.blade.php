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
                <div class="sidebar-heading text-center"> <a href="{{ route('home') }}">
                        <img src="/images/admin.png" alt="" class="my-4" style="width:150px" /></a>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin-dashboard') }}"
                        class="list-group-item list-group-item-action {{ request()->is('admin/dashboard*') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('admin-products') }}"
                        class="list-group-item list-group-item-action {{ request()->is('admin/products*') ? 'active' : '' }}">Race
                        Event</a>
                    <a href="{{ route('admin-') }}"
                        class="list-group-item list-group-item-action
                        {{ request()->is('admin/validation*') ? 'active' : '' }}">Validation
                        Race Event</a>
                    <a href="{{ route('category.index') }}"
                        class="list-group-item list-group-item-action {{ request()->is('admin/category*') ? 'active' : '' }}">Category
                        Race Event</a>
                    <a href="{{ route('transactions') }}"
                        class="list-group-item list-group-item-action {{ request()->is('admin/transaction*') ? 'active' : '' }}">Transactions</a>
                    <a href="{{ route('user.index') }}"
                        class="list-group-item list-group-item-action {{ request()->is('admin/user*') ? 'active' : '' }}">Users</a>
                    <a class="list-group-item list-group-item-action {{ request()->is('admin/logout*') ? 'active' : '' }}"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">{{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
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
                                            class="rounded-circle mr-2 profile-picture" />Hai, Saep </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('home') }}">Home</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">{{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                            <!-- Mobile Menu -->
                            <ul class="navbar-nav d-block d-lg-none">
                                <li class="nav-item">
                                    <a href="" class="nav-link d-inline-block"> Hi, Saep </a>
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
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
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
