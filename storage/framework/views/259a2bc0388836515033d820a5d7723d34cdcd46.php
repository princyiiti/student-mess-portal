<?php $__env->startSection('content'); ?>
<div class="content-wrapper" style="min-height: 543px;">
    <!-- Content Header (Page header) -->

    <!-- Content Header (Page header) -->
    <div class="card card-primary">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"> Import Mess Subscription Data </h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card">
                    <div class="card-header"><a href="<?php echo e(url('public/mess_data.csv')); ?>">Import Mess Subscription Data</a>
                    </div>
                    <div class="card-body">

                        <br />
                        <br />

                        <?php if($errors->any()): ?>
                        <ul class="alert alert-danger">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>
                        <a href="<?php echo e(url('public/mess_data.csv')); ?>">Sample File format Download</a>
                        <form method="POST" action="<?php echo e(url('/admin/user/uploadcsv')); ?>" accept-charset="UTF-8"
                            class="form-horizontal" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <?php if(Session::has('success')): ?>
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p><?php echo e(Session::get('success')); ?></p>
                            </div>
                            <?php endif; ?>
                            <?php if(Session::has('notsuccess')): ?>
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p><?php echo e(Session::get('notsuccess')); ?></p>
                            </div>
                            <?php endif; ?>
                            <input type="file" name="import_file" accept=".csv, .xlsx" />
                            <button class="btn btn-primary">Import File</button>
                        </form>

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