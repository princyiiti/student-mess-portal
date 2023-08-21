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
                    <h1 class="m-0 text-dark">Feedback_allocation</h1>
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
                    <div class="card-header">Feedback_allocation</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/feedback_allocation/create') }}" class="btn btn-success btn-sm" title="Add New Feedback_allocation">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/feedback_allocation') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Crsecode</th>
                                        <th>Acadsem</th>
                                        <th>Acadyear</th>
                                         <th> Department</th>
                                        <th>Faculty Username</th>
  <th>Count</th>
  <th>Total Registered Students</th>

                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($feedback_allocation as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->crsecode }}</td>
                                        <td>{{ $item->acadsem }}</td>
                                        <td>{{ $item->acadyear }}</td>
                                        <td>{{ $item->dept }}</td>
                                        <td>{{ $item->facultyname }}</td>
                  <td> <?php echo $url = App\User::countdata($item->crsecode,$item->facultyname);?></td>
                    <td> <?php echo $total = App\User::Totalstudent($item->crsecode,$item->acadyear, $item->acadsem);?></td>
                                        <td>
                                            <a href="{{ url('/admin/feedback_allocation/' . $item->id) }}" title="View Feedback_allocation"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/feedback_allocation/' . $item->id . '/edit') }}" title="Edit Feedback_allocation"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/feedback_allocation' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Feedback_allocation" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $feedback_allocation->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
                </div>
                           </section>
</div>
            </div>
        </div>
    </div>
@endsection
