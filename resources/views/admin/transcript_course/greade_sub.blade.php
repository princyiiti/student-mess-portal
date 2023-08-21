
@extends('layouts.app')

@section('content')
   <div class="content-wrapper" style="min-height: 543px;">
        <!-- Content Header (Page header) -->
       
       
               <section class="content">
              <div class="container-fluid">
<div class="card card-primary">
                <div class="card">
                    <div class="card-header">Add Student Grade </div>
                    <div class="card-body">


<div class="form-group {{ $errors->has('acadyear') ? 'has-error' : ''}}">
    <label for="acadyear" class="control-label">{{ 'Acadyear' }}</label>
    <input class="form-control" name="acadyear" type="number" id="acadyear" value="{{ $acadyear}}" >
    {!! $errors->first('acadyear', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('acadyear') ? 'has-error' : ''}}">
    <label for="acadyear" class="control-label">{{ 'Acad sem' }}</label>
    <input class="form-control" name="acadsem" type="number" id="acadsem" value="{{$acadsem}}" >
    {!! $errors->first('acadyear', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('acadyear') ? 'has-error' : ''}}">
    <label for="acadyear" class="control-label">{{ 'Course code' }}</label>
    <input class="form-control" name="crsecode" type="text" id="crsecode" value="{{$crsecode}}" >
    {!! $errors->first('acadyear', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('acadyear') ? 'has-error' : ''}}">
    <label for="acadyear" class="control-label">{{ 'Course Credit ' }}</label>
    <input class="form-control" name="totcred" type="text" id="totcred" value="{{$modulecourselist->totcred}}" >
    {!! $errors->first('acadyear', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('acadyear') ? 'has-error' : ''}}">
    <label for="acadyear" class="control-label">{{ 'Course Name ' }}</label>
    <input class="form-control" name="crsename" type="text" id="crsename" value="{{$modulecourselist->crsename}}" >
    {!! $errors->first('acadyear', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('acadyear') ? 'has-error' : ''}}">
    <label for="acadyear" class="control-label">{{ 'Course Type ' }}</label>
    <input class="form-control" name="type" type="text" id="type" value="{{$modulecourselist->type}}" >
    {!! $errors->first('acadyear', '<p class="help-block">:message</p>') !!}
</div>
<h2>Totoal Student: {{$modulegrades_sublist->count()}}</h2>>
<table class="table table-bordered">
    <thead>
        <tr>
        <td>Student Roll No.</td>
        <td>Student ID</td>
        <td>Grade</td>
    </tr>
    </thead>
    <tbody>
        @foreach($modulegrades_sublist as $val)
        <tr>
        <td>{{$val->rollno}}</td>
         <td> {{$val->studentid}}</td>
   <td>
<!-- <div class="form-group {{ $errors->has('facultyname') ? 'has-error' : ''}}"> -->
    <!-- <label for="facultyname" class="control-label">{{ 'Grade ' }}</label> -->
    <input class="form-control" name="facultyname" type="text" id="grade" value="{{$val->grade}}" >    
    
    {!! $errors->first('facultyname', '<p class="help-block">:message</p>') !!}
<!-- </div> -->
</td>
</tr>
@endforeach
</tbody>
</table>
                 </div>
                </div>
              </div>
            </section>
</div>
            </div>
        </div>
    </div>
@endsection


