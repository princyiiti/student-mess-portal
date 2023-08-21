<div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
    <label for="title" class="control-label"><?php echo e('Title'); ?></label>
    <input class="form-control" data-validation="required" name="title" type="text" id="title" value="<?php echo e(isset($messlist->title) ? $messlist->title : ''); ?>" >
    <?php echo $errors->first('title', '<p class="invalid-feedback">:message</p>'); ?>

</div>

<div class="form-group <?php echo e($errors->has('studentlimit') ? 'has-error' : ''); ?>">
    <label for="studentlimit" class="control-label"><?php echo e('Student Max Limit'); ?></label>
    <input class="form-control" data-validation="required" name="studentlimit" type="text" id="studentlimit" value="<?php echo e(isset($messlist->title) ? $messlist->studentlimit : ''); ?>" >
    <?php echo $errors->first('studentlimit', '<p class="invalid-feedback">:message</p>'); ?>

</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="<?php echo e($formMode === 'edit' ? 'Update' : 'Create'); ?>">
</div>
