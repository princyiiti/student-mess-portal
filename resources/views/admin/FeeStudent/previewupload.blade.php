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
                    <h1 class="m-0 text-dark">Preview Data</h1>
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
                   
                        <div class="">
                    <div class="card-header">Preview Uploaded Data</div>
                    <div class="card-body">
                   

                        <form method="POST" action="{{ url('/savedata') }}" accept-charset="UTF-8">
                                   {{ csrf_field() }}
                            <div class="input-group">
                                <input type="hidden" class="form-control" name="data"  value="{{$data}}">
                              
                                   
                               
                            </div>

                             <div class="input-group">
                               
                              
                                    <button class="btn btn-primary" type="submit">
                                        Import Start
                                    </button>
                               
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                  
                                    <tr>
                                         <th>#</th>
                                         @for($i=0;$i < count($header);$i++)
                                       
                                        <th>{{$header[$i]}}</th>
                                         @endfor
                                    </tr>
                                   
                                </thead>
                                <tbody>
                              
                                       
                                         @foreach($data as $key=>$val)
                                        <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$val->rollno}}</td>
                                        <td>{{$val->student_name}}</td>
                                        <td>{{$val->academic_year}}</td>
                                        <td>{{$val->academic_tearm}}</td>
                                        <td>{{$val->fees_type}}</td>
                                        
                                        <td>{{$val->amount}}</td>
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
