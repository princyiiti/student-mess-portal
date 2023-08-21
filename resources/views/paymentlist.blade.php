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
                    <h1 class="m-0 text-dark">Student Fee List</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Student Fee List</li>
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
                    <div class="card-header">Student Fee List</div>
                    <div class="card-body">
                      

                        <br/>
                        <br/>
                          @if (Session::has('flash_message'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('flash_message') }}</p>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Rollno</th>
                                        <th>Academic Year/Term</th>
                                         <th>Total Payable Amount</th>
                                         <th>Amount Paid (if any) </th>
                                         <!-- <th>Total Amount Due</th> -->
                                         <!-- <th>Paid Amount</th> -->
                                         <th>Payment Status</th>
                                         <th>Payment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($studentdata as $item)
                                    <tr>
                                       <td>{{ $loop->iteration }}</td>
                                       <td>{{ $item->rollno }}</td>
                                        <td>{{ $item->academic_year }}/{{ $item->academic_tearm }}</td>
                                         <td>{{ $item->totalamount}}</td>
                                         <td>@if($item->paid_amount=='') 
                                            0
                                            @else
                                            {{$item->paid_amount }}
                                        @endif</td>
                                        <!-- <td>{{ $item->due_amount }}</td> -->
                                         
                                           <td>

                                           @if($item->type==0)
                                           <span class="badge badge-danger" style="font-size:14px;">unpaid</span>
                                           @elseif($item->type==2)
                                          <span class="badge badge-primary" style="font-size:14px;">Partial unpaid Amount</span>
                                           @else
                                               <span class="badge badge-success" style="font-size:14px;">Paid Amount</span>
                                           @endif

                                        </td>
                                         <td>
                                            @if($item->file!='')
                                              <a href="{{url($item->file)}}" class="btn btn-primary" download="{{$item->file}}" title="{{$item->file}}" ><i class="fa fa-print nav-icon"></i>Print Fee Receipt</a>
                                            @endif   
                                           <form action="{{url('feedetails')}}" method="POST" accept-charset="UTF-8">
                                             {{ csrf_field() }}
                                 <?php
                                   $encryptedId = encrypt($item->id);
                                            ?> 
                                             <input type="hidden" name="idkey" value="{{$encryptedId}}"> 
                                           @if($item->type==0)   
                                               
                                           
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-rupee nav-icon"></i> Click here to Pay</button>                                
                                           <!-- <a href="{{ url('/payment').'/'.$encryptedId}}" class="btn btn-primary" type="submit"><i class="fa fa-rupee nav-icon"></i> Click here to Pay</a> -->
                                           @elseif($item->type==1)
                                              <a href="#" class="btn btn-primary" type="submit"><i class="fa fa-rupee nav-icon"></i> Click here to Pay</a>
                                               @else
                                              
                                               @endif
                                           </form>

                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                                <tbody>
                             
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
