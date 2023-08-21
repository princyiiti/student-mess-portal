<?php $__env->startSection('content'); ?>
<div class="content-wrapper" style="min-height: 543px;">
    <!-- Content Header (Page header) -->

    <!-- Content Header (Page header) -->
    <div class="card card-primary">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <?php if(auth()->user()->role_id===3): ?><h1 class="m-0 text-dark">Student Current Subcription </h1><?php else: ?>
                        <h1 class="m-0 text-dark">Student Current Subcription </h1> <?php endif; ?>
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

                    <form method="GET" action="<?php echo e(url('/admin/subcription')); ?>" accept-charset="UTF-8" class="form-inline
                    my-2 my-lg-0 float-right" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..."
                                value="<?php echo e(request('search')); ?>">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            &nbsp;
                            <span class="input-group-append">
                                <a href="<?php echo e(url('/admin/subcription')); ?>" class="btn btn-secondary" id="refresh">
                                    <i class="fa fa-refresh" aria-hidden="true"></i></a>

                                <span>
                        </div>
                    </form>

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

                                    <?php if(auth()->user()->role_id!=3): ?>
                                    <th>Actions</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $StudnetCurrentSubcription; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->student_name); ?> (<?php echo e($item->student_email); ?>)</td>
                                    <td><?php echo e(date('d-M-Y', strtotime( $item->start_date))); ?></td>
                                    <td><?php echo e(date('d-M-Y', strtotime( $item->end_date))); ?></td>


                                    <td>

                                        <?php if(auth()->user()->role_id !=3): ?>
                                        <!-- <a href="<?php echo e(url('/admin/slot/' . $item->id . '/edit')); ?>" title="Edit Category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> -->

                                        <form method="POST" action="<?php echo e(url('/admin/subcription' . '/' . $item->id)); ?>"
                                            accept-charset="UTF-8" style="display:inline">
                                            <?php echo e(method_field('DELETE')); ?>

                                            <?php echo e(csrf_field()); ?>

                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete "
                                                onclick="return confirm(&quot;Confirm delete?&quot;)">Delete</button>
                                        </form>
                                        <?php endif; ?>

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> <?php echo e($StudnetCurrentSubcription->links()); ?> </div>
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