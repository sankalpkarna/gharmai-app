        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Welcome <sup> {{Auth::user()->name}}</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Backend
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseServices"
                    aria-expanded="true" aria-controls="collapseServices">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Services</span>
                </a>
                <div id="collapseServices" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Services Components:</h6>
                        <a class="collapse-item" href="#">Add Service Category</a>
                        <a class="collapse-item" href="#">Service Categories List</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Providers Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Providers</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Providers Utilities:</h6>
                        <a class="collapse-item" href="admin/sbadmin/utilities-color.html">Colors</a>
                        <a class="collapse-item" href="admin/sbadmin/utilities-border.html">Borders</a>
                        <a class="collapse-item" href="admin/sbadmin/utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="admin/sbadmin/utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Customers Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Customers</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customers Utilities:</h6>
                        <a class="collapse-item" href="admin/sbadmin/utilities-color.html">Colors</a>
                        <a class="collapse-item" href="admin/sbadmin/utilities-border.html">Borders</a>
                        <a class="collapse-item" href="admin/sbadmin/utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="admin/sbadmin/utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Bookings Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBookings"
                    aria-expanded="true" aria-controls="collapseBookings">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Bookings</span>
                </a>
                <div id="collapseBookings" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Customers Utilities:</h6>
                        <a class="collapse-item" href="admin/sbadmin/utilities-color.html">Colors</a>
                        <a class="collapse-item" href="admin/sbadmin/utilities-border.html">Borders</a>
                        <a class="collapse-item" href="admin/sbadmin/utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="admin/sbadmin/utilities-other.html">Other</a>
                        <a class="collapse-item" href="admin/sbadmin/buttons.html">Buttons</a>
                        <a class="collapse-item" href="admin/sbadmin/cards.html">Cards</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="admin/sbadmin/login.html">Login</a>
                        <a class="collapse-item" href="admin/sbadmin/register.html">Register</a>
                        <a class="collapse-item" href="admin/sbadmin/forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="admin/sbadmin/404.html">404 Page</a>
                        <a class="collapse-item" href="admin/sbadmin/blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('user')}}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>User Management</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="{{asset('admin/img/undraw_rocket.svg')}}" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div>

        </ul>
        <!-- End of Sidebar -->