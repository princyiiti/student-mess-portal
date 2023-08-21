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
                        @if(auth()->user()->role_id===3)<h1 class="m-0 text-dark">Student Current Subcription </h1>@else
                        <h1 class="m-0 text-dark">Student Current Subcription </h1> @endif
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

                    <form method="GET" action="{{ url('/admin/subcription') }}" accept-charset="UTF-8" class="form-inline
                    my-2 my-lg-0 float-right" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..."
                                value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            &nbsp;
                            <span class="input-group-append">
                                <a href="{{ url('/admin/subcription') }}" class="btn btn-secondary" id="refresh">
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

                                    @if(auth()->user()->role_id!=3)
                                    <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($StudnetCurrentSubcription as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$item->student_name  }} ({{$item->student_email}})</td>
                                    <td>{{ date('d-M-Y', strtotime( $item->start_date)) }}</td>
                                    <td>{{ date('d-M-Y', strtotime( $item->end_date)) }}</td>


                                    <td>

                                        @if(auth()->user()->role_id !=3)
                                        <!-- <a href="{{ url('/admin/slot/' . $item->id . '/edit') }}" title="Edit Category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> -->

                                        <form method="POST" action="{{ url('/admin/subcription' . '/' . $item->id) }}"
                                            accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete "
                                                onclick="return confirm(&quot;Confirm delete?&quot;)">Delete</button>
                                        </form>
                                        @endif

                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {{ $StudnetCurrentSubcription->links() }} </div>
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

@endsection