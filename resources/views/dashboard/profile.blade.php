     @extends('layouts.app') 
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark" style="text-align: center;">Material Management Section (MMS) Update Profile</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Profile</a></li>
            <li class="breadcrumb-item active">Complete Profile </li>
          </ol>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>

      <form method="POST" action="{{ url('/home/updateprofile') }}" accept-charset="UTF-8" class="form-horizontal" id="myform1" enctype="multipart/form-data">
                                    {{ csrf_field() }}                  
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('department') ? 'has-error' : ''}}">
                                                <label for="department" class="control-label">{{ 'Department/Division' }}</label>
                                <select class="form-control role form-control-sm" name="department_id" id="department_id" >
                                                    <option value="">---Select Department---</option>
                                                    @foreach($department as $val)
                                                    <option value="{{ $val->id }}" {{ isset($purchase_indent->department)?(($purchase_indent->department_id===$val->id)?'selected':''):'' }} > {{ $val->name }}</option>
                                                    @endforeach
                                                </select>
                                            
                                                {!! $errors->first('department', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
    
                                          <div class="col-md-6">
           <div class="form-group {{ $errors->has('designation_id') ? 'has-error' : ''}}">
            <label for="department" class="control-label">{{ 'Designation ' }}</label>
            <select class="form-control role form-control-sm" name="designation_id" id="designation_id" >
           <option value="">---Select Department---</option>
               @foreach($designations as $val)
                <option value="{{ $val->id }}" {{ isset($purchase_indent->designation_id)?((auth()->user()->designation_id===$val->id)?'selected':''):'' }} > {{ $val->title }}</option>
                                                    @endforeach
                </select>
                                               
                                                {!! $errors->first('designation_id', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <input class="btn btn-primary" type="submit" value="Update">
                                        </div>
                                    </div>
                                </form>
                            </div>
                                @endsection
 
@section('javascript')
</div>