<?php


 ?>

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

                <div class="">
                    <div class="card-header">Student Fee</div>
                    <div class="card-body">
                        <!-- <a href="{{ url('/admin/feestudent/create') }}" class="btn btn-success btn-sm" title="Add New feestudent">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a> -->
                        <a href="{{ url('/importcsvdata') }}" class="btn btn-success btn-sm" title="Add New feestudent">
                            <i class="fa fa-upload"></i> Import Data
                        </a>
                        <form method="GET" action="{{ url('/admin/feestudent') }}" accept-charset="UTF-8"
                            class="form-inline my-2 my-lg-0 float-right" feestudent="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..."
                                    value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br />
                        <br />
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Rollno</th>
                                        <th>Student Name</th>
                                        <th>Fee Type</th>
                                        <th>Amount</th>
                                        <th>Academic Year/Tearm</th>
                                        <th>Activation</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($FeeStudent as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->rollno }}</td>
                                        <td>{{ $item->student_name }}</td>
                                        <td>{{ $item->fee_type }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>{{ $item->academic_year }}/{{ $item->academic_tearm }}</td>
                                        <td>@if($item->type==0)
                                            <span class="badge badge-success">Active</span>
                                            @else
                                            <span class="badge badge-danger">In-Active</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->type==0)
                                            <a href="{{ url('/admin/feestudent/active/' . $item->id.'/1') }}"
                                                title="View feestudent"><button class="btn btn-success btn-sm"><i
                                                        class="fa fa-toggle-on"
                                                        aria-hidden="true"></i>In-Active</button></a>
                                            @else
                                            <a href="{{ url('/admin/feestudent/active/' . $item->id.'/0') }}"
                                                title="View feestudent"><button class="btn btn-warning btn-sm"><i
                                                        class="fa fa-toggle-off"
                                                        aria-hidden="true"></i>Active</button></a>
                                            @endif
                                            <!-- <a href="{{ url('/admin/feestudent/' . $item->id) }}" title="View feestudent"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a> -->
                                            <!-- <a href="{{ url('/admin/feestudent/' . $item->id . '/edit') }}" title="Edit feestudent"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/feestudent' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete feestudent" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form> -->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $FeeStudent->appends(['search' =>
                                Request::get('search')])->render() !!} </div>
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