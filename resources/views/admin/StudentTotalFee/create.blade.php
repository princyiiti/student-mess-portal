@extends('layouts.app')

@section('content')
   <div class="content-wrapper" style="min-height: 543px;">
        <!-- Content Header (Page header) -->
       
            <!-- Content Header (Page header) -->
            <div class="card card-primary">
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> Student Fee Allocations</h1>
                  </div><!-- /.col -->                  
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            </div>
               <section class="content">
              <div class="container-fluid">
<div class="card card-primary">
                <div class="card">
                    <div class="card-header">Student Fee Allocations</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/studenttotalfee') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.StudentTotalFee.form', ['formMode' => 'create'])
                            <div class="col-sm-12">
<div id="resultdata"></div>
</div>
                        </form>

                    </div>
                </div>
              </div>
            </section>
</div>
            </div>
        </div>
    </div>
   <script type="text/javascript">
            $("document").ready(function () {
                 $(".datapopulate").hide();
                $('select[name="program"]').on('change', function () {
                    //var program = $(this).val();
                    var program = $('#program').val();
                    var admission_year=$('#admission_year').val();
                    $('select[name="feestructure"]')
                    if (program && admission_year) {
                        $.ajax({
                            url: "{{ url('admin/structurelistajax/')}}",
                            type: "POST",
                            data:{ "_token": "{{ csrf_token() }}",'program':program,'admission_year':admission_year},
                            dataType: "json",
                            success: function (data) {
 $(".datapopulate").show();
                                $('select[name="feestructure"]').empty();
                                console.log(data);
                                $.each(data, function (key, value) {

                              //console.log(value['academic_tearm']);
                                    $('select[name="feestructure"]').append('<option value=" ' + value['id'] + '">' + value['program'] +'('+ value['academic_year']+'/'+ value['academic_tearm'] +')'+ value['category']+'</option>');
                                })
                            }

                        })
                    } else {
                        $('select[name="subcategory"]').empty();
                    }
                });
                $('select[name="admission_year"]').on('change', function () {
                    var admission_year = $('#admission_year').val();
                    var program=$('#program').val();
                    $('select[name="feestructure"]')
                    if (program && admission_year) {
                        $.ajax({
                            url: "{{ url('admin/structurelistajax/')}}",
                            type: "POST",
                            data:{ "_token": "{{ csrf_token() }}",'program':program,'admission_year':admission_year},
                            dataType: "json",
                            success: function (data) {
                                $(".datapopulate").show();
                                $('select[name="feestructure"]').empty();
                                console.log(data);
                                $.each(data, function (key, value) {

                              //console.log(value['academic_tearm']);
                                    $('select[name="feestructure"]').append('<option value=" ' + value['id'] + '">' + value['program'] +'('+ value['academic_year']+'/'+ value['academic_tearm'] +')'+ value['category']+'</option>');
                                })
                            }

                        })
                    } else {
                        $('select[name="subcategory"]').empty();
                    }
                });


                $('#searchstudent').on('click', function () {
                   $("#resultdata").html("");
                    var program = $('#program').val();
                    var admission_year=$('#admission_year').val();                     
                    var feestructure=$('#feestructure').val();
                    if (program && admission_year) {
                        $.ajax({
                            url: "{{ url('admin/studentlistajax/')}}",
                            type: "POST",
                            data:{ "_token": "{{ csrf_token() }}",'program':program,'admission_year':admission_year,'feestructure':feestructure},
                            dataType: "json",
                            success: function (data) {
                           
                               $("#resultdata").html(data.html);
                              
                            }

                        })
                    }
                });


            });
            
       
            
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
            'copy','csv', 'excel', 'pdf'
        ]	
	});
});
setTimeout(function () {

// Closing the alert
$('.alert').alert('close');
}, 500000);
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
@endsection

