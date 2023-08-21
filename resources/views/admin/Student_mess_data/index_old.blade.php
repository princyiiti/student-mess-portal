@extends('layouts.app')

@section('content')
<style>
.labcss {
    justify-content: flex-start;
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
                        <h1 class="m-0 text-dark">Mess Subscription Details </h1>
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


                <div class="card-header">Mess Subscription List </div>
                <div class="card-body">
                    <!-- <a href="{{ url('/admin/student_mess_data/create') }}" class="btn btn-success btn-sm" title="Add New Category">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a> -->
                    <a href="{{ url('/admin/user/importcsv') }}" class="btn btn-success btn-sm"
                        title="Add New Category">
                        <i class='fa fa-upload'></i> Import Data
                    </a>
                    @if (Session::has('flash_message'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('flash_message') }}</p>
                    </div>
                    @endif
                    <div class="clear-fix"></div>
                    <br>
                    <div class="panel panel-success">
                        <!-- <div class="panel-heading">Search Student</div> -->
                        <div class="panel-body">
                            <form method="GET" action="{{ url('/admin/student_mess_data') }}" accept-charset="UTF-8"
                                class="form-inline">

                                <div class="col-sm-2">

                                    <div class="form-group">
                                        <label for="title" class="control-label">{{ 'Student Name ' }}</label>
                                        <input class="form-control" data-validation="required" name="student_name"
                                            type="text" id="room_no" value="{{ request('student_name') }}">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="title" class="control-label">{{ 'Mess Name' }}</label>
                                        <input class="form-control" data-validation="required" name="mess_name"
                                            type="text" id="room_no" value="{{ request('mess_name') }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="title" class="control-label">{{ 'From date' }}</label>
                                    <div class="form-group">

                                        <!-- <input class="form-control dateclass" data-validation="required" name="form_date" type="text" id="form_date" value="{{ request('form_date') }}" readonly="" > -->
                                        <input type="date" class="form-control" data-validation="required"
                                            value="{{ request('form_date') }}" name="form_date" id="form_date">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="title" class="control-label">{{ 'To Date' }}</label>
                                    <div class="form-group">

                                        <input type="date" class="form-control " data-validation="required"
                                            name="to_date" value="{{ request('to_date') }}" id="to_date">
                                        <!-- <input class="form-control dateclass" data-validation="required" name="to_date" type="text" id="to_date" value="{{ request('to_date') }}" readonly="" > -->
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="input-group">
                                    <!-- <label for="inputName">Search</label> -->
                                        <button class="btn btn-primary" type="submit">
                                            Search
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                  <!-- <label for="inputName">Refresh</label> -->
                                  <!-- <button type="button" name="refresh" id="refresh"  class="btn btn-primary form-control">Refresh</button> -->
                                  <a href="{{ url('/admin/student_mess_data') }}" class="btn btn-primary form-control" >
                                  Refresh
                                </a>
                    
                            </div>
                            </form>
                        </div>

                        <!--   <form method="GET" action="{{ url('/admin/student_mess_data') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>  -->

                        <br />
                        <br />
                        <div class="table-responsive">
                            <table class="table" id="datatable">
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
                                        @if(auth()->user()->role_id !=5)
                                        <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($Student_mess_data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->student_name }}</td>
                                        <td>{{ $item->program }}</td>
                                        <td>{{ $item->hostel_name }}</td>
                                        <td>{{ $item->mess_name }}</td>
                                        <td>{{ $item->plan_type }}</td>

                                        <td>{{ date('d-M-Y', strtotime( $item->from_date)) }}</td>
                                        <td>{{ date('d-M-Y', strtotime( $item->to_date)) }}</td>
                                        <td>
                                            <?php $rebateday=App\Rebate::countday($item); ?>
                                            {{$rebateday}}</td>
                                        <td><?php 
                                            $date1 = new DateTime($item->to_date);
                                            $date2 = new DateTime($item->from_date);
                                            $days  = $date2->diff($date1)->format('%a');
                                            echo ($days+1)-$rebateday;
                                          ?>
                                        </td>
                                        @if(auth()->user()->role_id !=5)
                                        <td>
                                            <!-- <a href="{{ url('/admin/student_mess_data/' . $item->id) }}" title="View Category"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a> -->
                                            <!-- <a href="{{ url('/admin/student_mess_data/' . $item->id . '/edit') }}" title="Edit Category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> -->

                                            <form method="POST"
                                                action="{{ url('/admin/student_mess_data' . '/' . $item->id) }}"
                                                accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    title="Delete Category"
                                                    onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                        class="fa fa-trash" aria-hidden="true"></i>&nbsp;Delete</button>
                                            </form>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                          
                            
                        </div>

                    </div>

                </div>
    </section>
</div>
</div>
</div>
</div>
@endsection