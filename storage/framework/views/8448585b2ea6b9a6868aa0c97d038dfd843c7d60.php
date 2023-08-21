<div class="row">
<div class="col-md-6">
<div class="form-group <?php echo e($errors->has('from_date') ? 'has-error' : ''); ?>">
    <label for="from_date" class="control-label"><?php echo e('Start Date (MM/DD/YYYY)'); ?></label>
    <input  class="form-control dateclassrebate dp" data-validation="required" name="from_date" type="text" id="from_date" value="<?php echo e(isset($category->from_date) ? $category->from_date : ''); ?>" readonly="readonly" >
        
    <?php echo $errors->first('from_date', '<p class="invalid-feedback">:message</p>'); ?>

</div>
</div>
<div class="col-md-6">
<div class="form-group <?php echo e($errors->has('to_date') ? 'has-error' : ''); ?>">
    <label for="to_date" class="control-label"><?php echo e('End Date (MM/DD/YYYY)'); ?></label>
    <input  class="form-control dateclassrebate dp" data-validation="required" name="to_date" type="text" id="to_date" value="<?php echo e(isset($category->to_date) ? $category->to_date : ''); ?>" readonly="readonly" >
    	
    <?php echo $errors->first('to_date', '<p class="invalid-feedback">:message</p>'); ?>

</div>
</div>

<!-- <hr> Student Period  of this slot <br> -->
<div class="col-md-6">
<div class="form-group <?php echo e($errors->has('to_date') ? 'has-error' : ''); ?>">
    <label for="to_date" class="control-label"><?php echo e('Type Rebate'); ?></label>
    <select class="form-control " data-validation="required" name="type_rebate"  id="type_rebate"  >
        <option value="">---Select Rebate type---</option>
        <option value="Long Term Rebate">Long Term Rebate</option>
         <option value="Short Term Rebate">Short Term Rebate</option>
    </select>    	
    <?php echo $errors->first('type_rebate', '<p class="invalid-feedback">:message</p>'); ?>

</div>
</div>
<div class="col-md-6">
<div class="form-group <?php echo e($errors->has('reason') ? 'has-error' : ''); ?>">
    <label for="from_date" class="control-label"><?php echo e('Reason'); ?></label>
    <input  class="form-control " data-validation="required" name="reason" type="text" id="reason" value="<?php echo e(isset($category->reason) ? $category->reason : ''); ?>"  >    	
    <?php echo $errors->first('reason', '<p class="invalid-feedback">:message</p>'); ?>

</div>
</div>

</div>
</div>
</div>

<!-- <div class="start_date dp"></div>
<div class="end_date dp"></div>
<a href="#" class="reset">reset</a> -->

<div class="col-md-6 offset-md-3">
<div class="form-group">
    <input class="btn btn-primary btn-lg btn-block" type="submit" value="<?php echo e($formMode === 'edit' ? 'Update' : 'Create'); ?>">
</div>
</div>
