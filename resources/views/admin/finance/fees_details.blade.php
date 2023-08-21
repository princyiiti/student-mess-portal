@extends('layouts.app')

@section('content')

<div class="content-wrapper" style="min-height: 543px;">
    <div class="card card-primary">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Student Fees Details</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <section class="content">
        <div class="row">
             <!-- About Me Box -->
             <div class="col-md-6">
             <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Fees Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- <strong><i class="fas fa-book mr-1"></i> Total Fees</strong>

                <p class="text-muted">
                 30000
                </p>

                <hr>

                <strong><i class=""></i> Amount Paid</strong>

                <p class="text-muted">25000</p>



                <hr>

                <strong> Due Amount</strong>

                <p class="text-muted">25466</p> -->
                <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Admission Year</b> <a class="float-right">2023</a>
                            </li>
                            <li class="list-group-item">
                                <b>Academic Year</b> <a class="float-right">2023</a>
                            </li>
                            <li class="list-group-item">
                                <b>Academic Tram</b> <a class="float-right">Spring</a>
                            </li>
                        </ul>
              </div>
              <!-- /.card-body -->
            </div>
             </div>
             
            <div class="col-md-6">

<!-- Profile Image -->
<div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg"
                alt="User profile picture">
        </div>

        <h3 class="profile-username text-center">Student Name</h3>

        <p class="text-muted text-center">STudent Program </p>

        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>Admission Year</b> <a class="float-right">2023</a>
            </li>
            <li class="list-group-item">
                <b>Academic Year</b> <a class="float-right">2023</a>
            </li>
            <li class="list-group-item">
                <b>Academic Tram</b> <a class="float-right">Spring</a>
            </li>
        </ul>

        <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
    </div>
    <!-- /.card-body -->
</div>
</div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Fees Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Fees Type</th>
                                    <th>Amount</th>
                                    <th style="width: 40px">Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Admission Fees</td>
                                    <td><span>2500</span>
                                    </td>
                                    <td><span class="badge bg-danger">Paid</span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Mess Fees</td>
                                    <td>
                                    <span>2500</span>
                                    </td>
                                    <td><span class="badge bg-warning">pending</span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Lab Fees</td>
                                    <td>
                                    <span>2500</span>
                                    </td>
                                    <td><span class="badge bg-primary">Pay</span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>Registration Fee</td>
                                    <td>
                                    <span>2500</span>
                                    </td>
                                    <td><span class="badge bg-success">Paid</span></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                  
                </div>
                <!-- /.card -->
</div>
    </section>
</div>
@endsection