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
                    <h1 class="m-0 text-dark"> Role</h1>
                  </div><!-- /.col -->                  
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            </div>
               <section class="content">
              <div class="container-fluid">
<div class="card card-primary">
                <div class="card">
                    <div class="card-header">Grade cal </div>
                    <div class="card-body">
                        <a href="{{ url('/admin/gradecalculate') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/gradecalculate') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'program' }}</label>
    <select class="form-control" name="program"  id="title" value="{{ isset($role->program) ? $role->program : ''}}" >       
        
                                 
                            <option>B.Tech.</option>
                            <option>M.Tech.</option>
                            <option>M.Sc.</option>
                            <option>MS (Research)</option>                   
                            <option>Ph.D.</option>
                            <option>Prep.</option>
                           <option>BTMT</option>
                           <option>MTPh.D.</option>
                           <option>MSPh.D.</option>
                           <option>MSRPh.D.</option>
                           <option>BTMTPh.D.</option>
                               <option>SEPUG</option>
                                       
        </select>
    {!! $errors->first('program', '<p class="help-block">:message</p>') !!}
</div>
  <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'batchyear' }}</label>

    <select  class="form-control" name="batchyear">
                               <option>All</option>          
                            <option>2009</option>
                            <option>2010</option>
                            <option>2011</option>
                            <option>2012</option>
                            <option>2013</option>
                           <option>2014</option>
                           <option>2015</option>
                           <option>2016</option>
                            <option>2017</option> 
                            <option>2018</option> 
                            <option>2019</option> 
                            <option>2020</option>         
                             <option>2021</option> 
                              <option>2022</option>                 
                                           </select>
  
    {!! $errors->first('program', '<p class="help-block">:message</p>') !!}
</div>
 <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Acadsem' }}</label>

    <select  class="form-control" name="acadsem">
                               <option>1</option>          
                               <option>2</option>    
                                <option>3</option>  
                                         
                                           </select>
 
    {!! $errors->first('program', '<p class="help-block">:message</p>') !!}
</div>
 <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Acadsem' }}</label>

    <select  class="form-control" name="acadyear">
                           <option>2009</option>
                            <option>2010</option>
                            <option>2011</option>
                            <option>2012</option>
                            <option>2013</option>
                           <option>2014</option>
                           <option>2015</option>
                           <option>2016</option>
                            <option>2017</option> 
                            <option>2018</option> 
                            <option>2019</option> 
                            <option>2020</option>         
                         <option>2021</option>   
                         <option>2022</option> 
                                         
                                           </select>
 
    {!! $errors->first('program', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ 'Create' }}">
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
