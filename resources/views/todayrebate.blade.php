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
                    <h1 class="m-0 text-dark">Rebate List </h1>
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
                   
                      
                    <div class="card-header">Today Students Rebate List </div>
                     {{date('d/m/y')}} Today Total Number of student Rebate:{{count($listrebate)}}
                    <div class="card-body">
                    

                       

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                         <th>Student Name</th>
                                        <th>To Date</th>                                    
                                        <th>From Date</th>
                                        <th>Status</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($listrebate as $item)
                                    <tr>
                               <td>{{ $loop->iteration }}</td>
                                       <td>{{  $item->userdata->name  }} ({{$item->userdata->email}})</td>
                                          <td>{{ date('d-M-Y', strtotime( $item->to_date)) }}</td>
                                          <td>{{ date('d-M-Y', strtotime( $item->from_date)) }}</td>
                                          <td>

              @if($item->status==1)              
              <span style="color: green;"> Approved</span>
             @else
              <span style="color: red;">Pending</span>
                                            @endif
</td>
                                      
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
