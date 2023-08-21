<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content=<?php echo e(csrf_token()); ?>>

    <title>IITI Indore Student Portal</title>
    <link rel="stylesheet" href="<?php echo e(asset('/css/app.css')); ?>"></link>
    <link rel="stylesheet" type="text/css" href="http://iiti.ac.in/images/favicon.ico">
    <link rel="icon" href="http://iiti.ac.in/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo e(asset('/dist/plugins/font-awesome/css/font-awesome.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('/dist/css/adminlte.min.css')); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo e(asset('/dist/plugins/iCheck/flat/blue.css')); ?>">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo e(asset('/dist/plugins/morris/morris.css')); ?>">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo e(asset('/dist/plugins/jvectormap/jquery-jvectormap-1.2.2.css')); ?>">
    <!-- Date Picker -->

    <link rel="stylesheet" href="<?php echo e(asset('/dist/plugins/datepicker/datepicker3.css')); ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo e(asset('/dist/plugins/daterangepicker/daterangepicker-bs3.css')); ?>">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo e(asset('/dist/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <?php if(auth()->guard()->guest()): ?> <?php echo $__env->yieldContent('content'); ?> <?php else: ?>
    <div class="wrapper" id="app">
     
        <!-- Header -->
    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- Sidebar -->
    <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php echo $__env->yieldContent('content'); ?>
        <!-- Footer -->
    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
<script src="<?php echo e(asset('/dist/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- Bootstrap -->
<script src="<?php echo e(asset('/dist/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- AdminLTE -->
<script src="<?php echo e(asset('/dist/js/adminlte.js')); ?>"></script>
<script src="<?php echo e(asset('/dist/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- AdminLTE -->
<script src="<?php echo e(asset('/dist/js/adminlte.js')); ?>"></script>

<!-- OPTIONAL SCRIPTS -->

<script src="<?php echo e(asset('/dist/js/demo.js')); ?>"></script>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<!-- OPTIONAL SCRIPTS -->

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <?php $__env->startSection('javascript'); ?>
    <script>
            var form = $("#myform1");
            $.validate({
                form: '#myform1'
            })
            $(document).ready(function() {
                $('#datatable').DataTable();
            } );
        </script>
<?php $__env->stopSection(); ?>
    <?php endif; ?> <?php echo $__env->yieldContent('javascript'); ?>
    
</body>
</html>