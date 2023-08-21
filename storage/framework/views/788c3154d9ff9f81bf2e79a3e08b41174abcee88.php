<?php if($data): ?>
<table id="example" class="display nowrap table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>S.no</th>
			<th>Roll no</th>
			<th>Student Name</th>
			<th>Program</th>
			<th>Category</th>
            <th>Admission Year</th>
            <th>Academic Year/Sem</th>
         
                <?php if($feestructure): ?>
                <?php $__currentLoopData = $feestructure->FeeDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th><?php echo e($list->fee_type); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <th>Total Fee</th>
           

		</tr>
	</thead>
	<tbody>
        <?php if($data): ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td><?php echo e($key +1); ?></td>
			<td><?php echo e($value->rollno); ?></td>
			<td><?php echo e($value->student_name); ?></td>
			<td><?php echo e($value->program); ?></td>
			<td><?php echo e($value->category); ?></td>
            <td><?php echo e($value->ademission_year); ?></td>
            <td><?php echo e($value->academic_year); ?> / <?php echo e($value->academic_tearm); ?></td>
            <!-- <td> -->
            
            <?php $__currentLoopData = $value->Feestructuredata->FeeDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                <td><?php echo e($val->amount); ?></td>
                                   
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <td><?php echo e($value->totalamount); ?></td>
               
            <!-- </td> -->
		</tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
	</tbody>
</table>
<?php else: ?>
<div class="col-md-12">
    <h5>No data found</h5>
</div>
<?php endif; ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">


<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<!-- <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script> -->

<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
	//Only needed for the filename of export files.
	//Normally set in the title tag of your page.
	//document.title='Simple DataTable';
	// DataTable initialisation
	$('#example').DataTable({
		dom: 'Bfrtip',
        scrollX: true,
        buttons: [
            'excel', 'pdf', 'csv'
        ]	
	});
});
</script>