<?php $__env->startSection('content'); ?>
<div class="content-wrapper" style="min-height: 543px;">
    <!-- Content Header (Page header) -->

    <!-- Content Header (Page header) -->
    <div class="card card-primary">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Student Fee</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Student Fee</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
 <?php if(Session::has('flash_message')): ?>
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p><?php echo e(Session::get('flash_message')); ?></p>
                        </div>
                        <?php endif; ?>
                <div class="">
                    <div class="card-header">Course List</div>
                    <div class="card-body">
                        <a href="<?php echo e(url('addelectivelist')); ?>" class="btn btn-success btn-sm" title="Add New feestudent">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                       

                        <br />
                        <br />
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Course Code</th>
                                        <th>Program Type</th>
                                        <!-- <th>Fee Type</th> -->
                                        
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $electivelist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($item->crsecode); ?></td>
                                         <td><?php echo e($item->programtype); ?></td>
                                        
                                          <td>
                                            <a href="<?php echo e(url('/deletecouse/' . $item->id )); ?>" onclick="return confirm(&quot;Confirm delete?&quot;)" title="Edit feestudent"><button class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></a>

                                          
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                          
                        </div>

                    </div>
                </div>
            </div>
    </section>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>