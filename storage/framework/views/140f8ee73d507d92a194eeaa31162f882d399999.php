<?php $__env->startSection('content'); ?>
<div class="content-wrapper" style="min-height: 543px;">
        <!-- Content Header (Page header) -->
       
            <!-- Content Header (Page header) -->
            <div class="card card-primary">
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Student Fee</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Fee Details</li>
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
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <strong>Indian Institute of Technology Indore</strong>
                        <br>
                        Khandwa Road, Simrol, 
                        <br>
                       Indore 453552, INDIA
                        <br>
                       
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date: <?php echo e(date('D d-M-Y')); ?></em>
                    </p>
                    <p>
                         <em>Student Name: <?php echo e($studentprofile->name); ?></em>
                        <em>Student Rollno: <?php echo e($studentprofile->rollno); ?></em>
                         <em>Program: <?php echo e($studentprofile->prog); ?></em>
                        <em>Academic Semester(<?php echo e($feestructure->academic_year); ?>/<?php echo e($feestructure->academic_tearm); ?>)</em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>Fee Details </h1>
                </div>
                </span>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Fees Type</th>
                            <th></th>
                            <!-- <th class="text-center">Due Amount</th> -->
                            <th class="text-center">Payable Amount </th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $dueamount=0;
                        ?>
                        <?php $__currentLoopData = $studentdata->Feestructuredata->FeeDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                            <td class="col-md-9"><em><?php echo e($val->fee_type); ?></em></h4></td>
                            <!-- <td class="col-md-1" style="text-align: center">  </td> -->
                            <?php if($val->type==1): ?>
                            <td class="col-md-1 text-center">&#8377;<?php echo e($val->amount); ?></td>
                            <?php $dueamount=$val->amount+$dueamount?>
                             <td class="col-md-1 text-center"></td>
                            <?php else: ?>
                            <td class="col-md-1 text-center"></td>
                            <td class="col-md-1 text-center">&#8377;<?php echo e($val->amount); ?></td>
                            <?php endif; ?>
                            <?php if($val->type!=1): ?>
                            <td class="col-md-1 text-center">&#8377;<?php echo e($val->amount); ?></td>
                            <?php else: ?>
                            <td class="col-md-1 text-center"></td>
                            <?php endif; ?>
                        </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php if($dueamount>0): ?>
                        <tr>
                           
                          
                            <td class="text-right">
                                
                                  <p>
                                <strong>Total Due Amount : </strong>
                            </p>
                                 
                            
                            </td>
                             <td>   </td>
                            <td class="text-center">
                            <p>
                                <strong><i class="fa fa-rupee nav-icon"></i>
                                   
                                    <?php echo e($dueamount); ?>

                                    
                                </strong>
                            </p>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Payable Amount: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong><i class="fa fa-rupee nav-icon"></i>
                                <?php if($studentdata->remission=="Yes" &&$studentdata->remission!=""): ?>
                                <?php echo e($studentdata->totalamount-$studentdata->remission_amount); ?>

                                <?php else: ?>
                                <?php echo e($studentdata->totalamount); ?>

                                <?php endif; ?>
                            </strong></h4></td>
                        </tr>
                    </tbody>
                </table>
               <?php if($studentdata->remission=="Yes" &&$studentdata->remission!=""): ?>
               <div class="paybuttonnew" >
              <div class="form-group">
                   <?php
                   $encryptedId = encrypt($studentdata->id);
                          ?> 
                          <?php if($studentdata->status==1): ?>
                          <a href="<?php echo e(url('/payment').'/'.$encryptedId); ?>" class="btn btn-success btn-lg btn-block" type="submit"><i class="fa fa-rupee nav-icon"></i> Click here Pay</a>                   
                                          
                         <?php else: ?>
                             <a href="<?php echo e(url('/payment').'/'.$encryptedId); ?>" class="btn btn-success btn-lg btn-block" type="submit"><i class="fa fa-rupee nav-icon"></i> Click here Pay</a>        
                         <?php endif; ?>
                           </div>
                     </div>

               <?php else: ?>
