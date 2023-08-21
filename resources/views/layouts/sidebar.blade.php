<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/home')}}" class="brand-link">
    <img src="{{ asset('/img/logo.jpg')}}" alt="IITI" class="brand-image img-circle elevation-3"
   style="opacity: .8">
<span class="brand-text font-weight-light">Student Portal </span>
</a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('/img/profile.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"> {{auth()->user()->name!=null ? auth()->user()->name : "Administrator"}} </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           
  @if(auth()->user()->role_id===4)
  <li class="nav-item has-treeview {!! classActivePath(2,'brand') !!} {!! classActivePath(2,'purchase_indent') !!}{!! classActivePath(2,'approvinglist') !!}">
                    <a href="{!! route('home') !!}" class="nav-link {!! classActivePath(1,'brand') !!} {!! classActivePath(1,'purchase_indent') !!}{!! classActivePath(1,'approvinglist') !!}">
                        <i class="nav-icon fas fa fa-product-hunt"></i>
                        <p>
                            Purchase Indent
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                   
                </li>
        @else
                <li class="nav-item">
                            <a href="{{ url('/home') }}" class="nav-link ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                       <li class="nav-item">
                            <a href="{{ url('/courseregistration') }}" class="nav-link {{ request()->path() === 'courseregistration' ? 'active' : '' }}">
                            <!-- <i class="far fa-circle nav-icon"></i> -->
                            <i class="far fa-circle nav-icon"></i>
                                <p>Student Course Registration</p></a>
                            </li> 
                        <li class="nav-item">
                            <a href="{{ url('/feepay') }}" class="nav-link {{ request()->path() === 'feepay' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                                <p>Student Fee Pay</p>
                            </a></li>

                        <li class="nav-item">
                            <a href="{{ url('admin/rebate/create') }}" class="nav-link {{ request()->path() === 'admin/rebate/create' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                                <p>Rebate</p>
                            </a>
                        </li>
                        <li class="nav-item">
                                <a href="{{ url('/admin/rebate') }}" class="nav-link {{ request()->path() === 'admin/rebate' ? 'active' : '' }}">
                                    
                                <i class="far fa-circle nav-icon"></i>
                                    <p class="text">My Rebate List</p>
                                </a>
                        </li>

                @endif

                       
                
                   

                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
