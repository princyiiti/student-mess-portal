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
        <form method="POST" action="{{ url('/saveelectivelist') }}" accept-charset="UTF-8"  enctype="multipart/form-data">
                            {{ csrf_field() }}
<div class="col-md-12">
     <div class="col-md-6">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'year' }}</label>
    <input class="form-control" name="year" type="text" value="4" required id="title"  >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-sm-3">
<div class="form-group {{ $errors->has('ademission_year') ? 'has-error' : ''}}">
    <label for="ademission_year" class="control-label">{{ 'crsecode ' }}</label>
     <select class="form-control select2" name="crsecode" type="text" id="crsecode"  data-validation="required" >
        <option value="">-----Select Course----</option>
       @foreach($courselist as $val)
        <option value="{{$val->crsecode}}">{{$val->crsecode}}</option>
        @endforeach
        <</select>
    {!! $errors->first('ademission_year', '<p class="help-block">:message</p>') !!}
  </div>
</div>
<div class="col-md-6">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <!-- <label for="title" class="control-label">{{ 'acadyear' }}</labe
        l> -->
    <input class="form-control" name="acadyear" type="hidden"  value="2021" required id="title"  >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div></div><div class="col-md-6">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <!-- <label for="title" class="control-label">{{ 'acadsem' }}</label> -->
    <input class="form-control" name="acadsem" type="hidden" value="1" required id="title"  >
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>
</div><div class="col-md-6">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'programtype ' }}</label>
    <input class="form-control" name="programtype" type="text" value="AL" required id="programtype"  >
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