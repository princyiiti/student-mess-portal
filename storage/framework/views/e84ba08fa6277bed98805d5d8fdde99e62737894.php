
<div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="alert alert-success print-success-msg" style="display:none">
        <ul></ul>
    </div>
<div class="row">
    <div class="col-sm-6">
<div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
    <label for="title" class="control-label"><?php echo e('Admission Year'); ?></label>
    <select class="form-control select2" name="admission_year" type="text" id="admission_year" value="<?php echo e(isset($role->title) ? $role->title : ''); ?>"  >
        <option value="">----Select Admission  Year---</option>
  
        <?php for($i=2009;$i <=  date('Y'); $i++): ?>
        <option value="<?php echo e($i); ?>" <?php echo e(isset($model->academic_year) ?($model->academic_year==$i)?'selected' : '':''); ?> ><?php echo e($i); ?></option>
        <?php endfor; ?>
   </select>
    <?php echo $errors->first('title', '<p class="help-block">:message</p>'); ?>

</div>
</div>
 
 <div class="col-sm-6">
<div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
    <label for="title" class="control-label"><?php echo e('Program'); ?></label>
    <select class="form-control select2" name="program" type="text" id="program" value="<?php echo e(isset($role->title) ? $role->title : ''); ?>"  >
        <option value="">----Select Program---</option>
    <?php $__currentLoopData = $programlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <option value="<?php echo e($rval->program); ?>"><?php echo e($rval->program); ?></option>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   </select>
    <?php echo $errors->first('title', '<p class="help-block">:message</p>'); ?>

</div>
</div>
<hr>

<div class="col-sm-6 datapopulate">
    <div class="form-group">
        <label for="title" class="control-label"><?php echo e('Apply Fee Structure'); ?></label>

        <select class="form-control" name="feestructure" id="feestructure">
            <option value="">--Select Fee Structure--</option>
            <?php $__currentLoopData = $feestructurelist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($fval->id); ?>"><?php echo e($fval->program); ?> (<?php echo e($fval->academic_year); ?>/<?php echo e($fval->academic_tearm); ?>) <?php echo e($fval->ademission_year); ?> <?php echo e($fval->category); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

    </div>
</div> 

  <!-- <div class="col-sm-6 datapopulate" >
<div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
    <label for="title" class="control-label"><?php echo e('Apply Fee Structure'); ?></label>
    <select class="form-control select2" name="feestructure" id="feestructure" value="<?php echo e(isset($role->title) ? $role->title : ''); ?>" >
        <option value="">--Select Fee Structure--</option>
        <?php $__currentLoopData = $feestructurelist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($fval->id); ?>"><?php echo e($fval->program); ?> (<?php echo e($fval->academic_year); ?>/<?php echo e($fval->academic_tearm); ?>) <?php echo e($fval->ademission_year); ?> <?php echo e($fval->category); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <?php echo $errors->first('title', '<p class="help-block">:message</p>'); ?>

</div>
</div> -->
 <div class="col-sm-6 datapopulate">
 <label for="title" class="control-label"><?php echo e('Search Student'); ?></label>
<div class="form-group">
    <a class="btn btn-primary" id="searchstudent"value="<?php echo e($formMode === 'edit' ? 'Update' : 'Search Student'); ?>" style="color:white;">Search Student</a>
</div>
</div>
