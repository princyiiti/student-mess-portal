<?php $__env->startSection('content'); ?>
   <div class="content-wrapper" style="min-height: 543px;">
        <!-- Content Header (Page header) -->
       
            <!-- Content Header (Page header) -->
            <div class="card card-primary">
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Student Fee List</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Student Fee List</li>
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
                    <div class="card-header">Student Fee List</div>
                    <div class="card-body">
                      

                        <br/>
                        <br/>
                          <?php if(Session::has('flash_message')): ?>
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p><?php echo e(Session::get('flash_message')); ?></p>
                        </div>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Rollno</th>
                                        <th>Academic Year/Term</th>
                                         <th>Total Payable Amount</th>
                                         <th>Amount Paid (if any) </th>
                                         <!-- <th>Total Amount Due</th> -->
                                         <!-- <th>Paid Amount</th> -->
                                         <th>Payment Status</th>
                                         <th>Payment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $studentdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                       <td><?php echo e($loop->iteration); ?></td>
                                       <td><?php echo e($item->rollno); ?></td>
                                        <td><?php echo e($item->academic_year); ?>/<?php echo e($item->academic_tearm); ?></td>
                                         <td><?php echo e($item->totalamount); ?></td>
                                         <td><?php if($item->paid_amount==''): ?> 
                                            0
                                            <?php else: ?>
                                            <?php echo e($item->paid_amount); ?>

                                        <?php endif; ?></td>
                                        <!-- <td><?php echo e($item->due_amount); ?></td> -->
                                         
                                           <td>

                                           <?php if($item->type==0): ?>
                                           <span class="badge badge-danger" style="font-size:14px;">unpaid</span>
                                           <?php elseif($item->type==2): ?>
                                          <span class="badge badge-primary" style="font-size:14px;">Partial unpaid Amount</span>
                                           <?php else: ?>
                                               <span class="badge badge-success" style="font-size:14px;">Paid Amount</span>
                                           <?php endif; ?>

                                        </td>
                                         <td>
                                            <?php if($item->file!=''): ?>
                                              <a href="<?php echo e(url($item->file)); ?>" class="btn btn-primary" download="<?php echo e($item->file); ?>" title="<?php echo e($item->file); ?>" ><i class="fa fa-print nav-icon"></i>Print Fee Receipt</a>
                                            <?php endif; ?>   
                                           <form action="<?php echo e(url('feedetails')); ?>" method="POST" accept-charset="UTF-8">
                                             <?php echo e(csrf_field()); ?>

                                 <?php
                                   $encryptedId = encrypt($item->id);
                                            ?> 
                                             <input type="hidden" name="idkey" value="<?php echo e($encryptedId); ?>"> 
                                           <?php if($item->type==0): ?>   
                                               
                                           
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-rupee nav-icon"></i> Click here to Pay</button>                                
                                           <!-- <a href="<?php echo e(url('/payment').'/'.$encryptedId); ?>" class="btn btn-primary" type="submit"><i class="fa fa-rupee nav-icon"></i> Click here to Pay</a> -->
                                           <?php elseif($item->type==1): ?>
                                              <a href="#" class="btn btn-primary" type="submit"><i class="fa fa-rupee nav-icon"></i> Click here to Pay</a>
                                               <?php else: ?>
                                              
                                               <?php endif; ?>
                                           </form>

                                        </td>

                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tbody>
                             
                                </tbody>
                            </table>
                      
                        </div>

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