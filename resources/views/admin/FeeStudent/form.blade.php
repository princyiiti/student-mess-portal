<div class="row">
    <div class="col-sm-6">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Rollno' }}</label>
    <input class="form-control" name="rollno" type="text" id="rollno" value="{{ isset($feestudent->rollno) ? $feestudent->rollno : ''}}" >
    {!! $errors->first('rollno', '<p class="help-block">:message</p>') !!}
</div>
</div>
  <div class="col-sm-6">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Student Name' }}</label>
    <input class="form-control" name="student_name" type="text" id="student_name" value="{{ isset($feestudent->student_name) ? $feestudent->student_name : ''}}" >
    {!! $errors->first('student_name', '<p class="help-block">:message</p>') !!}
</div>
</div>
 <div class="col-sm-3">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Academic Year' }}</label>
    <input class="form-control" name="academic_year" type="text" id="academic_year" value="{{ isset($feestudent->academic_year) ? $feestudent->academic_year : ''}}" >
    {!! $errors->first('academic_year', '<p class="help-block">:message</p>') !!}
</div>
</div>
 <div class="col-sm-3">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Academic Tearm' }}</label>
<input class="form-control" name="academic_tearm" type="text" id="academic_tearm" value="{{ isset($feestudent->academic_tearm) ? $feestudent->academic_tearm : ''}}" >
    {!! $errors->first('academic_tearm', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-sm-6">
    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Fees Type' }}</label>
 <select class="form-control" name="fee_type" id="fee_type" value="{{ isset($feestudent->fee_type) ? $feestudent->fee_type : ''}}" >
    @foreach($feetype as $val)
    <option value="{{$val->title}}">{{$val->title}}</option>
    @endforeach
      </select>
    {!! $errors->first('fee_type', '<p class="help-block">:message</p>') !!}
</div>
 </div>
 <div class="col-sm-6">
    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Amount' }}</label>
<input class="form-control" name="amount" type="text" id="amount" value="{{ isset($feestudent->amount) ? $feestudent->amount : ''}}" >
    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
</div>
 </div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
