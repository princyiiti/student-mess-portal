<?php $__env->startSection('content'); ?>
<div class="content-wrapper" style="min-height: 543px;">
    <!-- Content Header (Page header) -->

    <!-- Content Header (Page header) -->
    <div class="card card-primary">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <?php if(auth()->user()->role_id===3): ?><h1 class="m-0 text-dark">My Rebate List </h1><?php else: ?> <h1
                            class="m-0 text-dark">Student Rebate List </h1> <?php endif; ?>
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

            <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="alert alert-success print-success-msg" style="display:none">
        <ul></ul>
    </div>


                <!-- <div class="card-header"> </div> -->
                <div class="card-body" id="autorefresh">
                    <?php if(auth()->user()->role_id == 3 ): ?>
                    <a href="<?php echo e(url('/admin/rebate/create')); ?>" class="btn btn-success btn-sm" title="Add New Category">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>
                    <?php endif; ?>
                    <?php if(auth()->user()->role_id !=3): ?>

                    <input type="button" class="btn btn-info btn-sm" onclick="checkall(1)" name="" id="bulkapproved"
                        value="Bulk Approve">

                    <input type="button" class="btn btn-danger btn-sm" onclick="checkall(0)" name="" id="bulreject"
                        value="Bulk Reject">

                    <?php endif; ?>

                    

                    <br />
                    <br />
                    <div class="table-responsive">
                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkAllrebate" name=""></th>
                                    <th>Student Name</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Total Days</th>
                                    <th>Rebate Type</th>
                                    <th>Approved Document</th>
                                    <th>Status</th>
                                    <?php if(auth()->user()->role_id!=3): ?>
                                    <th>Actions</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody >
                                <?php $__currentLoopData = $Rebate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="tdid">
                                    <td><?php if($item->mess_subcription_id): ?><input type="checkbox" id="" name="rebates" value="<?php echo e($item->id); ?>"><?php endif; ?></td>
                                    <td><?php echo e($item->userdata->name); ?> (<?php echo e($item->userdata->email); ?>)</td>
                                    <td><?php echo e(date('d-M-Y', strtotime( $item->from_date))); ?></td>
                                    <td><?php echo e(date('d-M-Y', strtotime( $item->to_date))); ?></td>

                                    <td><?php echo e($item->total_rebate_day); ?></td>
                                    <td><span <?php if($item->type_rebate=='Short Term Rebate'): ?> class="label label-primary"
                                            <?php else: ?> class="label label-info" <?php endif; ?> ><?php echo e($item->type_rebate); ?></span>
                                    </td>
                                    <td>
                                        <?php if($item->file_path): ?>
                                        <a href="<?php echo e(asset($item->file_path)); ?>" download><i
                                                class="fas fa-file-download"></i> Download</a>
                                        <?php endif; ?>
                                    </td>
                                    <td id="<?php echo e($item->id); ?>">
                                        <?php if($item->status==1): ?>

                                        <span style="color: green;"> Approved</span>
                                        <?php elseif($item->status==2): ?>
                                        <span style="color: #007bff;">Pending</span>
                                        <?php elseif($item->status==0): ?>
                                        <span style="color: red;">Rejected</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if(auth()->user()->role_id!=3): ?>
                                        <?php if($item->mess_subcription_id): ?>
                                        <?php if($item->status==1): ?>

                                        <a href="<?php echo e(url('/admin/rebate/active/' . $item->id.'/2')); ?>"
                                            title="View rebate"><button
                                                class="btn btn-warning btn-sm">Unapprove</button></a>
                                        <a href="<?php echo e(url('/admin/rebate/active/' . $item->id.'/0')); ?>"
                                            title="View rebate"><button
                                                class="btn btn-danger btn-sm">Reject</button></a>
                                        <?php elseif($item->status==0): ?>
                                        <a href="<?php echo e(url('/admin/rebate/active/' . $item->id.'/1')); ?>"
                                            title="View rebate"><button
                                                class="btn btn-success btn-sm">Approve</button></a>
                                        <a href="<?php echo e(url('/admin/rebate/active/' . $item->id.'/2')); ?>"
                                            title="View rebate"><button
                                                class="btn btn-warning btn-sm">Accept</button></a>
                                        <?php elseif($item->status==2): ?>
                                        <a href="<?php echo e(url('/admin/rebate/active/' . $item->id.'/1')); ?>"
                                            title="View rebate"><button
                                                class="btn btn-success btn-sm">Approve</button></a>
                                        <a href="<?php echo e(url('/admin/rebate/active/' . $item->id.'/0')); ?>"
                                            title="View rebate"><button
                                                class="btn btn-danger btn-sm">Reject</button></a>
                                        <?php endif; ?>

                                        <?php else: ?>
                                        <span class="">Subcription Data Upload </span> &nbsp;
                                        <?php endif; ?>

                                        <?php if(auth()->user()->role_id==1): ?>
                                        <!-- <a href="<?php echo e(url('/admin/slot/' . $item->id . '/edit')); ?>" title="Edit Category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> -->

                                        <form method="POST" action="<?php echo e(url('/admin/rebate' . '/' . $item->id)); ?>"
                                            accept-charset="UTF-8" style="display:inline">
                                            <?php echo e(method_field('DELETE')); ?>

                                            <?php echo e(csrf_field()); ?>

                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete "
                                                onclick="return confirm(&quot;Confirm delete?&quot;)">Delete</button>
                                        </form>
                                        <?php endif; ?>


                                    </td>
                                    <?php else: ?>
                                    <td></td>
                                    <?php endif; ?>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                         <div class="pagination-wrapper"> <?php echo $Rebate->appends(['search' => Request::get('search')])->render(); ?> </div> 
                    </div>

                </div>

            </div>
    </section>
</div>
</div>
</div>
</div>

<script type="text/javascript">
function changestatusactive(e) {
    alert("active");
    //document.getElementById("demo").style.color = "red";
}

function changestatusinactive(e) {
    alert("INactive");
    //document.getElementById("demo").style.color = "red";
}

function checkall(status) {
    var rebateids = new Array();
    $('input[name="rebates"]:checked').each(function() {
        rebateids.push($(this).val())
    });

    if (rebateids.length > 0) {
        let url = "<?php echo e(url('/')); ?>";
        $.ajax({
            url: "<?php echo e(url('admin/rebate_approved/')); ?>",
            type: "POST",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                'status': status,
                'rebates': rebateids,
            },
            dataType: "json",
            success: function(data) {
                if (data.count == 1) {
                    printsuccessMsg(data.html);
                    
                    $('#autorefresh').load("#autorefresh"); 

                    setInterval(refreshPage(), 1000); 
                } else {
                    printErrorMsg(data.html);
                }
            }

        })

    }else {
        alert('please select the checkbox');
    }


}
function refreshPage() {
    location.reload("#autorefresh");
  
}
function printsuccessMsg(msg) {
    $(".print-success-msg").find("ul").html('');
    $(".print-success-msg").css('display', 'block');
    $(".print-success-msg").find("ul").append('<li>' + msg + '</li>');
}

function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $(".print-error-msg").find("ul").append('<li>' + msg + '</li>');
    // $.each( msg, function( key, value ) {
    //  $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    // });
}
</script>

<script type="text/javascript">
$("#checkAllrebate").click(function() {
    $('input:checkbox').not(this).prop('checked', this.checked);
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>