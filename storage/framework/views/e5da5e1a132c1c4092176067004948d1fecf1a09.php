<?php $__env->startSection('content'); ?>
   <div class="content-wrapper" style="min-height: 543px;">
        <!-- Content Header (Page header) -->
       
            <!-- Content Header (Page header) -->
            <div class="card card-primary">
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Student Course Registation</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Student Course Registation</li>
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
                   
                        <div class="">
                    <div class="card-header">Student Course Registation</div>
                    <div class="card-body">
                      

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Department</th>
                                         <th>Program</th>
                                         
                                    </tr>
                                </thead>
                                <tbody>
                                    <td><?php echo e($studentprofile->rollno); ?></td>
                                 <td><?php echo e($studentprofile->name); ?></td>
                                <td><?php echo e($studentprofile->dept); ?></td>
                                 <td><?php echo e($studentprofile->prog); ?></td>
                      </tbody></table>
                        </div>

                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                <form action="<?php echo e(url('courseregirationsave')); ?>" method="POST">
                     <?php echo e(csrf_field()); ?>

                   <h3>Core Course List </h3>
                   <div class="col-md-6">
                
                    <div class="form-group <?php echo e($errors->has('openlelectivecount') ? 'has-error' : ''); ?>">
                    <?php $__currentLoopData = $courseregiration->Chieldlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($val->coursetype=="Core"): ?>
                    <div class="form-check">
                   <input class="form-check-input" type="checkbox" value="<?php echo e($val->coursecode); ?>" id="flexCheckDefault" name="coursecode[]" onclick="return false" checked readonly>
                   <label class="form-check-label" for="flexCheckDefault">
                    <input type="hidden" name="coursename[]" value="<?php echo e($val->coursename); ?>">
                    <!-- <input type="hidden" name="coursecode[]" value="<?php echo e($val->coursecode); ?>"> -->
                     <?php echo e($val->coursecode); ?>  <?php echo e(App\Courseregiration::getcoursedetail($val->coursecode)); ?> 
                    </label>
                    </div>
                    <?php endif; ?>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>

           <h3>Core Elective Course List </h3>
           <hr>
              <div class="col-sm-6">
                <?php for($i=0;$i<$courseregiration->deparmentlelectivecount;$i++): ?>
                    <div class="form-group <?php echo e($errors->has('openlelectivecount') ? 'has-error' : ''); ?>">
                        <label for="title" class="control-label"><?php echo e('Core Elective'); ?><?php echo e($i+1); ?></label>
                        <select name="coreelective[]" id="corelective" class="form-control">
                             <?php $__currentLoopData = $courseregiration->Chieldlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($val->coursetype=="Core Elective"): ?>
                    <?php if(App\Courseregiration::getcoursedetailcount($val->coursecode)): ?>
                            <option value="<?php echo e($val->coursecode); ?>"><?php echo e($val->coursecode); ?> <?php echo e(App\Courseregiration::getcoursedetail($val->coursecode)); ?> </option>
                            <?php endif; ?>
                             <?php endif; ?>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php endfor; ?>
                   </div>
                   <?php if($courseregiration->type==1): ?>
                 
                       <h3>Open Elective Course List </h3>
                    <hr>
                <!-- //============MAx Open Elective work for M.Tech. and MSR ======================= -->
                <?php if($courseregiration->maxopenelective>0): ?>
             <?php for($j=0;$j<$courseregiration->maxopenelective;$j++): ?>
               <div class="col-sm-6">
              
                    <div class="form-group <?php echo e($errors->has('openlelectivecount') ? 'has-error' : ''); ?>">
                        <label for="title" class="control-label"><?php echo e('Core Elective'); ?><?php echo e($i+1); ?></label>
                        <select name="electivecourse[]" id="corelective" class="form-control">
                              <?php $__currentLoopData = $electivecourselist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $electiveval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                  
                            <option value="<?php echo e($electiveval->crsecode); ?>"><?php echo e($electiveval->crsecode); ?>  (<?php echo e(App\Courseregiration::getcoursedetail($electiveval->crsecode)); ?>) </option>
                           
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                   
                   </div>
                   <?php endfor; ?>
               <?php else: ?>
                  <div class="row">
                    <?php $__currentLoopData = $electivecourselist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $electiveval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                      <div class="col-md-4">     
                      <div class="form-group <?php echo e($errors->has('electivecourse') ? 'has-error' : ''); ?>">         
                    <div class="form-check">
                   <input class="form-check-input" type="checkbox" value="<?php echo e($electiveval->crsecode); ?>" name="electivecourse[]" id="flexCheckDefault" >
                   <label class="form-check-label" for="flexCheckDefault">                    
                     <?php echo e($electiveval->crsecode); ?> (<?php echo e(App\Courseregiration::getcoursedetail($electiveval->crsecode)); ?>)
                    </label>
                    </div>
                    </div>
                    </div>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </div>
                <?php endif; ?>
                   <?php endif; ?>
              
</div>

<hr>
<div class="col-md-6">
<input  type="submit" class="btn btn-primary btn-lg btn-block" style="color:white;" value="Submit">
</div>
                </form>
                <br> <br>
            </div>
                </div>
                           </section>
</div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>