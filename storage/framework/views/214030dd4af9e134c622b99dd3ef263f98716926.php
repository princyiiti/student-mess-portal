<div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
    <label for="title" class="control-label"><?php echo e('Title'); ?></label>
    <input class="form-control" data-validation="required" required name="title" type="text" id="title" value="<?php echo e(isset($messlist->title) ? $messlist->title : ''); ?>" >
    <?php echo $errors->first('title', '<p class="invalid-feedback">:message</p>'); ?>

</div>

<div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
    <label for="title" class="control-label"><?php echo e('Email'); ?></label>
    <input class="form-control" data-validation="required" required name="email" type="email" id="email" value="<?php echo e(isset($messlist->email) ? $messlist->email : ''); ?>" >
    <?php echo $errors->first('email', '<p class="invalid-feedback">:message</p>'); ?>

</div>

<div class="form-group <?php echo e($errors->has('studentlimit') ? 'has-error' : ''); ?>">
    <label for="studentlimit" class="control-label"><?php echo e('Student Max Limit'); ?></label>
    <input class="form-control" data-validation="required" required name="studentlimit" type="number" id="studentlimit" value="<?php echo e(isset($messlist->title) ? $messlist->studentlimit : ''); ?>" >
    <?php echo $errors->first('studentlimit', '<p class="invalid-feedback">:message</p>'); ?>

</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="<?php echo e($formMode === 'edit' ? 'Update' : 'Create'); ?>">
</div>
<script>
//     $('input').on('input', function() {
//     $(this).val($(this).val().replace(/[^a-z0-9]/gi, ''));
// })

$(function() {

$('#title ').keydown(function (e) {

  if (e.shiftKey || e.ctrlKey || e.altKey) {
  
    e.preventDefault();
    
  } else {
  
    var key = e.keyCode;
    
    if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
    
      e.preventDefault();
      
    }

  }
  
});

});
</script>