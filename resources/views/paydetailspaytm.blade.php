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
                      <li class="breadcrumb-item active">Dashboard v2</li>
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
<div class="container">
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <strong>Indian Institute of Technology Indore</strong>
                        <br>
                        Khandwa Road, Simrol, 
                        <br>
                       Indore 453552, INDIA
                        <br>
                       
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date: {{date('D d-M-Y')}}</em>
                    </p>
                    <p>
                         <em>Student Name: {{$studentprofile->name}}</em>
                        <em>Student Rollno: {{$studentprofile->rollno}}</em>
                         <em>Program: {{$studentprofile->program}}</em>
                        <em>Academic Semester({{$studentdata->academic_year}}/{{$studentdata->academic_tearm}})</em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>Receipt </h1>
                </div>
                </span>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Fees Type</th>
                            <th></th>
                            <th class="text-center">Due Amount</th>
                            <th class="text-center">Payable Amount </th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $dueamount=0;
                        ?>
                        @foreach($dataAll as $val)

                        <tr>
                            <td class="col-md-9"><em>{{$val->fee_type}}</em></h4></td>
                            <td class="col-md-1" style="text-align: center">  </td>
                            @if($val->type==1)
                            <td class="col-md-1 text-center">&#8377;{{$val->amount}}</td>
                            <?php $dueamount=$val->amount+$dueamount?>
                             <td class="col-md-1 text-center"></td>
                            @else
                            <td class="col-md-1 text-center"></td>
                            <td class="col-md-1 text-center">&#8377;{{$val->amount}}</td>
                            @endif
                                @if($val->type!=1)
                            <td class="col-md-1 text-center">&#8377;{{$val->amount}}</td>
                            @else
                            <td class="col-md-1 text-center"></td>
                            @endif
                        </tr>
                     @endforeach
                     @if($dueamount>0)
                        <tr>
                           
                          
                            <td class="text-right">
                                
                                  <p>
                                <strong>Total Due Amount : </strong>
                            </p>
                                 
                            
                            </td>
                             <td>   </td>
                            <td class="text-center">
                            <p>
                                <strong><i class="fa fa-rupee nav-icon"></i>
                                   
                                    {{$dueamount}}
                                    
                                </strong>
                            </p>
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Payable Amount: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong><i class="fa fa-rupee nav-icon"></i>
                                {{$studentdata->totalamount}}
                            </strong></h4></td>
                        </tr>
                    </tbody>
                </table>
              
                   <?php
                   $encryptedId = encrypt($studentdata->id);
                          ?> 
                          @if($studentdata->status==1)
                          <a href="{{ url('/paymentpaytm').'/'.$encryptedId}}" class="btn btn-success btn-lg btn-block" type="submit"><i class="fa fa-rupee nav-icon"></i>Pay Via PayTM</a>                   
                                          
                         @else
                              <a href="{{ url('/paymentpartialpaytm').'/'.$encryptedId}}" class="btn btn-success btn-lg btn-block" type="submit"><i class="fa fa-rupee nav-icon"></i> Pay Via PayTM</a>             
                         @endif
                                            
             
            </div>
        </div>
    </div></div>
   

            </div>
        </div>
    </div></section></div>
    @endsection