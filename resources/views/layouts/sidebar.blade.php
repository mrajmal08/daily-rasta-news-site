<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" target="_blank" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Daily Rasta</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if( auth()->user()->role_id == '1')

                <li class="nav-item menu-open">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>

                </li>

                <li class="nav-item ">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user "></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('blogs.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-blog "></i>
                        <p>
                            Blogs
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('categories.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-table "></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('news.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            News
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('videos.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-video "></i>
                        <p>
                            Videos
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('ads.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-ad "></i>
                        <p>
                            Ads
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('gallary.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-image "></i>
                        <p>
                            Gallary Image
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('newspaper.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-newspaper "></i>
                        <p>
                            News Paper
                        </p>
                    </a>
                </li>

            @else
            <li class="nav-item menu-open">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('news.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        News
                    </p>
                </a>
            </li>

            <li class="nav-item ">
                <a href="{{ route('blogs.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-blog "></i>
                    <p>
                        Blogs
                    </p>
                </a>
            </li>

            <li class="nav-item ">
                <a href="{{ route('gallary.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-image "></i>
                    <p>
                        Gallary Image
                    </p>
                </a>
            </li>

            <li class="nav-item ">
                <a href="{{ route('newspaper.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-newspaper "></i>
                    <p>
                        News Paper
                    </p>
                </a>
            </li>

            @endif
                <div class="dropdown-divider"></div>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
