@if(!empty($studentlist))

<div class="table-responsive">
    <table id="example" class="display nowrap table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Rollno</th>
                <th>Name</th>
                <th>Email</th>
                <th>Category</th>
                <th>Program</th>
                <th>Admission Year</th>
                <th> (Acad Year/Acad Semester)</th>
                <th>Total Fee</th>

            </tr>
        </thead>
        <tbody>
            @foreach($studentlist as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->rollno }}</td>
                <td>{{ $item->name }}</td>
                <td>{{$item->email}}</td>
                <td>{{ $item->caste }}</td>
                <td>{{ $item->prog }}</td>
                <td>{{ $item->batch_year }}</td>
                <td>( {{ $feestructure->academic_year }}/ {{ $feestructure->academic_tearm }})</td>
                <td>{{ $feestructure->totalamount }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@if(count($studentlist) > 0)
<a href="#" class="btn btn-success btn-sm" id="uploaddata" onclick="uploaddata();" title="Add New Role">
    <i class="fa fa-upload" aria-hidden="true"></i> Allocate Fee
</a>
@endif
@else
<div class="alert alert-danger">
    No Student Found</div>
@endif


<script>
function uploaddata() {
    var program = $('#program').val();
    var admission_year = $('#admission_year').val();
    var feestructure = $('#feestructure').val();
    if (program && admission_year) {
        $.ajax({
            url: "{{ url('admin/uploaddataajax/')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'program': program,
                'admission_year': admission_year,
                'feestructure': feestructure
            },
            dataType: "json",
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                    printsuccessMsg(data.success);
                } else {
                    printErrorMsg(data.error);
                }

            }

        })
    }
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
            'csv', 'excelFlash', 'excel', {
                text: '',
                // action: function(e, dt, node, config) {
                //     dt.ajax.reload();
                // }
            }
        ]
    });

});
</script>

<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<!-- <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script> -->

<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">