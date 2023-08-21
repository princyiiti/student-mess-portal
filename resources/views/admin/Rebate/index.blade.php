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
                        @if(auth()->user()->role_id===3)<h1 class="m-0 text-dark">My Rebate List </h1>@else <h1
                            class="m-0 text-dark">Student Rebate List </h1> @endif
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

            <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="alert alert-success print-success-msg" style="display:none">
        <ul></ul>
    </div>


                <!-- <div class="card-header"> </div> -->
                <div class="card-body">
                    @if(auth()->user()->role_id == 3 )
                    <a href="{{ url('/admin/rebate/create') }}" class="btn btn-success btn-sm" title="Add New Category">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>
                    @endif
                    @if(auth()->user()->role_id !=3)

                    <input type="button" class="btn btn-info btn-sm" onclick="checkall(1)" name="" id="bulkapproved"
                        value="Bulk Approve">

                    <input type="button" class="btn btn-danger btn-sm" onclick="checkall(0)" name="" id="bulreject"
                        value="Bulk Reject">

                    @endif

                    {{--  <form method="GET" action="{{ url('/admin/slot') }}" accept-charset="UTF-8" class="form-inline
                    my-2 my-lg-0 float-right" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search..."
                            value="{{ request('search') }}">
                        <span class="input-group-append">
                            <button class="btn btn-secondary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    </form> --}}

                    <br />
                    <br />
                    <div class="table-responsive" id="autorefresh">
                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkAllrebate" name=""></th>
                                    <th>Student Name</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Total Days</th>
                                    <th>Rebate Type</th>
                                    <th>Approved Document</th>
                                    <th>Status</th>
                                    @if(auth()->user()->role_id!=3)
                                    <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Rebate as $item)
                                <tr>
                                    <td>@if($item->mess_subcription_id)<input type="checkbox" id="" name="rebates" value="{{ $item->id }}">@endif</td>
                                    <td>{{  $item->userdata->name  }} ({{$item->userdata->email}})</td>
                                    <td>{{ date('d-M-Y', strtotime( $item->from_date)) }}</td>
                                    <td>{{ date('d-M-Y', strtotime( $item->to_date)) }}</td>

                                    <td>{{ $item->total_rebate_day }}</td>
                                    <td><span @if($item->type_rebate=='Short Term Rebate') class="label label-primary"
                                            @else class="label label-info" @endif >{{  $item->type_rebate  }}</span>
                                    </td>
                                    <td>
                                        @if($item->file_path)
                                        <a href="{{ asset($item->file_path) }}" download><i
                                                class="fas fa-file-download"></i> Download</a>
                                        @endif
                                    </td>
                                    <td id="{{$item->id}}">
                                        @if($item->status==1)

                                        <span style="color: green;"> Approved</span>
                                        @elseif($item->status==2)
                                        <span style="color: #007bff;">Pending</span>
                                        @elseif($item->status==0)
                                        <span style="color: red;">Reject</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if(auth()->user()->role_id!=3)
                                        @if($item->mess_subcription_id)
                                        @if($item->status==1)

                                        <a href="{{ url('/admin/rebate/active/' . $item->id.'/2') }}"
                                            title="View rebate"><button
                                                class="btn btn-warning btn-sm">Pending</button></a>
                                        <a href="{{ url('/admin/rebate/active/' . $item->id.'/0') }}"
                                            title="View rebate"><button
                                                class="btn btn-danger btn-sm">Reject</button></a>
                                        @elseif($item->status==0)
                                        <a href="{{ url('/admin/rebate/active/' . $item->id.'/1') }}"
                                            title="View rebate"><button
                                                class="btn btn-success btn-sm">Approved</button></a>
                                        <a href="{{ url('/admin/rebate/active/' . $item->id.'/2') }}"
                                            title="View rebate"><button
                                                class="btn btn-warning btn-sm">Pending</button></a>
                                        @elseif($item->status==2)
                                        <a href="{{ url('/admin/rebate/active/' . $item->id.'/1') }}"
                                            title="View rebate"><button
                                                class="btn btn-success btn-sm">Approved</button></a>
                                        <a href="{{ url('/admin/rebate/active/' . $item->id.'/0') }}"
                                            title="View rebate"><button
                                                class="btn btn-danger btn-sm">Reject</button></a>
                                        @endif

                                        @else
                                        <span class="">Subcription Data Upload </span> &nbsp;
                                        @endif

                                        @if(auth()->user()->role_id==1)
                                        <!-- <a href="{{ url('/admin/slot/' . $item->id . '/edit') }}" title="Edit Category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> -->

                                        <form method="POST" action="{{ url('/admin/rebate' . '/' . $item->id) }}"
                                            accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete "
                                                onclick="return confirm(&quot;Confirm delete?&quot;)">Delete</button>
                                        </form>
                                        @endif


                                    </td>
                                    @else
                                    <td></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                         <div class="pagination-wrapper"> {!! $Rebate->appends(['search' => Request::get('search')])->render() !!} </div> 
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

function checkall(status) {
    var rebateids = new Array();
    $('input[name="rebates"]:checked').each(function() {
        rebateids.push($(this).val())
    });

    if (rebateids.length > 0) {
        $.ajax({
            url: "{{ url('admin/rebate_approved/')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'status': status,
                'rebates': rebateids,
            },
            dataType: "json",
            success: function(data) {
                if (data.count == 1) {
                    printsuccessMsg(data.html);
                    // setInterval(function () {
                    //   $('#autorefresh').load();
                    // }, 5000); //5 seconds

                    setInterval(refreshPage(), 7000); 
                } else {
                    printErrorMsg(data.html);
                }
            }

        })

    }else {
        alert('please select the checkbox');
    }


}
function refreshPage() {
    location.reload("#autorefresh");
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

<script type="text/javascript">
$("#checkAllrebate").click(function() {
    $('input:checkbox').not(this).prop('checked', this.checked);
});
</script>

@endsection