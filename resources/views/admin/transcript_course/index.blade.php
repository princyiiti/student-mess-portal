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
                    <div class="card-header">Student Grade </div>
                    <div class="card-body">
                        <a href="{{ url('/admin/student_grade/create') }}" class="btn btn-success btn-sm" title="Add New Feedback_allocation">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>


                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Id</th>
                                        <th>Crsecode</th>
                                          <th>Crse Name</th>
                                        <th>Acadsem</th>
                                        <th>Acadyear</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($feedback_allocation as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                         <td>{{ $item->studentid }}</td>
                                        <td>{{ $item->crsecode }}</td>
                                          <td>{{ $item->crsename }}</td>
                                        <td>{{ $item->acadsem }}</td>
                                        <td>{{ $item->acadyear }}</td>
                                     

                                   
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        
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
