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
                    <h1 class="m-0 text-dark">Student Fee</h1>
                  </div><!-- /.col -->
                  <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Fee Details</li>
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
    <div class="">
        <form method="POST" action="{{ url('/newusercreate') }}" accept-charset="UTF-8"  enctype="multipart/form-data">
                            {{ csrf_field() }}
<div class="col-md-12">
     <div class="col-md-6">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="email" required id="title"  >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-md-6">

<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'username' }}</label>
    <input class="form-control" name="usename" type="username" required id="title"  >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div></div><div class="col-md-6">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'password' }}</label>
    <input class="form-control" name="password" type="password" required id="title"  >
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>
</div><div class="col-md-6">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Role Document verification code 19 ' }}</label>
    <input class="form-control" name="role" type="text" required id="role"  >
    {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
</div>
</div><div class="col-md-6">
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