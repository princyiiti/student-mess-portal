
<div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="alert alert-success print-success-msg" style="display:none">
        <ul></ul>
    </div>
<div class="row">
    <div class="col-sm-6">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Admission Year' }}</label>
    <select class="form-control select2" name="admission_year" type="text" id="admission_year" value="{{ isset($role->title) ? $role->title : ''}}"  >
        <option value="">----Select Admission  Year---</option>
  
        @for($i=2009;$i <=  date('Y'); $i++)
        <option value="{{$i}}" {{ isset($model->academic_year) ?($model->academic_year==$i)?'selected' : '':''}} >{{$i}}</option>
        @endfor
   </select>
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
</div>
 
 <div class="col-sm-6">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Program' }}</label>
    <select class="form-control select2" name="program" type="text" id="program" value="{{ isset($role->title) ? $role->title : ''}}"  >
        <option value="">----Select Program---</option>
    @foreach($programlist as $rval)
       <option value="{{$rval->program}}">{{$rval->program}}</option>
       @endforeach
   </select>
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
</div>
<hr>

<div class="col-sm-6 datapopulate">
    <div class="form-group">
        <label for="title" class="control-label">{{ 'Apply Fee Structure' }}</label>

        <select class="form-control" name="feestructure" id="feestructure">
            <option value="">--Select Fee Structure--</option>
            @foreach($feestructurelist as $fval)
            <option value="{{$fval->id}}">{{$fval->program}} ({{$fval->academic_year}}/{{$fval->academic_tearm}}) {{$fval->ademission_year}} {{$fval->category}}</option>
            @endforeach
        </select>

    </div>
</div> 

  <!-- <div class="col-sm-6 datapopulate" >
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Apply Fee Structure' }}</label>
    <select class="form-control select2" name="feestructure" id="feestructure" value="{{ isset($role->title) ? $role->title : ''}}" >
        <option value="">--Select Fee Structure--</option>
        @foreach($feestructurelist as $fval)
        <option value="{{$fval->id}}">{{$fval->program}} ({{$fval->academic_year}}/{{$fval->academic_tearm}}) {{$fval->ademission_year}} {{$fval->category}}</option>
        @endforeach
    </select>

    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
</div> -->
 <div class="col-sm-6 datapopulate">
 <label for="title" class="control-label">{{ 'Search Student' }}</label>
<div class="form-group">
    <a class="btn btn-primary" id="searchstudent"value="{{ $formMode === 'edit' ? 'Update' : 'Search Student' }}" style="color:white;">Search Student</a>
</div>
</div>
