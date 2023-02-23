<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-fw fa-building"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Gharmai <br>Admin</div>
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
        Main
    </div>

    @role('admin|superadmin')

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
                <a class="collapse-item" href="{{route('service.create')}}">Add Service </a>
                <a class="collapse-item" href="{{route('service')}}">Service List</a>
            </div>
        </div>
    </li>

   
    <!-- Nav Item - Providers Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('provider')}}">
            <i class="fas fa-user-cog"></i>
            <span>Providers</span>
        </a>
    </li>

    <!-- Nav Item - Providers Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('customer')}}">
            <i class="fas fa-fw fa-user-tie"></i>
            <span>Customers</span>
        </a>
    </li>

    @endrole

    <!-- Nav Item - Bookings Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBookings"
            aria-expanded="true" aria-controls="collapseBookings">
            <i class="fas fa-fw fa-table"></i>
            <span>Bookings</span>
        </a>
        <div id="collapseBookings" class="collapse" aria-labelledby="headingBookings" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Bookings:</h6>
                <a class="collapse-item" href="{{route('booking.create')}}">Add Booking</a>
                <a class="collapse-item" href="{{route('booking')}}">Booking List</a>
              
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @role('superadmin')

    <!-- Heading -->
    <div class="sidebar-heading">
        Settings
    </div>
    <!-- Nav Item - User Management Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUserManagement"
            aria-expanded="true" aria-controls="collapseUserManagement">
            <i class="fas fa-fw fa-user"></i>
            <span>User Management</span>
        </a>
        <div id="collapseUserManagement" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User Management:</h6>
                <a class="collapse-item" href="{{route('user')}}">Users</a>
                <a class="collapse-item" href="{{route('role')}}">Roles</a>
                <a class="collapse-item" href="{{route('permission')}}">Permissions</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Utilities:</h6>
                <a class="collapse-item" href="{{route('coupon')}}">Coupons</a>
                <a class="collapse-item" href="{{route('document')}}">Documents</a>
                <a class="collapse-item" href="{{route('slider')}}">Sliders</a>
                <a class="collapse-item" href="{{route('tax')}}">Taxes</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{URL::to('admin/sbadmin/charts.html')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Analytics</span>
        </a>
    </li>


    <!-- Nav Item - Settings Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('setting')}}">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Settings</span>
        </a>
      
    </li>           

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    @endrole

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
