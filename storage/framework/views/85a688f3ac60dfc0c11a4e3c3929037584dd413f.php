<?php $__env->startSection('content'); ?>
<style>
.table.dataTable tbody tr {
    background-color: #ffffff;
    color: #1f2d3d;
    font-weight: 600;
    font-size: medium;
}
.buttons-html5{
    color: #f8f9fa !important;
    background-color: #007bff;
    border-color: #007bff;
    background-image: linear-gradient(to bottom, #007bff 0%, #007bff 100%) !important;
}
.paginate_button{
    background:none !important;
    border: 1px solid #007bff;
    color:white !important;
    
    /* color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    background-image: linear-gradient(to bottom, #fff 0%, #007bff 100%) !important; */
}
.a.dt-button{
    color:#f8f9fa;
}
</style>
<div class="content-wrapper" style="min-height: 543px;">
    <!-- Content Header (Page header) -->

    <!-- Content Header (Page header) -->
    <div class="card card-primary">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Custom Fees Report</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card">
                    <div class="card-header">Fees Report Details</div>
                    <div class="card-body">
                        <!-- <a href="<?php echo e(url('/admin/feestudent')); ?>" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a> -->
                        <br />
                        <br />

                        <?php if($errors->any()): ?>
                        <ul class="alert alert-danger">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(url('/admin/feestudent')); ?>" accept-charset="UTF-8"
                            class="form-horizontal" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>


                            <?php echo $__env->make('admin.Report.form', ['formMode' => 'create'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                            <div class="col-sm-12">
                                <div id="resultstudentfees"></div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
    </section>
</div>
<script type="text/javascript">
$("document").ready(function() {
    $('#searchstudentfees').on('click', function() {
        $("#resultstudentfees").html("");
        var program = $('#program').val();
        var admission_year = $('#admission_year').val();
        var category = $('#category').val();
        var academic_year = $('#academic_year').val();
        var academic_tearm = $('#academic_tearm').val();
        if (program && admission_year && category && academic_year && academic_tearm) {
            $.ajax({
                url: "<?php echo e(url('admin/studentfeeslist/')); ?>",
                type: "POST",
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    'program': program,
                    'admission_year': admission_year,
                    'category': category,
                    'academic_year':academic_year,
                    'academic_tearm':academic_tearm
                },
                dataType: "json",
                success: function(data) {

                    $("#resultstudentfees").html(data.html);

                }

            })
        }else{
            alert('Please Select all Values')
        }
    });


});
</script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">


<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
	
	$('#example').DataTable({
		dom: 'Bfrtip',
        scrollX: true,
        buttons: [
            'excel','csv'
        ]	
	});
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>