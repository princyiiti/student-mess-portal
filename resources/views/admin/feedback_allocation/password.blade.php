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
                    <h1 class="m-0 text-dark"> Feedback_allocation</h1>
                  </div><!-- /.col -->                  
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            </div>
               <section class="content">
              <div class="container-fluid">
<div class="card card-primary">
                <div class="card">
                    <div class="card-header">Add Feedback_allocation</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/feedback_allocation') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
    @if (Session::has('flash_message'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('flash_message') }}</p>
                    </div>
                @endif

                        <form method="POST" action="{{ url('/admin/passwordsave') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                          <div class="form-group {{ $errors->has('rollno') ? 'has-error' : ''}}">
    <label for="rollno" class="control-label">{{ 'Rollno' }}</label>
    <input class="form-control" name="rollno" type="text" id="rollno" >
    {!! $errors->first('rollno', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('pass') ? 'has-error' : ''}}">
    <label for="pass" class="control-label">{{ 'Mobile No.' }}</label>
    <input class="form-control" name="pass" type="text" id="pass"  >
    {!! $errors->first('pass', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="Save">
</div>


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
