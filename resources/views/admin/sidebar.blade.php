<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <img src="/img/logo.png" alt="Laravel Starter" class="brand-image img-circle elevation-3"
   style="opacity: .8">
<span class="brand-text font-weight-light">Laravel Starter</span>
</a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/img/profile.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"> {{auth()->user()->name!=null ? auth()->user()->name : "Administrator"}} </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview {!! classActivePath(1,'dashboard') !!}">
                    <a href="{!! route('home') !!}" class="nav-link {!! classActiveSegment(1, 'dashboard') !!}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link {!! classActiveSegment(2, 'home') !!}">
                    <i class="fas fa-circle"></i>
                    <p>Dashboard v1</p>
                  </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('v2') }}" class="nav-link {!! classActiveSegment(2, 'v2') !!}">
                    <i class="fas fa-circle"></i>
                    <p>Dashboard v2</p>
                  </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('v3') }}" class="nav-link {!! classActiveSegment(2, 'v3') !!}">
                    <i class="fas fa-circle"></i>
                    <p>Dashboard v3</p>
                  </a>
                        </li>
                    </ul>
                </li>
             
                
                
                   
            
                <li class="nav-header">MISCELLANEOUS</li>
                <li class="nav-item">
                    <a href="https://adminlte.io/docs" class="nav-link">
                <i class="nav-icon fa fa-file"></i>
                <p>Documentation</p>
              </a>
                </li>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>