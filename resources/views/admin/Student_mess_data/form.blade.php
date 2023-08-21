<div class="row">
@if(auth()->user()->role_id==1)
    <div class="col-md-6">
<div class="form-group {{ $errors->has('mess_name') ? 'has-error' : ''}}">
    <label for="mess_name" class="control-label">{{ 'Select Student' }}</label>
    <select  class="form-control select2" data-validation="required" name="created_by" type="text" id="created_by" value="{{ isset($Student_mess_data->created_by) ? $Student_mess_data->created_by : ''}}"   >
    <option value="">Select </option> 
    @foreach($userlist as $uval)      
   <option value="{{$uval->id}}" {{isset($Student_mess_data->created_by)?(($Student_mess_data->created_by===$uval->id)?'selected':''):'' }}>{{$uval->name}} ({{$uval->email}})</option>
   @endforeach   
</select>        
    {!! $errors->first('created_by', '<p class="invalid-feedback">:message</p>') !!}
</div>
</div>
@endif
@if(auth()->user()->role_id!=1)
	<div class="col-md-6">
<div class="form-group {{ $errors->has('student_name') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Student Name' }}</label>
    <input class="form-control" data-validation="required" name="student_name" type="text" id="student_name" value="{{auth()->user()->name}}" readonly="" >
    	
    {!! $errors->first('student_name', '<p class="invalid-feedback">:message</p>') !!}
</div>
</div>
@endif
	<div class="col-md-6">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Room Number' }}</label>
    <input class="form-control" data-validation="required" name="room_no" type="text" id="room_no" value="{{ isset($Student_mess_data->room_no) ? $Student_mess_data->room_no : ''}}" >
    	
    {!! $errors->first('room_no', '<p class="invalid-feedback">:message</p>') !!}
</div>
</div>

<div class="col-md-6">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Hostel Name' }}</label>
    <select class="form-control" data-validation="required" name="hostel_name" type="text" id="hostel_name" value="{{ isset($Student_mess_data->hostel_name) ? $Student_mess_data->hostel_name : ''}}" >
    	  <option value="">Select </option>
        @if($hostellist)
    	@foreach($hostellist as $val)
    	  <option value="{{ $val->title }}" {{ (isset($Student_mess_data->hostel_name)==$val->title)?'selected':'' }} > {{ $val->title }}</option>
    	
    	@endforeach
        @endif
</select>
    {!! $errors->first('hostel_name', '<p class="invalid-feedback">:message</p>') !!}
</div>
</div>
<div class="col-md-6">
<div class="form-group {{ $errors->has('program') ? 'has-error' : ''}}">
    <label for="program" class="control-label">{{ 'Program' }}</label>
    <select class="form-control" data-validation="required" name="program" type="text" id="program" value="{{ isset($Student_mess_data->program) ? $Student_mess_data->program : ''}}" >
    	<option value="">Select </option>
        @if($programlist)
    	@foreach($programlist as $val)
    	  <option value="{{ $val->program}}" {{ (isset($Student_mess_data->hostel_name)==$val->program)?'selected':'' }} > {{ $val->program }}</option>@endforeach @endif
</select>
    {!! $errors->first('program', '<p class="invalid-feedback">:message</p>') !!}
</div>
</div>
<div class="col-md-6">
<div class="form-group {{ $errors->has('from_date') ? 'has-error' : ''}}">
    <label for="from_date" class="control-label">{{ 'From Date (MM/DD/YY)' }}</label>
    <input  class="form-control dateclass" data-validation="required" name="from_date" type="text" id="from_date" value="{{ isset($Slot->student_from_date) ? $Slot->student_from_date : ''}}" readonly="readonly" >
        
    {!! $errors->first('from_date', '<p class="invalid-feedback">:message</p>') !!}
</div>
</div>
<div class="col-md-6">
<div class="form-group {{ $errors->has('to_date') ? 'has-error' : ''}}">
    <label for="to_date" class="control-label">{{ ' To Date (MM/DD/YY)' }}</label>
    <input  class="form-control dateclass" data-validation="required" name="to_date" type="text" id="to_date" value="{{ isset($Slot->student_to_date) ? $Slot->student_to_date : ''}}" readonly="readonly" >
    	
    {!! $errors->first('to_date', '<p class="invalid-feedback">:message</p>') !!}
</div>
</div>

<div class="col-md-6">
<div class="form-group {{ $errors->has('mess_name') ? 'has-error' : ''}}">
    <label for="mess_name" class="control-label">{{ 'Mess Name' }}</label>
    <select  class="form-control" data-validation="required" name="mess_name" type="text" id="mess_name" value="{{ isset($Student_mess_data->mess_name) ? $Student_mess_data->mess_name : ''}}"  >
    <option value="">Select </option>
    	@foreach($messlist as $mval)
    	  <option value="{{ $mval->title }}" {{ (isset($Student_mess_data->mess_name)==$mval->title)?'selected':'' }} > {{ $mval->title }}</option>@endforeach
</select>
    	
    {!! $errors->first('mess_name', '<p class="invalid-feedback">:message</p>') !!}
</div>
</div>
<div class="col-md-6">
<div class="form-group {{ $errors->has('mess_name') ? 'has-error' : ''}}">
    <label for="mess_name" class="control-label">{{ 'Plan Type' }}</label>
    <select  class="form-control" data-validation="required" name="plan_type" type="text" id="plan_type" value="{{ isset($Student_mess_data->plan_type) ? $Student_mess_data->plan_type : ''}}"  >
    <option value="">Select </option>    	
    	  <option value="NHT" {{ (isset($Student_mess_data->plan_type)=='NHT')?'selected':'' }} > NHT</option>
    	    <option value="HT" {{ (isset($Student_mess_data->plan_type)=='HT')?'selected':'' }} > HT</option>    	  
</select>
    	
    {!! $errors->first('mess_name', '<p class="invalid-feedback">:message</p>') !!}
</div>
</div>
</div>
</div>
</div>

<div class="col-md-6 offset-md-3">
<div class="form-group">
    <input class="btn btn-primary btn-lg btn-block" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
</div>
