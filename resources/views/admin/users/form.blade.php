<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Full Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" data-validation="required" value="{{ isset($modal->name) ? $modal->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email Id' }}</label>
    <input class="form-control" name="email" type="text" id="email" data-validation="required" value="{{ isset($modal->email) ? $modal->email : ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('role_id') ? 'has-error' : ''}}">
    <label for="role_id" class="control-label">{{ 'Role Id' }}</label>
    <input class="form-control" name="role_id" type="text" id="role_id" data-validation="required" value="{{ isset($modal->role_id) ? $modal->role_id : ''}}" >
    {!! $errors->first('role_id', '<p class="help-block">:message</p>') !!}
</div>

@if($designations)
<div class="form-group {{ $errors->has('designation_id') ? 'has-error' : ''}}">
<label for="email" class="control-label">{{ 'Designation ' }}</label>
<select class="form-control designations select2" data-id="" name="designation_id" id="" data-validation="required" >
<option value=""  >--------- Select Desination-------</option>
                          @foreach($designations as $val)
                          @if ($val->id === $modal->designation_id)
                          <option value="{{ $val->id }}"  selected> {{ $val->title }}</option>
                          @else
                          <option value="{{ $val->id }}"> {{ $val->title }}</option>
                          @endif
                          @endforeach
                             </select>
                               </div>
  <div class="form-group {{ $errors->has('department_id') ? 'has-error' : ''}}">
  <label for="email" class="control-label">{{ 'Department ' }}</label>
        <select class="form-control department select2" name="department_id" data-id="{{ $modal->id }}" id="" >
        <option value="" >--------- Select Department-------</option>              
          @foreach($department as $val)
            @if ($val->id === $modal->department_id)
             <option value="{{ $val->id }}"  selected> {{ $val->name .'('.$val->code.')' }}</option>
               @else
                  <option value="{{ $val->id }}"> {{ $val->name  .'('.$val->code.')' }}</option>
                @endif
                    @endforeach
                      </select>
                           </div>

@endif
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
