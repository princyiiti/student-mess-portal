<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/home')}}" class="brand-link">
        <img src="{{ asset('/img/logo.jpg')}}" alt="IITI" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Student Affairs Portal </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('/img/profile.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"> {{auth()->user()->name!=null ? auth()->user()->name : "Administrator"}}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @if(auth()->user()->role_id===6)
                <li class="nav-item">
                        <a href="#" class="nav-link menu-open">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Mess Fees Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="{{ url('/admin/messlist') }}" class="nav-link {{ request()->path() === 'admin/messlist' ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Mess List </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/user/importcsv') }}" class="nav-link {{ Request::routeIs('admin/user/importcsv') ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Import Mess Subcription Data</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('/admin/student_mess_data') }}" class="nav-link {{ request()->path() === 'admin/student_mess_data' ? 'active' : '' }}  ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Mess Subcription Details</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/rebate') }}" class="nav-link {{ request()->path() === 'admin/rebate' ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Student Rebate List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('custom_demo_list') }}" class="nav-link {{ request()->path() === 'custom_demo_list' ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Student Mess Rebate Report</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/subcription') }}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Subcription list </p>
                                </a>
                            </li>

                            <!-- <li class="nav-item">
                                <a href="{{ url('/admin/slot') }}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Slot Type </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/role') }}" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Role List </p>
                                </a>
                            </li> -->
                        </ul>
                    </li>

                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>