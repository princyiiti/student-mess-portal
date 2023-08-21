@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 543px;">
        <!-- Content Header (Page header) -->
       
            <!-- Content Header (Page header) -->
            <div class="card card-primary">
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-md-6">
                    <h1 class="m-0 text-dark">New Student Details </h1>
                  </div><!-- /.col -->
                  <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">New Student Details</li>
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
   
        <form method="POST" action="{{ url('/savestudentdata') }}" accept-charset="UTF-8"  enctype="multipart/form-data">
                            {{ csrf_field() }}
 <div class="row">
<div class="col-md-12">
     <div class="col-md-6">
<div class="form-group {{ $errors->has('rollno') ? 'has-error' : ''}}">
    <label for="rollno" class="control-label">{{ 'Rollno' }}</label>
    <input class="form-control" name="rollno" type="text" required id="title"  >
    {!! $errors->first('rollno', '<p class="help-block">:message</p>') !!}
</div>
</div>
 <div class="col-md-6">
<div class="form-group {{ $errors->has('rollno') ? 'has-error' : ''}}">
    <label for="rollno" class="control-label">{{ 'Full Name' }}</label>
    <input class="form-control" name="name" type="text" required id="name"  >
    {!! $errors->first('rollno', '<p class="help-block">:message</p>') !!}
</div>
</div>
 <div class="col-md-6">
<div class="form-group {{ $errors->has('prog') ? 'has-error' : ''}}">
    <label for="prog" class="control-label">{{ 'Program' }}</label>
    <input class="form-control" name="prog" type="text" required id="title" value="M.Tech."  >
    {!! $errors->first('prog', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-md-6">
<div class="form-group {{ $errors->has('father_name') ? 'has-error' : ''}}">
    <label for="father_name" class="control-label">{{ 'father_name' }}</label>
    <input class="form-control" name="father_name" type="text" required id="title"  >
    {!! $errors->first('father_name', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-md-6">
<div class="form-group {{ $errors->has('ademission_year') ? 'has-error' : ''}}">
    <label for="ademission_year" class="control-label">{{ 'Department ' }}</label>
     <select class="form-control select2" name="dept" type="text" id="caste"  data-validation="required" >
        <option value="">-----Select Course----</option>
       @foreach($departmentlist as $val)
        <option value="{{$val->deptname}}">{{$val->deptname}}</option>
        @endforeach
        <</select>
    {!! $errors->first('caste', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="col-md-6">
<div class="form-group {{ $errors->has('ademission_year') ? 'has-error' : ''}}">
    <label for="ademission_year" class="control-label">{{ 'Sepcilization ' }}</label>
     <select class="form-control select2" name="spec" type="text" id="spec"  data-validation="required" >
        <option value="">-----Select Sepcilization----</option>
       @foreach($departmentlist as $val)
        <option value="{{$val->deptname}}">{{$val->deptname}}</option>
        @endforeach
        <</select>
    {!! $errors->first('caste', '<p class="help-block">:message</p>') !!}
  </div>
</div>

<div class="col-md-6">
<div class="form-group {{ $errors->has('ademission_year') ? 'has-error' : ''}}">
    <label for="ademission_year" class="control-label">{{ 'Cast Category ' }}</label>
     <select class="form-control select2" name="caste" type="text" id="caste"  data-validation="required" >
        <option value="">-----Select Course----</option>
       @foreach($castlist as $val)
        <option value="{{$val->caste}}">{{$val->caste}}</option>
        @endforeach
        <</select>
    {!! $errors->first('caste', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="col-md-6">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'personal Email' }}</label>
    <input class="form-control" name="p_email" type="email" required id="email"  >
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-md-6">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Institute Email ID ' }}</label>
    <input class="form-control" name="email" type="text" required id="role"  >
    {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-md-6">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Contact ' }}</label>
    <input class="form-control" name="contact" type="text" required id="role"  >
    {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-md-6">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'gender ' }}</label>
    <input class="form-control" name="gender" type="text" required id="role"  >
      <input class="form-control" name="batch_year" type="hidden" value="2023" required id="role"  >
    {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="col-md-6">
<div class="form-group ">
    <input class="btn btn-primary " type="submit" value="Create">
</div>
</div>
</div>
 
                        </form>
   

            </div>
        </div>
    </div></section></div>
    @endsection