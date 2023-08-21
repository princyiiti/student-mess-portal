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
                    <h1 class="m-0 text-dark">Activation No-Dues</h1>
                  </div><!-- /.col -->                  
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            </div>
               <section class="content">
              <div class="container-fluid">
<div class="card card-primary">
                <div class="card">
                    <div class="card-header">Activation No-Dues</div>
                    <div class="card-body">
                        <a href="{{ url('admin/savenoduesactivation') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                          @if (Session::has('flash_message'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('flash_message') }}</p>
                    </div>
                @endif

                        <form method="POST" action="{{ url('/admin/savenoduesactivation') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                     <div class="form-group {{ $errors->has('rollno') ? 'has-error' : ''}}">
    <label for="rollno" class="control-label">{{ 'Roll No' }}</label>
    <input class="form-control" name="rollno" type="number" id="rollno" value="{{ isset($feedback_allocation->rollno) ? $feedback_allocation->rollno : ''}}" >
    {!! $errors->first('acadsem', '<p class="help-block">:message</p>') !!}
                    </div>
      
      <div class="form-group {{ $errors->has('acadsem') ? 'has-error' : ''}}">
    <label for="acadsem" class="control-label">{{ 'Acadsem' }}</label>
    <input class="form-control" name="acadsem" type="number" id="acadsem" value="{{ isset($feedback_allocation->acadsem) ? $feedback_allocation->acadsem : '2'}}" >
    {!! $errors->first('acadsem', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('acadyear') ? 'has-error' : ''}}">
    <label for="acadyear" class="control-label">{{ 'Acadyear' }}</label>
    <input class="form-control" name="acadyear" type="number" id="acadyear" value="{{ isset($feedback_allocation->acadyear) ? $feedback_allocation->acadyear : '2020'}}" >
    {!! $errors->first('acadyear', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="Save (Activation)">
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
