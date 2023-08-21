<div class="row">
<div class="col-md-6">
<div class="form-group {{ $errors->has('from_date') ? 'has-error' : ''}}">
    <label for="from_date" class="control-label">{{ 'Start Date (MM/DD/YYYY)' }}</label>
    <input  class="form-control dateclassrebate dp" data-validation="required" name="from_date" type="text" id="from_date" value="{{ isset($category->from_date) ? $category->from_date : ''}}" readonly="readonly" >
        
    {!! $errors->first('from_date', '<p class="invalid-feedback">:message</p>') !!}
</div>
</div>
<div class="col-md-6">
<div class="form-group {{ $errors->has('to_date') ? 'has-error' : ''}}">
    <label for="to_date" class="control-label">{{ 'End Date (MM/DD/YYYY)' }}</label>
    <input  class="form-control dateclassrebate dp" data-validation="required" name="to_date" type="text" id="to_date" value="{{ isset($category->to_date) ? $category->to_date : ''}}" readonly="readonly" >
    	
    {!! $errors->first('to_date', '<p class="invalid-feedback">:message</p>') !!}
</div>
</div>

<!-- <hr> Student Period  of this slot <br> -->
<div class="col-md-6">
<div class="form-group {{ $errors->has('to_date') ? 'has-error' : ''}}">
    <label for="to_date" class="control-label">{{ 'Type Rebate' }}</label>
    <select class="form-control " data-validation="required" name="type_rebate"  id="type_rebate"  >
        <option value="">---Select Rebate type---</option>
        <option value="Long Term Rebate">Long Term Rebate</option>
         <option value="Short Term Rebate">Short Term Rebate</option>
    </select>    	
    {!! $errors->first('type_rebate', '<p class="invalid-feedback">:message</p>') !!}
</div>
</div>
<div class="col-md-6">
<div class="form-group {{ $errors->has('reason') ? 'has-error' : ''}}">
    <label for="from_date" class="control-label">{{ 'Reason' }}</label>
    <input  class="form-control " data-validation="required" name="reason" type="text" id="reason" value="{{ isset($category->reason) ? $category->reason : ''}}"  >    	
    {!! $errors->first('reason', '<p class="invalid-feedback">:message</p>') !!}
</div>
</div>
<div class="col-md-6" style="display:none" id="fileupload">
        <div class="form-group {{ $errors->has('reason') ? 'has-error' : ''}}">
            <label for="from_date" class="control-label">{{ 'Upload Document' }}</label>
            <input type="file" name="file" class="form-control" id="chooseFile"  accept=".pdf, .doc">
            {!! $errors->first('reason', '<p class="invalid-feedback">:message</p>') !!}
        </div>
</div>

</div>
</div>
</div>

<!-- <div class="start_date dp"></div>
<div class="end_date dp"></div>
<a href="#" class="reset">reset</a> -->

<div class="col-md-6 offset-md-3">
<div class="form-group">
    <input class="btn btn-primary btn-lg btn-block" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
</div>

<script>
      $(document).ready(function () {
        $("select").change(function () {
          $("select option:selected").each(function () {
            //enter bengal districts
            if ($(this).attr("value") == "Long Term Rebate") {
              $("#fileupload").show();
            }
            //enter other states
            if ($(this).attr("value") == "Short Term Rebate") {
              $("#fileupload").hide();
            }
          });
      });
    });
</script>
