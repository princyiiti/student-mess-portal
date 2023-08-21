<div class="row">
    <div class="col-sm-2">
        <div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
            <label for="title" class="control-label"><?php echo e('Admission Year'); ?></label>
            <select required class="form-control select2" name="admission_year" type="text" id="admission_year" value="">
                <option value="">----Select Admission Year---</option>

                <?php for($i=2009;$i <= date('Y'); $i++): ?> <option value="<?php echo e($i); ?>"
                    <?php echo e(isset($model->academic_year) ?($model->academic_year==$i)?'selected' : '':''); ?>><?php echo e($i); ?></option>
                    <?php endfor; ?>
            </select>
            <?php echo $errors->first('title', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group <?php echo e($errors->has('academic_year') ? 'has-error' : ''); ?>">
            <label for="academic_year" class="control-label"><?php echo e('Academic Year'); ?></label>
            <select  required class="form-control" name="academic_year" type="text" id="academic_year"
                value="<?php echo e(isset($model->academic_year) ? $model->academic_year : ''); ?>" data-validation="required">
                <option value="">-----Select Acad Year----</option>
                <?php for($i=2022;$i <= date('Y'); $i++): ?> <option value="<?php echo e($i); ?>"
                    <?php echo e(isset($model->academic_year) ?($model->academic_year==$i)?'selected' : '':''); ?>><?php echo e($i); ?></option>
                    <?php endfor; ?>
            </select>
            <?php echo $errors->first('academic_year', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
            <label for="title" class="control-label"><?php echo e('Academic Sem'); ?></label>
            <select required class="form-control" name="academic_tearm" type="text" id="academic_tearm"
                value="<?php echo e(isset($model->academic_year) ? $model->academic_year : ''); ?>" data-validation="required">
                <option value="">-----Select Acad Semester----</option>

                <option value="Spring"
                    <?php echo e(isset($model->academic_tearm) ?($model->academic_tearm=='Spring')?'selected' : '':''); ?>>Spring
                </option>
                <option value="Autumn"
                    <?php echo e(isset($model->academic_tearm) ?($model->academic_tearm=='Autumn')?'selected' : '':''); ?>>Autumn
                </option>

                </select>
                <?php echo $errors->first('title', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
            <label for="title" class="control-label"><?php echo e('Program'); ?></label>
            <select required class="form-control select2" name="program" type="text" id="program" value="">
                <option value="">----Select Program---</option>
                <?php $__currentLoopData = $program; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($rval->program); ?>"><?php echo e($rval->program); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php echo $errors->first('title', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group <?php echo e($errors->has('title') ? 'has-error' : ''); ?>">
            <label for="title" class="control-label"><?php echo e('Category'); ?></label>
            <select required class="form-control select2" name="category" type="text" id="category" value="">
                <option value="">----Select Category---</option>
                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($val->castcategory); ?>"><?php echo e($val->castcategory); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php echo $errors->first('title', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="col-sm-2">
    <label for="title" class="control-label"><?php echo e('Generate Report'); ?></label>
        <div class="form-group">
            
            <a class="btn btn-primary " id="searchstudentfees" value="" style="color:white;">Generate Report</a>
        </div>
    </div>
    <hr>

    