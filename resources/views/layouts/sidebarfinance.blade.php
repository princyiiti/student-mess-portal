<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/home')}}" class="brand-link">
        <img src="{{ asset('/img/logo.jpg')}}" alt="IITI" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Finance Portal </span>
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

                @if(auth()->user()->role_id===4)
        
                <li class="nav-item">
                        <a href="{{ url('/home') }}" class="nav-link menu-open">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Fees Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="{{ url('/admin/feetype') }}" class="nav-link {{ request()->path() === 'admin/feetype' ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Create Fee Type </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/feestructure') }}" class="nav-link {{ request()->path() === 'admin/feestructure' ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Create Fee Structure</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/studenttotalfee') }}" class="nav-link {{ request()->path() === 'admin/studenttotalfee' ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Student Fee Allocations</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/feesallocations') }}" class="nav-link {{ Request::routeIs('admin/feesallocations') ? 'active' : '' }}  ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Assigned Fee Details</p>
                                </a>  
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('/admin/student-master-fee-details') }}" class="nav-link {{ Request::routeIs('admin/student-master-fee-details') ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Fee Payment Report</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/fee-report') }}" class="nav-link {{ Request::routeIs('admin/fee-report') ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Custom Report</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>