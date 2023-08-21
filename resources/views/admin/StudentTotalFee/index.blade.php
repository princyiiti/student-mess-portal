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
                    <h1 class="m-0 text-dark">Student Fee Allocations Fee Per Semester</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Dashboard v2</li>
                    </ol>
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
                   
                        <div class="">
                    <div class="card-header">Student Fee Allocations Fee Per Semester</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/studenttotalfee/create') }}" class="btn btn-success btn-sm" title="Add New Role">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/studenttotalfee') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                                &nbsp;
                                <span class="input-group-append">
                                <a  href ="{{ url('/admin/studenttotalfee') }}" class="btn btn-secondary" id="refresh">
                                <i class="fa fa-refresh" aria-hidden="true"></i></a>
                                
                                <span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Rollno</th>
                                        <th>Student Name</th>
                                        <th>Academic Year/Semeter</th>
                                          <th>Total Amount</th>
                                           <!-- <th>Due amount</th> -->
                                          <th>Status</th>

                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($StudentTotalFee as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->rollno }}</td>
                                         <td>{{ $item->student_name }}</td>
                                        <td>{{ $item->academic_year }}/{{ $item->academic_tearm }}</td>
                                        <td>{{ $item->totalamount }}</td>
                                        <!-- <td>{{ $item->due_amount }}</td> -->
                                           <td>

                                           @if($item->status==0)
                                           <span class="badge badge-danger">unpaid</span>
                                           @elseif($item->status==2)
                                   <span class="badge badge-success"> Paid Amount</span>
                                           @else
                                            
                                               <span class="badge badge-warning">Partial Payment Amount</span>
                                               @endif

                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/studenttotalfee/' . $item->id) }}" title="View Role"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <!-- <a href="{{ url('/admin/studenttotalfee/' . $item->id . '/edit') }}" title="Edit Role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/role' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Role" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form> -->
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $StudentTotalFee->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
                </div>
                           </section>
</div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#refresh').click(function() {
            location.reload();
            $('#search').val('');
        });
        });
    </script>
@endsection
