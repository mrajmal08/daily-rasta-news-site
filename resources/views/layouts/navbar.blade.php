 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                    class="fas fa-bars"></i></a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown d-sm-inline-block text-right">
             <!-- Notifications Dropdown Menu -->
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 w-25"
                style="opacity: .8;margin-top: -7px;">

                {{-- <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span> --}}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
                <div class="dropdown-divider"></div>

            </div>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link"> {{ Auth::user()->name }}</a>
        </li>



        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
