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
                    <h1 class="m-0 text-dark"> Student Mess Data</h1>
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
                    <div class="card-header">Edit Student mess data #{{ $Student_mess_data->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/student_mess_data') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form id="myform1" method="POST" action="{{ url('/admin/student_mess_data/' . $Student_mess_data->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.Student_mess_data.form', ['formMode' => 'edit'])

                        </form>

                  </div>
                </div>
               </div>
            </section>
         </div>
    </div>

  </div>
</div>
@endsection
