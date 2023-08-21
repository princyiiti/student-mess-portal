

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


                <!-- <div class="card-header"> </div> -->
                <div class="card-body">
                    <a href="<?php echo e(url('/admin/rebate/create')); ?>" class="btn btn-success btn-sm" title="Add New Category">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>

                    

                    <br />
                    <br />
                    <div class="table-responsive">
                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student Name</th>
                                    <th>From Date</th>

                                    <th>To Date</th>
                                    <th>Rebate Type</th>
                                    <th>Status</th>
                                    <?php if(auth()->user()->role_id!=3): ?>
                                    <th>Actions</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $Rebate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->userdata->name); ?> (<?php echo e($item->userdata->email); ?>)</td>
                                    <td><?php echo e(date('d-M-Y', strtotime( $item->from_date))); ?></td>
                                    <td><?php echo e(date('d-M-Y', strtotime( $item->to_date))); ?></td>


                                    <td><span <?php if($item->type_rebate=='Short Term Rebate'): ?> class="label label-primary"
                                            <?php else: ?> class="label label-info" <?php endif; ?> ><?php echo e($item->type_rebate); ?></span>
                                    </td>
                                    <td id="<?php echo e($item->id); ?>">
                                        <?php if($item->status==1): ?>

                                        <span style="color: green;"> Approved</span>
                                        <?php elseif($item->status==2): ?>
                                        <span style="color: #007bff;">Pending</span>
                                        <?php elseif($item->status==0): ?>
                                        <span style="color: red;">Reject</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(auth()->user()->role_id!=3): ?>
                                        <?php if($item->status==1): ?>

                                        <a href="<?php echo e(url('/admin/rebate/active/' . $item->id.'/2')); ?>"
                                            title="View rebate"><button
                                                class="btn btn-warning btn-sm">Pending</button></a>
                                        <a href="<?php echo e(url('/admin/rebate/active/' . $item->id.'/0')); ?>"
                                            title="View rebate"><button
                                                class="btn btn-danger btn-sm">Reject</button></a>
                                        <?php elseif($item->status==0): ?>
                                        <a href="<?php echo e(url('/admin/rebate/active/' . $item->id.'/1')); ?>"
                                            title="View rebate"><button
                                                class="btn btn-success btn-sm">Approved</button></a>
                                        <a href="<?php echo e(url('/admin/rebate/active/' . $item->id.'/0')); ?>"
                                            title="View rebate"><button
                                                class="btn btn-danger btn-sm">Reject</button></a>
                                        <?php elseif($item->status==2): ?>
                                        <a href="<?php echo e(url('/admin/rebate/active/' . $item->id.'/1')); ?>"
                                            title="View rebate"><button
                                                class="btn btn-success btn-sm">Approved</button></a>
                                        <a href="<?php echo e(url('/admin/rebate/active/' . $item->id.'/0')); ?>"
                                            title="View rebate"><button
                                                class="btn btn-danger btn-sm">Reject</button></a>
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
                                        <?php endif; ?>
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

<script type="text/javascript">
function changestatusactive(e) {
    alert("active");
    //document.getElementById("demo").style.color = "red";
}

function changestatusinactive(e) {
    alert("INactive");
    //document.getElementById("demo").style.color = "red";
}

function senddata() {

}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>