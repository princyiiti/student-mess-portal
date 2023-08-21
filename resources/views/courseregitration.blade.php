@extends('layouts.app')

@section('content')
   <div class="content-wrapper" style="min-height: 543px;">
        <!-- Content Header (Page header) -->
       
            <!-- Content Header (Page header) -->
            <div class="card card-primary">
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Student Course Registation</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Student Course Registation</li>
                    </ol>
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            </div>
            <!-- /.content-header -->
        
            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
<div class="card card-primary">
                   
                        <div class="">
                    <div class="card-header">Student Course Registation</div>
                    <div class="card-body">
                      

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Department</th>
                                         <th>Program</th>
                                         
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>{{$studentprofile->rollno}}</td>
                                 <td>{{$studentprofile->name}}</td>
                                <td>{{$studentprofile->dept}}</td>
                                 <td>{{$studentprofile->prog}}</td>
                      </tbody></table>
                        </div>

                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                <form action="{{ url('courseregirationsave') }}" method="POST">
                     {{ csrf_field() }}
                   <h3>Core Course List </h3>
                   <div class="col-md-6">
                
                    <div class="form-group {{ $errors->has('openlelectivecount') ? 'has-error' : ''}}">
                    @foreach($courseregiration->Chieldlist as $val)
                    @if($val->coursetype=="Core")
                    <div class="form-check">
                   <input class="form-check-input" type="checkbox" value="{{$val->coursecode}}" id="flexCheckDefault" name="coursecode[]" onclick="return false" checked readonly>
                   <label class="form-check-label" for="flexCheckDefault">
                    <input type="hidden" name="coursename[]" value="{{$val->coursename}}">
                    <!-- <input type="hidden" name="coursecode[]" value="{{$val->coursecode}}"> -->
                     {{$val->coursecode}}  {{App\Courseregiration::getcoursedetail($val->coursecode)}} 
                    </label>
                    </div>
                    @endif
                   @endforeach
</div>
</div>

           <h3>Core Elective Course List </h3>
           <hr>
              <div class="col-sm-6">
                @for($i=0;$i<$courseregiration->deparmentlelectivecount;$i++)
                    <div class="form-group {{ $errors->has('openlelectivecount') ? 'has-error' : ''}}">
                        <label for="title" class="control-label">{{ 'Core Elective' }}{{ $i+1 }}</label>
                        <select name="coreelective[]" id="corelective" class="form-control">
                             @foreach($courseregiration->Chieldlist as $val)
                    @if($val->coursetype=="Core Elective")
                    @if(App\Courseregiration::getcoursedetailcount($val->coursecode))
                            <option value="{{$val->coursecode}}">{{$val->coursecode}} {{App\Courseregiration::getcoursedetail($val->coursecode)}} </option>
                            @endif
                             @endif
                   @endforeach
                        </select>
                    </div>
                    @endfor
                   </div>
                   @if($courseregiration->type==1)
                 
                       <h3>Open Elective Course List </h3>
                    <hr>
                <!-- //============MAx Open Elective work for M.Tech. and MSR ======================= -->
                @if($courseregiration->maxopenelective>0)
             @for($j=0;$j<$courseregiration->maxopenelective;$j++)
               <div class="col-sm-6">
              
                    <div class="form-group {{ $errors->has('openlelectivecount') ? 'has-error' : ''}}">
                        <label for="title" class="control-label">{{ 'Core Elective' }}{{ $i+1 }}</label>
                        <select name="electivecourse[]" id="corelective" class="form-control">
                              @foreach($electivecourselist as $electiveval)  
                  
                            <option value="{{$electiveval->crsecode}}">{{$electiveval->crsecode}}  ({{App\Courseregiration::getcoursedetail($electiveval->crsecode)}}) </option>
                           
                   @endforeach
                        </select>
                    </div>
                   
                   </div>
                   @endfor
               @else
                  <div class="row">
                    @foreach($electivecourselist as $electiveval)  
                      <div class="col-md-4">     
                      <div class="form-group {{ $errors->has('electivecourse') ? 'has-error' : ''}}">         
                    <div class="form-check">
                   <input class="form-check-input" type="checkbox" value="{{$electiveval->crsecode}}" name="electivecourse[]" id="flexCheckDefault" >
                   <label class="form-check-label" for="flexCheckDefault">                    
                     {{$electiveval->crsecode}} ({{App\Courseregiration::getcoursedetail($electiveval->crsecode)}})
                    </label>
                    </div>
                    </div>
                    </div>
                   @endforeach
               </div>
                @endif
                   @endif
              
</div>

<hr>
<div class="col-md-6">
<input  type="submit" class="btn btn-primary btn-lg btn-block" style="color:white;" value="Submit">
</div>
                </form>
                <br> <br>
            </div>
                </div>
                           </section>
</div>
            </div>
        </div>
    </div>

@endsection
