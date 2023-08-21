@if($data)
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
         
                @if($feestructure)
                @foreach($feestructure->FeeDetails as $list)
                <th>{{$list->fee_type}}</th>
                @endforeach
                @endif
            <th>Total Fee</th>
           

		</tr>
	</thead>
	<tbody>
        @if($data)
        @foreach($data as $key => $value)
		<tr>
			<td>{{$key +1}}</td>
			<td>{{$value->rollno}}</td>
			<td>{{$value->student_name}}</td>
			<td>{{$value->program}}</td>
			<td>{{$value->category}}</td>
            <td>{{$value->ademission_year}}</td>
            <td>{{$value->academic_year}} / {{$value->academic_tearm}}</td>
            <!-- <td> -->
            
            @foreach($value->Feestructuredata->FeeDetails as $val)
                                    
                <td>{{$val->amount}}</td>
                                   
            @endforeach
            <td>{{$value->totalamount}}</td>
               
            <!-- </td> -->
		</tr>
        @endforeach
        @endif
	</tbody>
</table>
@else
<div class="col-md-12">
    <h5>No data found</h5>
</div>
@endif

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