<div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group {{ $errors->has('academic_year') ? 'has-error' : ''}}">
                                        <label for="academic_year" class="control-label">{{ 'Academic Year' }}</label>
                                        <select class="form-control" name="academic_year" type="text" id="academic_year"
                                            value="{{ isset($feestructure->academic_year) ? $feestructure->academic_year : ''}}"
                                            data-validation="required">
                                            <option value="">-----Select Acad Year----</option>
                                            @for($i=2009;$i <= date('Y'); $i++) <option value="{{$i}}"
                                                {{ isset($feestructure->academic_year) ?($feestructure->academic_year==$i)?'selected' : '':''}}>
                                                {{$i}}</option>
                                                @endfor
                                                </select>
                                                    {!! $errors->first('academic_year', '<p class="help-block">:message
                                                    </p>') !!}
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                        <label for="title" class="control-label">{{ 'Academic Year' }}</label>
                                        <select class="form-control" name="academic_tearm" type="text"
                                            id="academic_tearm"
                                            value="{{ isset($feestructure->academic_year) ? $feestructure->academic_year : ''}}"
                                            data-validation="required">
                                            <option value="">-----Select Acad Semester----</option>

                                            <option value="Spring"
                                                {{ isset($feestructure->academic_tearm) ?($feestructure->academic_tearm=='Spring')?'selected' : '':''}}>
                                                Spring</option>
                                            <option value="Autumn"
                                                {{ isset($feestructure->academic_tearm) ?($feestructure->academic_tearm=='Autumn')?'selected' : '':''}}>
                                                Autumn</option>

                                            </select>
                                                {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group {{ $errors->has('ademission_year') ? 'has-error' : ''}}">
                                        <label for="ademission_year"
                                            class="control-label">{{ 'Admession Year' }}</label>
                                        <select class="form-control" name="ademission_year" type="text"
                                            id="ademission_year" data-validation="required">
                                            <option value="">-----Select Admession Year----</option>
                                            @for($i=2009;$i <= date('Y'); $i++) <option value="{{$i}}"
                                                {{ isset($feestructure->ademission_year) ?($feestructure->ademission_year==$i)?'selected' : '':''}}>
                                                {{$i}}</option>
                                                @endfor
                                                </select>
                                                    {!! $errors->first('ademission_year', '<p class="help-block">
                                                        :message</p>') !!}
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group {{ $errors->has('program') ? 'has-error' : ''}}">
                                        <label for="program" class="control-label">{{ 'Program' }}</label>
                                        <select class="form-control" name="program" type="text" id="program"
                                            data-validation="required">
                                            <option value="">-----Select Program----</option>
                                            @foreach($programlist as $pval)
                                            <option value="{{$pval->program}}"
                                                {{ isset($feestructure->program) ?($feestructure->program == $pval->program)?'selected' : '':''}}>
                                                {{$pval->program}}</option>

                                            @endforeach
                                            </select>
                                                {!! $errors->first('program', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group {{ $errors->has('program') ? 'has-error' : ''}}">
                                        <label for="program" class="control-label">{{ 'Category' }}</label>
                                        <select class="form-control" name="category" type="text" id="category"
                                            data-validation="required">
                                            <option value="">-----Select Category----</option>
                                            @foreach($castcategorylist as $cval)
                                            <option value="{{$cval->castcategory}}"
                                                {{ isset($feestructure->category) ?($feestructure->category == $cval->castcategory )?'selected' : '':''}}>
                                                {{$cval->castcategory}}</option>
                                            @endforeach

                                            </select>
                                                {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                <table id="dtHorizontalExample" class=" table table-bordered">
                                    <input type="hidden" name="deleteitem_id" id="deleteitem">
                                    <thead>
                                        <tr>
                                            <th class="serial">
                                                S.N.</th>

                                            <th class="w">Fee Type <span class="required">*</span></th>
                                            <th class="large">Amount</th>



                                        </tr>
                                    </thead>
                                    <tbody>
                                     
                                        @foreach($feestructure->FeeDetails as $fval)
                                        <tr>
                                            <td> <input type="hidden" name="fee_details_id[]" class="form-control"
                                                    value="{{$fval->id}}" />{{ $loop->iteration }}</td>
                                            <td>{{$fval->fee_type}}
                                                <input type="hidden" name="fee_type[]" class="form-control feeamount"
                                                    value="{{$fval->fee_type}}" />
                                            </td>
                                            <td>
                                                <div
                                                    class="form-group {{ $errors->has('totalamount') ? 'has-error' : ''}}">
                                                    <input type="text" name="amount[]" class="form-control feeamount"
                                                        data-validation="number" data-validation-allowing="float"
                                                        data-rule-digits="true" value="{{$fval->amount}}" />
                                                </div>
                                            </td>

                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td><b>Total Amount</b></td>
                                            <td>
                                                <div
                                                    class="form-group {{ $errors->has('totalamount') ? 'has-error' : ''}}">

                                                    <input class="form-control" name="totalamount" type="text"
                                                        id="totalamount"
                                                        value="{{ isset($feestructure->totalamount) ? $feestructure->totalamount : ''}}"
                                                        data-validation="required" readonly>
                                                    {!! $errors->first('totalamount', '<p class="help-block">:message
                                                    </p>') !!}
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="col-sm-12">

                                </div>


                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit"
                                        value="{{'Update'}}">
                                </div>