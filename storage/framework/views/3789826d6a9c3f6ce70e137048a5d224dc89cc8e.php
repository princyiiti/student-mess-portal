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
</style>
<div class="content-wrapper" style="min-height: 543px;">
    <!-- Content Header (Page header) -->

    <!-- Content Header (Page header) -->
    <div class="card card-primary">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 card-header">
                        <h1 class="m-0 text-dark" style="color:white !important;">All Student Fee Report</h1>
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

                        </div><br>
                        <div class="row">

                            <div class="form-group col-md-2">
                                <label for="inputName">Form Date</label>
                                <input type="date" name="from_date" id="from_date" class="form-control"
                                    placeholder="From Date" />
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputName">To Date</label>
                                <input type="date" name="to_date" id="to_date" class="form-control"
                                    placeholder="To Date" />
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputName">Select Category</label>
                                <select class="form-control" name="filter_category" id="filter_category"
                                    aria-label="Default select example">
                                    <option value="">Select Category</option>
                                    <?php if($category): ?>
                                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($list->castcategory); ?>"><?php echo e($list->castcategory); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputName">Select Program</label>
                                <select class="form-control" name="filter_program" id="filter_program"
                                    aria-label="Default select example">
                                    <option value=''>Select Program</option>
                                    <?php if($category): ?>
                                    <?php $__currentLoopData = $program; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($list->program); ?>"><?php echo e($list->program); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputName">Select Status</label>
                                <select class="form-control" name="filter_status" id="filter_status"
                                    aria-label="Default select example">
                                    <option value=''>Select Status</option>

                                    <option value="2">Paid</option>
                                    <option value="0">Unpaid</option>
                                    <option value="3">Pending</option>

                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="inputName">Applied Filter</label>
                                <input type="button" class="btn btn-primary form-control" name="filter" id="filter"
                                    value="Applied Filter" class="">
                            </div>
                            <div class=" form-group  col-md-2">
                                <form action="<?php echo e(route('AllFeeExcel')); ?>">
                                    <label for="inputName">Download </label>
                                    <input type="submit" class="btn btn-primary form-control" value="Download excel">
                                </form>
                            </div>

                            <div class=" form-group  col-md-2">

                                <label for="inputName">Refresh</label>
                                <button type="button" name="refresh" id="refresh"
                                    class="btn btn-primary form-control">Refresh</button>

                            </div>
                        </div>

                        <table id="masterfees" class="table table-bordered data-table"
                            style="width: 1600px !important;">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Rollno</th>
                                    <th>Email</th>
                                    <th>Student Name</th>
                                    <th>Program</th>
                                    <th>Admission year</th>
                                    <th>Academic year</th>
                                    <th>Academic term </th>
                                    <th>Category</th>
                                    <th>Total Amount </th>
                                    <th>Total Paid Amount</th>
                                    <th>Status</th>
                                    <th>Transation Id</th>
                                    <th>Transation Date</th>
                                    <th>Actions</th>

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
function withJquery() {
    console.time('time1');
    var temp = $("<input>");
    $("body").append(temp);
    temp.val($('#copytext').text()).select();
    document.execCommand("copy");
    temp.remove();
    console.timeEnd('time1');
}
$(document).ready(function() {
    var table = $('#masterfees').DataTable({
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
            url: "<?php echo e(route('admin.getmasterfeesdetails')); ?>",
            data: function(d) {
                d.filter_status = $('#filter_status').val(),
                    d.filter_category = $('#filter_category').val(),
                    d.filter_program = $('#filter_program').val(),
                    //d.search = $('input[type="search"]').val()
                    d.from_date = $('#from_date').val();
                d.to_date = $('#to_date').val();
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
                data: 'rollno',
                name: 'rollno'
            },
            {
                data:'email',
                name:'email'
            },
            {
                data: 'student_name',
                name: 'student_name'
            },
            {
                data: 'program',
                name: 'program'
            },
            {
                data: 'ademission_year',
                name: 'ademission_year'
            },
            {
                data: 'academic_year',
                name: 'academic_year'
            },
            {
                data: 'academic_tearm',
                name: 'academic_tearm'
            },
            {
                data: 'category',
                name: 'category'
            },
            {
                data: 'totalamount',
                name: 'totalamount'
            },
            {
                data:'total_paid_amount',
                name:'total_paid_amount'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'transaction_id',
                name: 'transaction_id',
                // render: function(data, type, row, meta) {

                //     return '<a href="#">'+transaction_id+'</a>';

                // }
            },

            {
                data: 'paid_date',
                name: 'paid_date'
            },
            {
                data: 'Actions',
                name: 'Actions',
                orderable: false,
                serachable: false,
                sClass: 'text-center'
            },

        ]
    });

    $('#filter_category').change(function() {
        table.draw();
    });
    $('#filter_program').change(function() {
        table.draw();
    });
    $('#filter_status').change(function() {
        table.draw();
    });

    $('#filter').click(function() {
        var from_date = $('#from_date').val();
        var filter_to_date = $('#to_date').val();
        table.draw();
    });
    $('#refresh').click(function() {
        location.reload();
        $('#filter_category').val('');
        $('#filter_program').val('');
        $('#from_date').val('');
        $('#to_date').val('');
        $('#masterfees').DataTable().destroy();
        var ta = $('#masterfees').dataTable();
        //ta.ajax.reload();


    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>