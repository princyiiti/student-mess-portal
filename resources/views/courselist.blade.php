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
                        <h1 class="m-0 text-dark">Student Fee</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Student Fee</li>
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
 @if (Session::has('flash_message'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('flash_message') }}</p>
                        </div>
                        @endif
                <div class="">
                    <div class="card-header">Course List</div>
                    <div class="card-body">
                        <a href="{{ url('addelectivelist') }}" class="btn btn-success btn-sm" title="Add New feestudent">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                       

                        <br />
                        <br />
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Course Code</th>
                                        <th>Program Type</th>
                                        <!-- <th>Fee Type</th> -->
                                        
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($electivelist as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->crsecode }}</td>
                                         <td>{{ $item->programtype }}</td>
                                        
                                          <td>
                                            <a href="{{ url('/deletecouse/' . $item->id ) }}" onclick="return confirm(&quot;Confirm delete?&quot;)" title="Edit feestudent"><button class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></a>

                                          
                                        </td>
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