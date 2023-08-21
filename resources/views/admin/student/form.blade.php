<div class="form-group {{ $errors->has('acadsem') ? 'has-error' : ''}}">
    <label for="acadsem" class="control-label">{{ 'Acadsem' }}</label>
    <input class="form-control" name="acadsem" type="number" id="acadsem" value="{{ isset($feedback_allocation->acadsem) ? $feedback_allocation->acadsem : '1'}}" >
    {!! $errors->first('acadsem', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('acadyear') ? 'has-error' : ''}}">
    <label for="acadyear" class="control-label">{{ 'Acadyear' }}</label>
    <input class="form-control" name="acadyear" type="number" id="acadyear" value="{{ isset($feedback_allocation->acadyear) ? $feedback_allocation->acadyear : '2020'}}" >
    {!! $errors->first('acadyear', '<p class="help-block">:message</p>') !!}
</div>



<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