<?php if($studentprofile->caste=="OBC-NCL"||$studentprofile->caste=="General"||$studentprofile->caste=="GEN-EWS"): ?>

          <form method="POST" action="<?php echo e(url('/saveremissiondata')); ?>" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="id" value="<?php echo e($studentdata->id); ?>">
                              <div class="form-group">
              <label for="ademission_year" class="control-label" style="color: red;"> Do You Want to apply for Fee Remission ? Note: Remission is subject to verification of income certificate. <a href="<?php echo e(url('public/Fee Remission_Important Instructions (1).pdf')); ?>" target="_blanck">Click Here</a></label>
              <select class="form-control" id="remission" name="remission">
                <option value="">------Select One-----</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
              </select>
          </div>
          <div class="inputform" style="display:none;">
            <div class="form-group">
                              <label for="ademission_year" class="control-label">Select Your Prental Income</label>
                             <select type="text" class="form-control" id="parentalincome" name="parentalincome" required>
                               <option value="">------Select Prental Income-----</option>
                               <option value="Less than 1 Lakh INR">Less than 1 Lakh INR</option>
                               <option value="1 Lakh to 5 Lakh INR"> 1 Lakh to 5 Lakh INR</option>
                           </select>               
                           </div>
             <div class="form-group">
                   <label for="ademission_year" class="control-label">Fee Remission Type</label>
                   <input type="text" id="remissionfront" class="form-control"  name="remissionfront" readonly>
                   <select style="display:none;" class="form-control" id="remissiontype" name="remissiontype" readonly>                             
                <option value="">------Select One-----</option>
                  <option value="1/3">2/3 Tuition Fee Remission </option>
                  <option value="full">Full Tuition Fee Remission</option>
              </select>
                           </div>
                           
                           <div class="form-group">
                              <label for="ademission_year" class="control-label">Upload Parental Income Critificate</label>
                             <input type="file" class="form-control" id="income_file" name="income_file" accept=".pdf" required>                            
                           </div>
<!-- <button class="btn btn-primary btn-lg btn-block" type="submit" value="Submit"/> -->
<input class="btn btn-primary btn-lg btn-block" type="submit" value="submit">
                       </div>
                        </form>
      </div>
          <div class="paybutton" style="display:none;">
              <div class="form-group">
                   <?php
                   $encryptedId = encrypt($studentdata->id);
                          ?> 
                          <?php if($studentdata->status==1): ?>
                          <a href="<?php echo e(url('/payment').'/'.$encryptedId); ?>" class="btn btn-success btn-lg btn-block" type="submit"><i class="fa fa-rupee nav-icon"></i> Click here Pay</a>                   
                                          
                         <?php else: ?>
                             <a href="<?php echo e(url('/payment').'/'.$encryptedId); ?>" class="btn btn-success btn-lg btn-block" type="submit"><i class="fa fa-rupee nav-icon"></i> Click here Pay</a>        
                         <?php endif; ?>
                           </div>
                     </div>
                      <?php else: ?>
     <div class="paybutton" >
              <div class="form-group">
                   <?php
                   $encryptedId = encrypt($studentdata->id);
                          ?> 
                          <?php if($studentdata->status==1): ?>
                          <a href="<?php echo e(url('/payment').'/'.$encryptedId); ?>" class="btn btn-success btn-lg btn-block" type="submit"><i class="fa fa-rupee nav-icon"></i> Click here Pay</a>                   
                                          
                         <?php else: ?>
                             <a href="<?php echo e(url('/payment').'/'.$encryptedId); ?>" class="btn btn-success btn-lg btn-block" type="submit"><i class="fa fa-rupee nav-icon"></i> Click here Pay</a>        
                         <?php endif; ?>
                           </div>
                     </div>
    <?php endif; ?>
                                            
             <?php endif; ?>
            </div>
        </div>
    </div></div>
   

   

            </div>
        </div>
    </div></section></div>
   
    <script>
        $("#parentalincome").change(function () {
              $("#remissionfront").val("");
            if($('#parentalincome option:selected').text()=="Less than 1 Lakh INR"){
                $("#remissiontype").val('full').trigger('change');
                  $("#remissionfront").val("Full Tuition Fee Remission");
            }else{
                
                $("#remissionfront").val("2/3 Tuition Fee Remission");
            $("#remissiontype").val('1/3').trigger('change');
            }
         
        });
         $("#remission").change(function () {
        //alert($('#remission option:selected').text());
        if($('#remission option:selected').text()=="No"){
            $('.paybutton').show();
             $('.inputform').hide();
        }else{
             $('.paybutton').hide();
           $('.inputform').show();
        }
    });
    </script>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>