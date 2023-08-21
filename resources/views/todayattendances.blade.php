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
                    <h1 class="m-0 text-dark">Today Attendance Mess Name: {{auth()->user()->name}} Date {{date('d/M/Y')}}</h1>
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
                   
                      
                    <div class="card-header">Today Attendance Mess Name: {{auth()->user()->name}}
                    </div>
                    <div class="card-body">
                       

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <!-- <th>Title</th> -->
                                        <th>Type</th>
                                        <th>User Name</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($attendances as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->attandace_type }}</td>
                                        <!-- <td>{{ $item->title }}</td> -->
                                        <td>{{ $item->userdata->name }}</td>
                                         <td>{{ date('d-M-Y H:i:s', strtotime($item->created_at)) }}</td>
                                      
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
