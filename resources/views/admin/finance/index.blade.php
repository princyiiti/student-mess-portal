@extends('layouts.app')

@section('content')
<style>
.table.dataTable tbody tr {
    background-color: #ffffff;
    color: #1f2d3d;
    font-weight: 600;
    font-size: medium;
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
                        <h1 class="m-0 text-dark">Student Fee Master</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Student Fee Master</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <form action='feesExcel'>
                                <input type="submit" class="btn btn-primary" value="Download excel">
                            </form>
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
                            <!-- <div class="form-group col-md-2">
                                <label for="inputName">Select Category</label>
                                <select class="form-control" name="filter_category" id="filter_category"
                                    aria-label="Default select example">
                                    <option selected>Select Category</option>
                                    @if($category)
                                    @foreach($category as $list)
                                    <option value="{{$list->category}}">{{$list->category}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputName">Select Program</label>
                                <select class="form-control" name="filter_program" id="filter_program"
                                    aria-label="Default select example">
                                    <option selected>Select Program</option>
                                    @if($category)
                                    @foreach($program as $list)
                                    <option value="{{$list->program}}">{{$list->program}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div> -->

                            <!-- <div class="form-group col-md-2">
                                <label for="inputName">Search</label>
                                <input type="text" class="form-control" id="searchInput"
                                    placeholder="Type keywords..." />
                            </div> -->

                            <div class="form-group col-md-2">
                                <label for="inputName">Filter</label>
                                <input type="button" class="btn btn-primary form-control" name="filter" id="filter"
                                    value="Filter" class="">
                                <!-- <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                                <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button> -->
                            </div>



                        </div>
                        <table class="table table-bordered table-striped dataTable dtr-inline" id='feesdata'
                            width='100%' border="1" style='border-collapse: collapse;'>
                            <thead style="font-size: larger;">
                                <tr>
                                    <th>s.no</th>
                                    <th>rollno</th>
                                    <th>program</th>
                                    <th>admission year</th>
                                    <th>academic year</th>
                                    <th>academic term </th>
                                    <th>category</th>
                                    <th>status</th>
                                    <th>fee type </th>
                                    <th>Transation Date</th>
                                    <th>Transation Id</th>
                                    <th>Action</th>

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
</div>
</div>
</div>
<!-- Script -->
<script src="{{asset('jquery-3.6.0.min.js')}}" type="text/javascript"></script>
<script src="{{asset('DataTables/datatables.min.js')}}" type="text/javascript"></script>


<!-- Datatables CSS CDN -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

<!-- jQuery CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Datatables JS CDN -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

    fill_datatable();


    $('#filter').click(function() {
        var from_date = $('#from_date').val();
        var filter_to_date = $('#to_date').val();

        console.log('data', from_date);

        if (from_date != '' && to_date != '') {

            $('#feesdata').DataTable().destroy();
            fill_datatable_with_data(from_date, to_date);
        } else {
            alert('Select Both filter option');
        }
    });


    function fill_datatable_with_data(filter_gender = '', filter_country = '') {
        var dataTable = $('#customer_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "searching": false,
            "ajax": {
                url: "fetch.php",
                type: "POST",
                data: {
                    filter_gender: filter_gender,
                    filter_country: filter_country
                }
            }
        });
    }



    function fill_datatable(from_date = '', to_date = '') {


        var dataTable = $('#feesdata').DataTable({

            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: "{{route('admin.getfeesdetails')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                from_date: from_date,
                to_date: to_date
            },
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            columns: [{
                    data: 'id'
                },
                {
                    data: 'rollno'
                },
                {
                    data: 'program'
                },
                {
                    data: 'admission_year'
                },
                {
                    data: 'academic_year'
                },
                {
                    data: 'academic_terms'
                },
                {
                    data: 'category'
                },
                {
                    data: 'status',
                    render: function(data, type, row, meta) {
                        if (data == 'Paid') {
                            return '<a href="#" class="btn btn-success">' + data + '</a>';
                        } else {
                            return '<a href="#" class="btn btn-warning">' + data + '</a>';
                        }

                    }
                },
                {
                    data: 'fee_type'
                },
                {
                    data: 'transaction_date'
                },
                {
                    data: 'transction_id'
                },
                {
                    data: 'id',
                    render: function(data, type, row, meta) {
                        if (data) {
                            return '<a href="/view_fees_details/'+data+'" class="btn btn-info"> View</a>' ;
                        }
                        // <a href="' + data + '" class="url">' + data + '</a> '

                    }
                },

            ]
        });

    }

});
</script>
@endsection