<!-- Sidebar -->
<ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(to bottom,var(--primary)0%,var(--secondry)100%)">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('admin/home')}}">
        <div class="sidebar-brand-icon rotate-n-15 col-10 col-md-5  overflow-hidden">
            <img class="w-100 mh-100" src="{{asset('assets/images/sonic-01.png')}}" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">Sprint </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{url('admin/home')}}">
            <i class="fa-solid fa-gauge-high"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{url('admin/statistics')}}">
            <i class="fa-regular fa-chart-user"></i>

            <span>Statistics</span></a>
    </li>

{{--    <!-- Divider -->--}}
{{--    <hr class="sidebar-divider">--}}

{{--    <!-- Heading -->--}}
{{--    <div class="sidebar-heading">--}}
{{--        Interface--}}
{{--    </div>--}}

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa-regular fa-cart-shopping"></i>
            <span>Orders</span>

        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{url('admin/orders')}}"><i class="fa-duotone fa-eye fa-lg"></i> View</a>
                <a class="collapse-item" href="{{url('admin/orders/create')}}"><i class="fa-duotone fa-plus fa-lg"></i> Create</a>
                <a class="collapse-item" href="{{url('admin/orders/running')}}"><i class="fa-duotone fa-list-check fa-lg"></i> Running Orders</a>
                <a class="collapse-item" href="{{url('admin/orders/pending')}}"><i class="fa-duotone fa-pause fa-lg"></i> Pending Orders</a>
                <a class="collapse-item" href="{{url('admin/orders/delivered')}}"><i class="fa-sharp fa-solid fa-badge-check fa-lg"></i> Delivered Orders</a>
                <a class="collapse-item" href="{{url('admin/orders/canceled')}}"><i class="fa-solid fa-xmark fa-lg"></i> Canceled Orders</a>
                <a class="collapse-item" href="{{url('admin/orders/today')}}"><i class="fa-duotone fa-calendar-week fa-lg "></i> Today's Orders</a>
            </div>
        </div>

    </li>



    <li class="nav-item active">
        <a class="nav-link" href="{{url('admin/users')}}">
            <i class="fa-regular fa-user"></i>

            <span>Users</span></a>
    </li>

{{--    <!-- Divider -->--}}
{{--    <hr class="sidebar-divider">--}}

{{--    <!-- Heading -->--}}
{{--    <div class="sidebar-heading">--}}
{{--        Addons--}}
{{--    </div>--}}

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="fa-regular fa-gears"></i>
            <span>Site settings</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
