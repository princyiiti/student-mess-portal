

<?php $__env->startSection('content'); ?>
<style>
.table.dataTable tbody tr {
    background-color: #ffffff;
    color: #1f2d3d;
    font-weight: 600;
    font-size: medium;
}

.buttons-html5 {
    color: #f8f9fa !important;
    background-color: #007bff;
    border-color: #007bff;
    background-image: linear-gradient(to bottom, #007bff 0%, #007bff 100%) !important;
}

.paginate_button {
    /* background: linear-gradient(to bottom, #007bff 0%, #007bff 100%) !important; */
    background: none !important;
    border: 1px solid #007bff;
    color: white !important;

    /* color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    background-image: linear-gradient(to bottom, #fff 0%, #007bff 100%) !important; */
}

.a.dt-button {
    color: #f8f9fa;
}
.table{
    width: 1600px !important;
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
                        <h1 class="m-0 text-dark">Mess Subscription List</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">

                    <div class="card-body">
                        <div class="row">

                            <div class="form-group col-md-3">
                                <label for="inputName">Form Date</label>
                                <input type="date" name="from_date" id="from_date" class="form-control"
                                    placeholder="From Date" />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputName">To Date</label>
                                <input type="date" name="to_date" id="to_date" class="form-control"
                                    placeholder="To Date" />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputName">Select Caterer</label>
                                <select class="form-control" name="mess_name" id="mess_name"
                                    aria-label="Default select example">
                                    <option value="">Select Caterer</option>
                                    <?php if($messlistst): ?>
                                    <?php $__currentLoopData = $messlistst; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($list->title); ?>"><?php echo e($list->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-1">
                                <label for="inputName">Applied Filter</label>
                                <input type="button" class="btn btn-primary form-control" name="filter" id="filter"
                                    value="Applied Filter" class="">
                            </div>
                            <div class=" form-group  col-md-1">
                                <form action="<?php echo e(route('messrebatExcel')); ?>">
                                    <label for="inputName">Download </label>
                                    <input type="submit" class="btn btn-primary form-control" value="Download excel">
                                </form>
                            </div>

                            <div class=" form-group  col-md-1">
                                <form action='feesExcel'>
                                    <label for="inputName">Refresh</label>
                                    <button type="button" name="refresh" id="refresh"
                                        class="btn btn-primary form-control">Refresh</button>
                                </form>
                            </div>
                        </div>
                        <table id="messsubscription" class="table table-bordered data-table" style="width: 1600px !important;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Program Name</th>
                                <th>Hostel Name</th>
                                <th>Mess Name</th>
                                <th>Plan Type</th>
                                <th> From Date</th>
                                <th>To Date</th>
                                <th>Rebate Day</th>
                                <th>Days</th>
                                <?php if(auth()->user()->role_id !=5): ?>
                                <th>Actions</th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    var table = $('#messsubscription').DataTable({
        pagination: true,
        responsive: true,
        processing: true,
        serverSide: true,
        scrollX: true,
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel'
        ],
        ajax: {
            url: "<?php echo e(route('admin.mess_subcription')); ?>",
            data: function(d) {
                d.from_date = $('#from_date').val();
                d.to_date = $('#to_date').val();
                d.status = $('#status').val(),
                d.mess_name = $('#mess_name').val()
            }
        },
        columns: [
            {
                data: 'id',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'student_name',
                name: 'student_name'
            },
            {
                data:'program',
                name:'program'
            },
            {
                data: 'hostel_name',
                name: 'hostel_name '
            },
            {
                data: 'mess_name',
                name: 'mess_name'
            },
            {
                data: 'plan_type',
                name: 'plan_type'
            },
            {
                data: 'from_date',
                name: 'from_date'
            },
            {
                data: 'to_date',
                name: 'to_date',
            },
            {
                data: 'rebat_day',
                name: 'rebat_day',
            },
            {
                data: 'totalday',
                name: 'totalday',
            },
            {
                data: 'Actions',
                name: 'Actions',
            },

        ]
    });
    $('#status').change(function(){
        var status = $('#status').val();
        table.draw();
    });
    $('#mess_name').change(function(){
        var mess_name = $('#mess_name').val();
        table.draw();
    });

    $('#filter').click(function() {
        var from_date = $('#from_date').val();
        var filter_to_date = $('#to_date').val();
        table.draw();
    });
    $('#refresh').click(function(){
        location.reload();
        $('#status').val('');
        $('#mess_name').val('');
        $('#from_date').val('');
        $('#to_date').val('');
        $('#messreport').DataTable().destroy();
        var ta = $('#messreport').dataTable(); 
        ta.ajax.reload();
        
    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>