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
                        <h1 class="m-0 text-dark">Assign Fee Details</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Assign Fee Details</li>
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
                    <div class="card-header">Assign Fee Details</div>
                    <div class="card-body">
                        <!-- <form method="GET" action="{{ url('/admin/feesallocations') }}" accept-charset="UTF-8"
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
                        </form> -->
                        <br />
                        <br />
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Admission Year</th>
                                        <th>Program</th>
                                        <th>Academic Tearm</th>
                                        @foreach($FeeType as $list)
                                            
                                            <th>{{$list->title}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($data)
                                    @foreach($data as $index =>  $list)
                                    <tr>
                                        <td>{{$index +1}}</td>
                                        <td>{{$list->ademission_year}}</td>
                                        <td>{{$list->program}}</td>
                                        <td>{{$list->academic_tearm}}</td>
                                       
                                        @foreach($list->Feestructuredata->FeeDetails as $val)
                                    
                                        <td>{{$val->amount}}</td>
                                       
                                        @endforeach
                                        
                                    </tr>

                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="pagination-wrapper">  </div>
                        </div>

                    </div>
                </div>
            </div>
    </section>
</div>

@endsection