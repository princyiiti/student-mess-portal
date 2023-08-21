    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?php echo e(url('/home')); ?>" class="brand-link">
            <img src="<?php echo e(asset('/img/logo.jpg')); ?>" alt="IITI" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">IIT Indore Admin Portal</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?php echo e(asset('/img/profile.png')); ?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"> <?php echo e(auth()->user()->name!=null ? auth()->user()->name : "Administrator"); ?>

                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="#" class="nav-link menu-open">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Fees Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="<?php echo e(url('/admin/feetype')); ?>" class="nav-link <?php echo e(request()->path() === 'admin/feetype' ? 'active' : ''); ?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Create Fee Type </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('/admin/feestructure')); ?>" class="nav-link <?php echo e(request()->path() === 'admin/feestructure' ? 'active' : ''); ?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Create Fee Structure</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('/admin/studenttotalfee')); ?>" class="nav-link <?php echo e(request()->path() === 'admin/studenttotalfee' ? 'active' : ''); ?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Student Fee Allocations</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('/admin/feesallocations')); ?>" class="nav-link <?php echo e(Request::routeIs('admin/feesallocations') ? 'active' : ''); ?>  ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Assigned Fee Details</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo e(url('/admin/student-master-fee-details')); ?>" class="nav-link <?php echo e(Request::routeIs('admin/student-master-fee-details') ? 'active' : ''); ?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Fee Payment Report </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('admin/fee-report')); ?>" class="nav-link <?php echo e(Request::routeIs('admin/fee-report') ? 'active' : ''); ?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Custom Report</p>
                                </a>
                            </li>
                        </ul>
                    </li>

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
                                <a href="<?php echo e(url('/admin/messlist')); ?>" class="nav-link <?php echo e(request()->path() === 'admin/messlist' ? 'active' : ''); ?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Mess List </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('/admin/user/importcsv')); ?>" class="nav-link <?php echo e(Request::routeIs('admin/user/importcsv') ? 'active' : ''); ?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Import Mess Subcription Data</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo e(url('/admin/student_mess_data')); ?>" class="nav-link <?php echo e(request()->path() === 'admin/student_mess_data' ? 'active' : ''); ?>  ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Mess Subcription Details</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('/admin/rebate')); ?>" class="nav-link <?php echo e(request()->path() === 'admin/rebate' ? 'active' : ''); ?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Student Rebate List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('custom_demo_list')); ?>" class="nav-link <?php echo e(request()->path() === 'custom_demo_list' ? 'active' : ''); ?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Student Mess Rebate Report</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('admin/subcription')); ?>" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Subcription list </p>
                                </a>
                            </li>

                           
                        </ul>
                    </li>


                      <li class="nav-item">
                        <a href="#" class="nav-link menu-open">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Academic Section
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="<?php echo e(url('/admin/courseregiration')); ?>" class="nav-link <?php echo e(request()->path() === 'admin/courseregiration' ? 'active' : ''); ?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Program wise Course List </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('electivelist')); ?>" class="nav-link <?php echo e(request()->path()=='electivelist' ? 'active' : ''); ?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">All Elective List</p>
                                </a>
                            </li>
                              <li class="nav-item">
                                <a href="<?php echo e(url('newstudentregistration')); ?>" class="nav-link <?php echo e(request()->path() =='newstudentregistration' ? 'active' : ''); ?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">New Student in the AROL</p>
                                </a>
                            </li>
                                <li class="nav-item">
                                <a href="<?php echo e(url('newusercreateform')); ?>" class="nav-link <?php echo e(request()->path() =='newstudentregistration' ? 'active' : ''); ?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">New AROL User</p>
                                </a>
                            </li>

                           <!--  <li class="nav-item">
                                <a href="<?php echo e(url('/admin/student_mess_data')); ?>" class="nav-link <?php echo e(request()->path() === 'admin/student_mess_data' ? 'active' : ''); ?>  ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Mess Subcription Details</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('/admin/rebate')); ?>" class="nav-link <?php echo e(request()->path() === 'admin/rebate' ? 'active' : ''); ?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Student Rebate List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('custom_demo_list')); ?>" class="nav-link <?php echo e(request()->path() === 'custom_demo_list' ? 'active' : ''); ?> ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text">Student Mess Rebate Report</p>
                                </a>
                            </li> -->

                           
                        </ul>
                    </li>




                









                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>