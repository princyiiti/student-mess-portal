<div class="row">
    <div class="col-sm-2">
        <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
            <label for="title" class="control-label">{{ 'Admission Year' }}</label>
            <select required class="form-control select2" name="admission_year" type="text" id="admission_year" value="">
                <option value="">----Select Admission Year---</option>

                @for($i=2009;$i <= date('Y'); $i++) <option value="{{$i}}"
                    {{ isset($model->academic_year) ?($model->academic_year==$i)?'selected' : '':''}}>{{$i}}</option>
                    @endfor
            </select>
            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group {{ $errors->has('academic_year') ? 'has-error' : ''}}">
            <label for="academic_year" class="control-label">{{ 'Academic Year' }}</label>
            <select  required class="form-control" name="academic_year" type="text" id="academic_year"
                value="{{ isset($model->academic_year) ? $model->academic_year : ''}}" data-validation="required">
                <option value="">-----Select Acad Year----</option>
                @for($i=2022;$i <= date('Y'); $i++) <option value="{{$i}}"
                    {{ isset($model->academic_year) ?($model->academic_year==$i)?'selected' : '':''}}>{{$i}}</option>
                    @endfor
            </select>
            {!! $errors->first('academic_year', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
            <label for="title" class="control-label">{{ 'Academic Sem' }}</label>
            <select required class="form-control" name="academic_tearm" type="text" id="academic_tearm"
                value="{{ isset($model->academic_year) ? $model->academic_year : ''}}" data-validation="required">
                <option value="">-----Select Acad Semester----</option>

                <option value="Spring"
                    {{ isset($model->academic_tearm) ?($model->academic_tearm=='Spring')?'selected' : '':''}}>Spring
                </option>
                <option value="Autumn"
                    {{ isset($model->academic_tearm) ?($model->academic_tearm=='Autumn')?'selected' : '':''}}>Autumn
                </option>

                </select>
                {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
            <label for="title" class="control-label">{{ 'Program' }}</label>
            <select required class="form-control select2" name="program" type="text" id="program" value="">
                <option value="">----Select Program---</option>
                @foreach($program as $rval)
                <option value="{{$rval->program}}">{{$rval->program}}</option>
                @endforeach
            </select>
            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
            <label for="title" class="control-label">{{ 'Category' }}</label>
            <select required class="form-control select2" name="category" type="text" id="category" value="">
                <option value="">----Select Category---</option>
                @foreach($category as $val)
                <option value="{{$val->castcategory}}">{{$val->castcategory}}</option>
                @endforeach
            </select>
            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-sm-2">
    <label for="title" class="control-label">{{ 'Generate Report' }}</label>
        <div class="form-group">
            
            <a class="btn btn-primary " id="searchstudentfees" value="" style="color:white;">Generate Report</a>
        </div>
    </div>
    <hr>

    