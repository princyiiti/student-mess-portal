<?php $__env->startSection('content'); ?>
<div class="content-wrapper" style="min-height: 543px;">
        <!-- Content Header (Page header) -->
       
            <!-- Content Header (Page header) -->
            <div class="card card-primary">
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-md-6">
                    <h1 class="m-0 text-dark">New Student Details </h1>
                  </div><!-- /.col -->
                  <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">New Student Details</li>
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
<div class="container">
   
        <form method="POST" action="<?php echo e(url('/savestudentdata')); ?>" accept-charset="UTF-8"  enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

 <div class="row">
<div class="col-md-12">
     <div class="col-md-6">
<div class="form-group <?php echo e($errors->has('rollno') ? 'has-error' : ''); ?>">
    <label for="rollno" class="control-label"><?php echo e('Rollno'); ?></label>
    <input class="form-control" name="rollno" type="text" required id="title"  >
    <?php echo $errors->first('rollno', '<p class="help-block">:message</p>'); ?>

</div>
</div>
 <div class="col-md-6">
<div class="form-group <?php echo e($errors->has('rollno') ? 'has-error' : ''); ?>">
    <label for="rollno" class="control-label"><?php echo e('Full Name'); ?></label>
    <input class="form-control" name="name" type="text" required id="name"  >
    <?php echo $errors->first('rollno', '<p class="help-block">:message</p>'); ?>

</div>
</div>
 <div class="col-md-6">
<div class="form-group <?php echo e($errors->has('prog') ? 'has-error' : ''); ?>">
    <label for="prog" class="control-label"><?php echo e('Program'); ?></label>
    <input class="form-control" name="prog" type="text" required id="title" value="M.Tech."  >
    <?php echo $errors->first('prog', '<p class="help-block">:message</p>'); ?>

</div>
</div>
<div class="col-md-6">
<div class="form-group <?php echo e($errors->has('father_name') ? 'has-error' : ''); ?>">
    <label for="father_name" class="control-label"><?php echo e('father_name'); ?></label>
    <input class="form-control" name="father_name" type="text" required id="title"  >
    <?php echo $errors->first('father_name', '<p class="help-block">:message</p>'); ?>

</div>
</div>
<div class="col-md-6">
<div class="form-group <?php echo e($errors->has('ademission_year') ? 'has-error' : ''); ?>">
    <label for="ademission_year" class="control-label"><?php echo e('Department '); ?></label>
     <select class="form-control select2" name="dept" type="text" id="caste"  data-validation="required" >
        <option value="">-----Select Course----</option>
       <?php $__currentLoopData = $departmentlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($val->deptname); ?>"><?php echo e($val->deptname); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <</select>
    <?php echo $errors->first('caste', '<p class="help-block">:message</p>'); ?>

  </div>
</div>
<div class="col-md-6">
<div class="form-group <?php echo e($errors->has('ademission_year') ? 'has-error' : ''); ?>">
    <label for="ademission_year" class="control-label"><?php echo e('Sepcilization '); ?></label>
     <select class="form-control select2" name="spec" type="text" id="spec"  data-validation="required" >
        <option value="">-----Select Sepcilization----</option>
       <?php $__currentLoopData = $departmentlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($val->deptname); ?>"><?php echo e($val->deptname); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <</select>
    <?php echo $errors->first('caste', '<p class="help-block">:message</p>'); ?>

  </div>
</div>

<div class="col-md-6">
<div class="form-group <?php echo e($errors->has('ademission_year') ? 'has-error' : ''); ?>">
    <label for="ademission_year" class="control-label"><?php echo e('Cast Category '); ?></label>
     <select class="form-control select2" name="caste" type="text" id="caste"  data-validation="required" >
        <option value="">-----Select Course----</option>
       <?php $__currentLoopData = $castlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($val->caste); ?>"><?php echo e($val->caste); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <</select>
    <?php echo $errors->first('caste', '<p class="help-block">:message</p>'); ?>

  </div>
</div>
<div class="col-md-6">
<div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
    <label for="title" class="control-label"><?php echo e('personal Email'); ?></label>
    <input class="form-control" name="p_email" type="email" required id="email"  >
    <?php echo $errors->first('password', '<p class="help-block">:message</p>'); ?>

</div>
</div>
<div class="col-md-6">
<div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
    <label for="title" class="control-label"><?php echo e('Institute Email ID '); ?></label>
    <input class="form-control" name="email" type="text" required id="role"  >
    <?php echo $errors->first('role', '<p class="help-block">:message</p>'); ?>

</div>
</div>
<div class="col-md-6">
<div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
    <label for="title" class="control-label"><?php echo e('Contact '); ?></label>
    <input class="form-control" name="contact" type="text" required id="role"  >
    <?php echo $errors->first('role', '<p class="help-block">:message</p>'); ?>

</div>
</div>
<div class="col-md-6">
<div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
    <label for="title" class="control-label"><?php echo e('gender '); ?></label>
    <input class="form-control" name="gender" type="text" required id="role"  >
      <input class="form-control" name="batch_year" type="hidden" value="2023" required id="role"  >
    <?php echo $errors->first('gender', '<p class="help-block">:message</p>'); ?>

</div>
</div>

<div class="col-md-6">
<div class="form-group ">
    <input class="btn btn-primary " type="submit" value="Create">
</div>
</div>
</div>
 
                        </form>
   

            </div>
        </div>
    </div></section></div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>