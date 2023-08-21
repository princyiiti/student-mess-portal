
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

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/feedback_allocation') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

<div class="form-group {{ $errors->has('crsecode') ? 'has-error' : ''}}">
    <label for="crsecode" class="control-label">{{ 'Crsecode' }}</label>

    <select class="form-control select2" name="crsecode" type="text" id="crsecode" value="{{ isset($feedback_allocation->crsecode) ? $feedback_allocation->crsecode : ''}}" >
        @foreach($moduleadmin as $val)
        <option value="{{$val->crsecode}}">{{$val->crsecode}}</option>
        @endforeach
    </select>
    {!! $errors->first('crsecode', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('acadsem') ? 'has-error' : ''}}">
    <label for="acadsem" class="control-label">{{ 'Acadsem' }}</label>
    <input class="form-control" name="acadsem" type="number" id="acadsem" value="{{ isset($feedback_allocation->acadsem) ? $feedback_allocation->acadsem : '1'}}" >
    {!! $errors->first('acadsem', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('acadyear') ? 'has-error' : ''}}">
    <label for="acadyear" class="control-label">{{ 'Acadyear' }}</label>
    <input class="form-control" name="acadyear" type="number" id="acadyear" value="{{ isset($feedback_allocation->acadyear) ? $feedback_allocation->acadyear : '2020'}}" >
    {!! $errors->first('acadyear', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('facultyname') ? 'has-error' : ''}}">
    <label for="facultyname" class="control-label">{{ 'Faculty Name ' }}</label>
    <select class="form-control select2" name="facultyname" type="text" id="facultyname" value="{{ isset($feedback_allocation->facultyname) ? $feedback_allocation->facultyname : ''}}" >
       @foreach($faculty_profile as $val)
        <option value="{{$val->username}}" >{{$val->name}}({{$val->username}})</option>
        @endforeach
    </select>
    {!! $errors->first('facultyname', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('dept') ? 'has-error' : ''}}">
    <label for="dept" class="control-label">{{ 'Dept' }}</label>
    <select class="form-control" name="dept" type="text" id="dept" value="{{ isset($feedback_allocation->dept) ? $feedback_allocation->dept : ''}}" >
        @foreach($department as $val)
      <option value="{{$val->deptabbr}}">{{$val->deptabbr}}</option>
        @endforeach
        </select>
    {!! $errors->first('dept', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('lock') ? 'has-error' : ''}}">
 
    <input class="form-control" name="lock" type="hidden" id="lock" value="{{ isset($feedback_allocation->lock) ? $feedback_allocation->lock : '0'}}" >
    {!! $errors->first('lock', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
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