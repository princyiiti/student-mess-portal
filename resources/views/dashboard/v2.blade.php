@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
        
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
      @if(auth()->user()->role_id==3)
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1">
                <i class="fa fa-rupee nav-icon"></i>
                <!-- <i class="fa fa-book nav-icon"></i> -->
              </span>

              <div class="info-box-content">
                <!-- <span class="info-box-text">View Course Regitration Details</span> -->
                <span class="info-box-text">View Fee Details</span> 
                <!-- <span class="info-box-number">760</span> -->
              <a href="{{ url('/feepay') }}">Click here to pay</a>
              <!-- <a href="{{ url('/courseregistration') }}">Course Regitration 2023 Autumn</a> -->
              
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

           <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1">
                <!-- <i class="fa fa-rupee nav-icon"></i> -->
                <i class="fa fa-book nav-icon"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">View Course Regitration Details</span>
                <!-- <span class="info-box-text">View Fee Details</span>  -->
                <!-- <span class="info-box-number">760</span> -->
              <!-- <a href="{{ url('/feepay') }}">Click here to pay</a> -->
              <a href="{{ url('/courseregistration') }}">Course Regitration 2023 Autumn</a>
              
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          @endif
          <!-- /.col -->
       
          <!-- /.col -->
        </div>
        <!-- /.row -->


       
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('javascript')
<!-- jQuery -->
<!-- <script src="/dist/plugins/jquery/jquery.min.js"></script> -->
<!-- jQuery UI 1.11.4 -->
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> -->
<!-- Bootstrap 4 -->
@stop
