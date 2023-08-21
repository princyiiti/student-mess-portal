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
                    <h1 class="m-0 text-dark">Fee Structure</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <!-- <li class="breadcrumb-item active">Dashboard v2</li> -->
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
                    <div class="card-header">Fee Structure </div>
                    <div class="card-body">
                        <a href="{{ url('/admin/feestructure/create') }}" class="btn btn-success btn-sm" title="Add New Role">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/feestructure') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" id="feestructuresearch" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>&nbsp;
                                <span class="input-group-append">
                                <a  href ="{{ url('/admin/feestructure') }}" class="btn btn-secondary" id="refresh">
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
                                        <th>Program</th>
                                        <th>Category</th>
                                         <th>Admission Year</th>
                                        <th>Acad Year/Semester</th>
                                          <th>Total Fee</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($feestructure as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->program }}</td>
                                        <td>{{ $item->category }}</td>
                                        <td>{{ $item->ademission_year }}</td>
                                        <td>{{ $item->academic_year }} ({{ $item->academic_tearm }})</td>
                                        <td>{{ $item->totalamount }}</td>
                                        <td>
                                             <a href="{{ url('/admin/feestructure/' . $item->id) }}" title="View Role"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                           <!-- <a href="{{ url('/admin/feestructure/' . $item->id . '/edit') }}" title="Edit Role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> -->
                                            <!-- <form method="POST" action="{{ url('/admin/feestructure' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Role" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form> -->
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $feestructure->appends(['search' => Request::get('search')])->render() !!} </div>
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
            $('#feestructuresearch').val('');
        });
        });
    </script>
@endsection
