<style>
    a.btndelete {
  background-color: red; /* Blue background */
  border: none; /* Remove borders */
  color: white; /* White text */
 padding: 4px 9px;
  font-size: 14px; /* Set a font size */
  cursor: pointer; /* Mouse pointer on hover */

}
i.fa.fa-trash {
    color: #fff;
}
    a.custtombtn {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 12px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
</style>
<div class="row">


<div class="col-sm-3">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Department Name' }}</label>
    <select class="form-control" name="department" type="text" id="department" value="{{ isset($model->department) ? $model->department : ''}}"  data-validation="required" >
        <option value="">-----Select Department----</option>
               @foreach($departmentlist as $dval)
        <option value="{{$dval->deptname}}" {{ isset($model->department) ?($model->department==$dval->deptname)?'selected' : '':''}} >{{$dval->deptname}}</option>

       @endforeach
      
        <</select>
    {!! $errors->first('department', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-sm-3">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Program Name' }}</label>
    <select class="form-control" name="program" type="text" id="program" data-validation="required" >
        <option value="">-----Select Program----</option>
               @foreach($programlist as $pval)
        <option value="{{$pval->program}}" {{ isset($model->program) ?($model->program==$pval->program)?'selected' : '':''}} >{{$pval->program}}</option>

       @endforeach
      
        <</select>
    {!! $errors->first('department', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="col-sm-3">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Studying Year' }}</label>
    <select class="form-control" name="studyingyear" type="text" id="studyingyear" data-validation="required" >
        <option value="">-----Select Studying Year----</option>
            @for($i=1;$i <= 15; $i++)
        <option value="{{$i}}" {{ isset($model->studyingyear) ?($model->studyingyear==$i)?'selected' : '':''}}>{{$i}}</option>
        @endfor
      
        <</select>
    {!! $errors->first('studyingyear', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-sm-3">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Semester' }}</label>
    <select class="form-control" name="semester" type="text" id="semester" data-validation="required" >
        <option value="">-----Select Studying Sem----</option>
            @for($i=1;$i <= 3; $i++)
        <option value="{{$i}}" {{ isset($model->semester) ?($model->semester==$i)?'selected' : '':''}}>{{$i}}</option>
        @endfor
      
        <</select>
    {!! $errors->first('semester', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-sm-3">
<div class="form-group {{ $errors->has('deparmentlelectivecount') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Number of Core Elective' }}</label>
    <input class="form-control" data-validation="required" required name="deparmentlelectivecount" type="text" id="deparmentlelectivecount" value="{{ isset($model->deparmentlelectivecount) ? $model->deparmentlelectivecount : ''}}" >
    {!! $errors->first('deparmentlelectivecount', '<p class="invalid-feedback">:message</p>') !!}
</div>
</div>
<div class="col-sm-3">
<div class="form-group {{ $errors->has('openlelectivecount') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Number of Open Elective' }}</label>
    <input class="form-control" data-validation="required" required name="openlelectivecount" type="text" id="openlelectivecount" value="{{ isset($model->openlelectivecount) ? $model->openlelectivecount : ''}}" >
    {!! $errors->first('openlelectivecount', '<p class="invalid-feedback">:message</p>') !!}
</div>
</div>
<div class="col-sm-3">
<div class="form-group {{ $errors->has('openlelectivecount') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Max Number of All Open Elective' }}</label>
    <input class="form-control" data-validation="required" required name="maxopenelective" type="text" id="maxopenelective" value="{{ isset($model->maxopenelective) ? $model->maxopenelective : ''}}" >
    {!! $errors->first('maxopenelective', '<p class="invalid-feedback">:message</p>') !!}
</div>
</div>

<div class="col-sm-3">
<div class="form-group {{ $errors->has('openlelectivecount') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Open for All Elective' }}</label>
    <select class="form-control" name="type" type="text" id="type" data-validation="required" >
         <option value="0" {{ isset($model->type) ?($model->type=="0")?'selected' : '':''}}> No</option>
        <option value="1"{{ isset($model->type) ?($model->type=="1")?'selected' : '':''}}> Yes</option>
       
 </select>
    {!! $errors->first('openlelectivecount', '<p class="invalid-feedback">:message</p>') !!}
</div>
</div>

</div>
<table  id="coursedata" class=" table table-bordered">
        <input type="hidden" name="deleteitem_id" id="deleteitem" >
        <thead>
            <tr>
     <th class="serial">
                    S.N.</th>
                
                <th class="w">Fee Type <span class="required">*</span></th>
                <th class="large">Amount</th>
               
               
              
            </tr>
        </thead>
        <tbody>
            @if(isset($model->Chieldlist))
            @foreach($model->Chieldlist as $val)
           
<tr>
     <td>{{ $loop->iteration }}<a class="delete btndelete" href="{{url('admin/deletchield/'.$val->id)}}"><i class="fa fa-trash"></i></a></td>
     <td>
<select class='form-control form-control-sm select2 'name='coursecode[]' type='text'  id="name_and_occupation_1count  " value='' data-validation='required'  >
    <option>-----Select Course---</option>
    @foreach($courselist as $cval)
    <option value="{{$cval->crsecode}}" {{ isset($val->coursecode)?(($val->coursecode===$cval->crsecode)?'selected':''):'' }} >{{$cval->crsecode}}</option>
    @endforeach
</select>
    </td>
    <td>
        <select class='form-control form-control-sm 'name='coursetype[]' type='text'  id="name_and_occupation_1" value='' data-validation='required'  >
            <option value="Core Elective" {{ isset($val->coursetype)?(($val->coursetype==='Core Elective')?'selected':''):'' }}>Core Elective</option>
            <option value="Core" {{ isset($val->coursetype)?(($val->coursetype==='Core')?'selected':''):'' }}>Core </option>
             <option value="Elective" {{ isset($val->coursetype)?(($val->coursetype==='Elective')?'selected':''):'' }}>Elective</option>
    </select>
    </td>

</tr>
@endforeach
@else
<tr>
     <td>1</td>
     <td>
<select class='form-control form-control-sm select2 'name='coursecode[]' type='text'  id="name_and_occupation_1count  " value='' data-validation='required'  >
    <option>-----Select Course---</option>
    @foreach($courselist as $cval)
    <option value="{{$cval->crsecode}}">{{$cval->crsecode}}</option>
    @endforeach
</select>
    </td>
    <td>
        <select class='form-control form-control-sm 'name='coursetype[]' type='text'  id="name_and_occupation_1" value='' data-validation='required'  >
            <option value="Core Elective">Core Elective</option>
            <option value="Core">Core </option>
             <option value="Elective">Elective</option>
    </select>
    </td>

</tr>
@endif
 </tbody>
        </table>
 <a style="color: white;cursor: pointer;" class="add_newreferance custtombtn" id="add_newreferance">Add New</a>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>


<script type="text/javascript">

  
     $(".add_newreferance").click(function(){
   // count++;
    var sno = count=($('#coursedata tr').length);
   
    var markup = "<tr><td>" + sno + "<a class='delete btndelete' onclick='deletefun(this)'><i class='fa fa-trash'></i></a></td><td><select class='form-control form-control-sm 'name='coursecode[]'>@foreach($courselist as $cval) <option value='{{$cval->crsecode}}'>{{$cval->crsecode }}</option>@endforeach</select></td><td><select class='form-control form-control-sm 'name='coursetype[]' type='text'  id='name_and_occupation_'" + count + "'' value='' data-validation='required'  ><option value='Core Elective'>Core Elective</option><option value='Core'>Core </option><option value='Elective'>Elective</option></select></td></tr>";
    $("#coursedata >  tbody").append(markup);
     $('#name_and_occupation_' + count ).focus();
});
       function deletefun(e){    
     $(e).closest('tr').remove()
    }
</script>