<div class="row">
    <div class="col-sm-6">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Fee Type' }}</label>
    <input class="form-control" name="title" type="text" required id="title" value="{{ isset($FeeType->title) ? $FeeType->title : ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group ">
    <input class="btn btn-primary " type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
</div>
 



