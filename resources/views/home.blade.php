@extends('layouts.app')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
    
      <div class="row mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Question</div>
  
                <div class="card-body"> 
                <h2>Full Question Pepar</h2>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif 
        
                    @if($item->Examdata->exam_file!="")
                    <iframe src="{{url($item->Examdata->exam_file)}}" width="100%" height="200px">
                    </iframe>
               @endif
               <hr style="border: 1px solid red;">
               <div class="btn-group btn-group-lg">
               <h3>Questions </h3>
                @foreach($question_list as $quval)
                <?php $url='home/questiononly/'. App\Exam::encryptionmethod($quval->id);?>
                @if($quval->id===$item->id)
              <a href="{{url($url)}}" class="btn btn-primary ">{{$loop->iteration}}</a>&nbsp;&nbsp;&nbsp;
              @else
              <a href="{{url($url)}}" class="btn btn-secondary ">{{$loop->iteration}}</a>&nbsp;&nbsp;&nbsp;
              @endif
   @endforeach
</div><br>          <hr style="border: 1px solid red;">
       <h2>Question PDF</h2>
               <iframe src="{{url($item->image_file)}}" width="100%" height="300px"> </iframe>
                <form method="POST" action="{{ url('/ansstudent') }}" accept-charset="UTF-8" class="form-horizontal" id="myform1" enctype="multipart/form-data">
                                    {{ csrf_field() }}  
                                    <!-- <div class="row">  
                                    <div class="col-md-6">                           -->
                                            <div class="form-group {{ $errors->has('file_one') ? 'has-error' : ''}}">
                                                <label for="department" class="control-label">{{ 'Upload File 1' }}</label>
                                              <input type="hidden" value="{{$item->exam_id}}" name="exams_id">
                                              <input type="hidden" value="{{$item->id}}" name="question_id">
                                           <input class="form-control" name="file_one" type="file" id="file_one"  >  
                                           @if($ansitem->file_one!='')
                                           <a href="{{url('public'.$ansitem->file_one)}}" target="_blanck">Uploaded File</a>
                                           @endif
                                                {!! $errors->first('file_one', '<p class="help-block">:message</p>') !!}
                                           
                                        </div>
                                    
                                        <!-- <div class="col-md-6">  
                                        <a href="#" class="btn btn-success upload">Upload</a>
                                        </div>
                                        </div> -->
                                        <div class="form-group {{ $errors->has('file_two') ? 'has-error' : ''}}">
                                                <label for="file_two" class="control-label">{{ 'Upload File 2' }}</label>
                                              
                                           <input class="form-control" name="file_two" type="file" id="file_two"  > 
                                           @if($ansitem->file_two!='')
                                           <a href="{{url('public'.$ansitem->file_two)}}" target="_blanck">Uploaded File</a>
                                           @endif 
                                                {!! $errors->first('department', '<p class="help-block">:message</p>') !!}
                                           
                                        </div>
                                        <div class="form-group {{ $errors->has('file_three') ? 'has-error' : ''}}">
                                                <label for="file_three" class="control-label">{{ 'Upload File 3' }}</label>
                                              
                                           <input class="form-control" name="file_three" type="file" id="file_three">  
                                           @if($ansitem->file_three!='')
                                           <a href="{{url('public'.$ansitem->file_three)}}" target="_blanck">Uploaded File</a>
                                           @endif 
                                                {!! $errors->first('file_three', '<p class="help-block">:message</p>') !!}
                                           
                                        </div>
                                     <br>
                                        <div class="btn-group btn-group-lg">
                                        <!-- <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>&nbsp;&nbsp;&nbsp; -->
                                  
                                        @if($fileurl!='')
                                        <input class="btn btn-success" type="submit" value="Next">&nbsp;&nbsp;&nbsp;
                                        <!-- onclick="return confirm(&quot;Confirm delete?&quot;)" -->
                                        <button type="submit" class="btn btn-success" title="Delete exam" name="submit" value="submit" onclick="return confirm(&quot;Do you want to submit the Final Answer sheet ?&quot;)">Submit</button>&nbsp;&nbsp;&nbsp;
                                            <a class="btn btn-primary pull-left" href="{{url($fileurl)}}" target="_blanck" >Preview</a>
                                            @else
                                            <input class="btn btn-success" type="submit" value="Next">&nbsp;&nbsp;&nbsp;
                                         @endif
                                      </div>
                                </form>   
                 
                 
               
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script>
$('.upload').on('click', function() {
    alert()
  
});
</script>
@endsection

