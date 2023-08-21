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
                        <h1 class="m-0 text-dark">Academic Fee Structure </h1>
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
                <div class="card-header">Academic Fee Structure {{ $feestructure->id }}</div>
                <div class="card-body">

                    <!--  <a href="{{ url('/admin/role') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/role/' . $feestructure->id . '/edit') }}" title="Edit Role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> -->


                    <br />
                    <br />

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $feestructure->id }}</td>
                                </tr>
                                <tr>
                                    <th> Admission year </th>
                                    <td> {{ $feestructure->ademission_year }} </td>
                                </tr>
                                <tr>
                                    <th> Academic Year/Semeter </th>
                                    <td> {{ $feestructure->academic_year }}({{ $feestructure->academic_tearm }})</td>
                                </tr>

                                <tr>
                                    <th>Program </th>
                                    <td> {{ $feestructure->program }}</td>
                                </tr>
                                <tr>
                                    <th>Category </th>
                                    <td> {{ $feestructure->category }}</td>
                                </tr>
                                <tr>
                                    <th>
                                        <h1>Fee Details </h1>
                                        </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fees Type</th>

                                    <!-- <th class="text-center">Payable Amount </th> -->
                                    <th class="">Net Pay</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($feestructure->FeeDetails as $val)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$val->fee_type}}</td>
                                    <!-- <td>{{$val->amount}}</td> -->
                                    <td>{{$val->amount}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">Total Amount</th>
                                    <th colspan="">{{ $feestructure->totalamount }}</th>
                                    <!-- <th colspan="1">{{ $feestructure->totalamount }}</th> -->


                                </tr>
                            </tfoot>
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