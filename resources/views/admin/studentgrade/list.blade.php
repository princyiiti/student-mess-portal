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
                    <h1 class="m-0 text-dark">Feedback_allocation</h1>
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
                    <div class="card-header">Feedback_allocation</div>
                     <table class="table">
              <thead><tr>
                <th>ROllNO</th>
                 <th>NAME </th> 
                 <th>Course Name </th>
               </tr>
              </thead>
              <tbody>

              @foreach($studentdata as $val)
              <tr><td>{{$val->rollno}}</td>
                <td>{{$val->name}}</td>
                  <td> Twentieth Century World History: Critical Perspectives IHS 402</td>
              </tr>
              @endforeach
            </tbody>
            </table>
                   

</div>


            </div>

        </div>
    </div>
@endsection
