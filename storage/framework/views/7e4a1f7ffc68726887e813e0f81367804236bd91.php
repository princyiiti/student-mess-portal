<?php $__env->startSection('content'); ?>
   <div class="content-wrapper" style="min-height: 543px;">
        <!-- Content Header (Page header) -->
       
            <!-- Content Header (Page header) -->
            <div class="card card-primary">
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Course Allocation List </h1>
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
                   
                      
                    <div class="card-header">Course Allocation List </div>
                    <div class="card-body">
                        <a href="<?php echo e(url('/admin/courseregiration/create')); ?>" class="btn btn-success btn-sm" title="Add New caterers">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Department</th>
                                        <th>Program</th>
                                           <th>Studing Year</th>
                                            <th>Semester</th>
                                             <th>Open for All Elective</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $courseregirations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($item->department); ?></td>
                                        <td><?php echo e($item->program); ?></td>
                                         <td><?php echo e($item->studyingyear); ?></td>
                                           <td><?php echo e($item->semester); ?></td>
                                             <td> <?php if($item->type==1): ?>
                                                Yes
                                                <?php else: ?>
                                                No
                                                <?php endif; ?>
                                             </td>
                                        <td>
                                            <!-- <a href="<?php echo e(url('/admin/courseregiration/' . encrypt($item->id))); ?>" title="View Category"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a> -->
                                            <a href="<?php echo e(url('/admin/courseregiration/' . $item->id . '/edit')); ?>" title="Edit Category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="<?php echo e(url('/admin/courseregiration' . '/' . $item->id)); ?>" accept-charset="UTF-8" style="display:inline">
                                                <?php echo e(method_field('DELETE')); ?>

                                                <?php echo e(csrf_field()); ?>

                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Category" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            
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