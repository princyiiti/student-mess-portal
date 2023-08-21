<?php $__env->startSection('content'); ?>
   <div class="content-wrapper" style="min-height: 543px;">
        <!-- Content Header (Page header) -->
       
            <!-- Content Header (Page header) -->
            <div class="card card-primary">
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Allocate Fee Details </h1>
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
                    <div class="card-header">Allocate Fee Details  <?php echo e($model->id); ?></div>
                    <div class="card-body">

                       <!--  <a href="<?php echo e(url('/admin/role')); ?>" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="<?php echo e(url('/admin/role/' . $model->id . '/edit')); ?>" title="Edit Role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> -->

                     
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td><?php echo e($model->id); ?></td>
                                    </tr>
                                    <tr><th> Student Roll NO. </th><td> <?php echo e($model->rollno); ?> </td></tr>
                                    <tr><th> Student Name </th><td> <?php echo e($model->student_name); ?> </td></tr>
                                    <tr><th> Academic Year/Semeter </th>
                                        <td> <?php echo e($model->academic_year); ?>(<?php echo e($model->academic_tearm); ?>)</td></tr>

                                     <tr><th>Category </th>
                                        <td> <?php echo e($model->Feestructuredata->category); ?></td></tr>    
                                          <tr><th>Current Status </th>
                                        <td> 

                                            <?php if($model->status==0): ?>
                                             <span class="badge badge-danger">unpaid</span>
                                             <?php else: ?>
                                             <span class="badge badge-success">paid</span>
                                             <?php endif; ?>

                                        </td></tr>  
					<tr>
                                    <th> Extend Date </th>
                                    <td> <?php echo e(date('j \\ F Y', strtotime($model->extend_date))); ?>

                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="button" class="btn btn-primary btn-sm editDate"
                                            data-id="<?php echo e($model->id); ?>" data-original-title="Edit" data-toggle="modal"><i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            Edit date</button>
                                    </td>
                                </tr>
                                    <tr><th>   <h1>Fee Details </h1> </td><td></td></tr>
                                </tbody>
                            </table>
                            <table class="table table-hover">
                    <thead>
                        <tr>
                              <th>#</th>
                            <th>Fees Type</th>                  
                           
                            <!-- <th class="text-center">Payable Amount </th> -->
                            <th class="">Net Pay</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    <?php $__currentLoopData = $model->Feestructuredata->FeeDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                              <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($val->fee_type); ?></td>
                            <!-- <td><?php echo e($val->amount); ?></td> -->
                              <td><?php echo e($val->amount); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">Total Amount</th>
                              <!-- <th colspan="1"><?php echo e($model->totalamount); ?></th> -->
                                <th colspan="1"><?php echo e($model->totalamount); ?></th>
                              

                        </tr>
                    </tfoot>
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
<!-- Modal -->
<div class="modal fade" id="ajaxModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Extend Date Change</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="dateForm" name="dateForm" class="form-horizontal">
                    <input type="hidden" name="feesdetails_id" id="feesdetails_id" value="">
                    <div class="col-md-12">
                        <label for="name" class="col-sm-12 control-label">Extend Date</label>
                        <input type="text" name="extend_date" id="extend_date" value="" class="form-control datepicker">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveBtn">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!---model end --->
<!-- jQuery UI CSS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

<!-- jQuery Library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- jQuery UI JS -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    // Datapicker 
    $(".datepicker").datepicker({
        "dateFormat": "dd-mm-yy",
        changeYear: true
    });
});
$(function() {

    /*------------------------------------------
     --------------------------------------------
     Pass Header Token
     --------------------------------------------
     --------------------------------------------*/
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    /*------------------------------------------
    --------------------------------------------
    Click to Button
    --------------------------------------------
    --------------------------------------------*/
    $('#createNewProduct').click(function() {
        $('#saveBtn').val("create-product");
        $('#product_id').val('');
        $('#productForm').trigger("reset");
        $('#modelHeading').html("Create New Product");
        $('#ajaxModel').modal('show');
    });

    /*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.editDate', function() {
        var fees_id = $(this).data('id');
        //alert(fees_id);
        $.get("<?php echo e(url('/admin/studenttotalfee')); ?>" + '/' + fees_id + '/edit', function(data) {
            //$('#modelHeading').html("Edit Product");
            var thedate = new Date(Date.parse(data.extend_date));

            var fullDate = data.extend_date;
            var twoDigitMonth = thedate.getMonth() + "";
            if (twoDigitMonth.length == 1)
                twoDigitMonth = "0" + twoDigitMonth;
            var twoDigitDate = thedate.getDate() + "";
            if (twoDigitDate.length == 1)
                twoDigitDate = "0" + twoDigitDate;
            var currentDate = twoDigitDate + "-" + twoDigitMonth + "-" + thedate.getFullYear();


            //$('#saveBtn').val("edit-user");
            $('#ajaxModel').modal('show');
            $('#extend_date').val(currentDate);
            $('#feesdetails_id').val(data.id);
            // $('#name').val(data.name);
            // $('#detail').val(data.detail);
        })
    });

    /*------------------------------------------
    --------------------------------------------
    Create Product Code
    --------------------------------------------
    --------------------------------------------*/
    $('#saveBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Sending..');
        var fees_id = $('#feesdetails_id').val();
        var url = "<?php echo e(url('/admin/studenttotalfee')); ?>" + '/' + fees_id ;
        $.ajax({
            data: $('#dateForm').serialize(),
            url: url,
            type: "POST",
            dataType: 'json',
            success: function(data) {

                $('#dateForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                location.reload();
                //table.draw();

            },
            error: function(data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
    });

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>