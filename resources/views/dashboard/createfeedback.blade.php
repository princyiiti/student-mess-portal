@extends('layouts.app') 
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark" style="text-align: center;">Student Feedback about the Course and its Instructor</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
            <!-- <li class="breadcrumb-item active">Dashboard Academic</li> -->
          </ol>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
    <div class="container">
  <!-- Main content -->
<div class="box box-success">
    <!--<div class="box-header"></div>-->
    <div class="box-body">

      <h1 style="text-align: center;"></h1>
   
        Dear Student,<br><br>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <p>
 It is a belief that an excellent teacher is one who casts an everlasting impression on the students with:
 <ul>
<li> Mastery over the subjects taught.</li>
<li> The effective and lucid manner in which the course material is presented.</li>
<li> Rapport established with the students and the ability to respond to their learning needs with dedication,
imagination and innovativeness.</li>
<li> The ability to act as a mentor and as a role model to the students providing them with the motivation to
learn and to appreciate the finer aspects of the course.</li>
Every student’s feedback is considered very critical in our pursuit for this academic excellence.
Your response to the questionnaire below covers all aspects related to the making of an excellent teacher. So,
please give frank response. You need not disclose your identity anywhere in this form. Given below are
statements for which you need to indicate the extent of your agreement by ticking against the most appropriate
response you think. Your feedback will greatly help the concerned Teacher to improve upon for future teaching.
Please fill a separate Feedback Form for each instructor of a Course.
<br>
Thanking You.<br>

  <br>Dean,Faculty Affairs <br> <p style="text-align: left;">Dean, Academic Affairs</p>
 <hr>
<b>Please tick in ONLY ONE Box using blue/black pen.</b> The following abbreviation has been used along with
the associated weightage shown in the parenthesis:
<br><b>SA: STRONGLY AGREE (3); A: AGREE (2); N: NEUTRAL (1); D: DISAGREE (0) </b>
      </p>
   <form id="myform1" method="POST" action="{{ url('/feedbackallocationsave') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" onsubmit="return checkForm(this);">
   {{ csrf_field() }}
   <div class="modal-body">
      <div class="box-body">
         <!--<div class="form-group"><label for="rollno">rollno :</label><input class="form-control" placeholder="Enter rollno" data-rule-maxlength="256" name="rollno" type="text" value=""></div>-->
          <div class="row">     
           <div class="col-md-3">
         <div class="form-group"><label for="acadyear">Academic Year :</label>
             <input class="form-control" placeholder="Enter acadyear" name="demo" type="number" value="2023"readonly="readonly" >
              <input class="form-control" placeholder="Enter acadyear" name="acadyear" type="hidden" value="2022"readonly="readonly" >
         </div>
                       </div>       
                            <div class="col-md-3">
         <div class="form-group"><label for="acadsem">Semester (Autumn/Spring/Summer):</label>
             <input class="form-control" placeholder="Spring" name="acadsemtext" type="text" value="Spring" readonly="readonly">
              <input class="form-control" placeholder="Enter acadsem" name="acadsem" type="hidden" value="2" readonly="readonly">
         </div>
                       </div> 
                         <div class="col-md-3">
          <div class="form-group"><label for="acadsem">Curse code :</label>
              <input class="form-control" placeholder="Enter acadsem" name="crsecode" type="text" value="{{$crsecode}}" readonly="readonly">
         </div>
                       </div>
             
             
                    <div class="col-md-3">
         <div class="form-group"><label for="username">Name of Course Instructor/Teacher :</label>
             <input class="form-control" placeholder="Enter username" data-rule-maxlength="256" required="" name="username" type="hidden" value="{{$facultydata->username}}" aria-required="true">
             <input class="form-control" placeholder="Enter username" data-rule-maxlength="256" required="" name="name" type="text" value="{{$facultydata->name}}" aria-required="true" readonly="readonly">
         </div></div>
              
                  
          </div>
         <hr>
         <span style="font-size: 15px"><b> PART-1: Qualities of the Faculty </b></span>
          <hr>
         <div class="form-group">
            <label for="a1">1.1 The faculty member has displayed a wide range of knowledge on the subjects and
 attending his lectures has been a good learning experience.<span style="color:red;">*</span>  : </label><br>
 <div class="radio"><label><input name="a1" type="radio" value="3"  required > SA </label><label><input name="a1" type="radio" value="2" > A </label><label><input name="a1" type="radio" value="1"> N </label><label><input name="a1" type="radio" value="0" > D </label>
    @if ($errors->has('a1'))
                                    <span class="help-block form-error" role="alert">
                                        <strong>{{ $errors->first('a1') }}</strong>
                                    </span>
                                @endif
<div id="a1" name="a1ValidationError"></div>
 </div>
         </div>
          <div class="form-group">
            <label for="a2">1.2 The lectures were delivered with authority and excellent communication skills <span style="color:red;">*</span> : </label><br>
            <div class="radio"><label><input name="a2" type="radio" value="3"  required> SA </label><label><input name="a2" type="radio" value="2"> A </label><label><input name="a2" type="radio" value="1"> N </label><label><input name="a2" type="radio" value="0" > D </label>
                <div id="a2" name="a1ValidationError"></div>
         </div>
         <div class="form-group">
            <label for="a4">1.3 The faculty member has encouraged constructive interaction in class <span style="color:red;">*</span> : </label><br>
            <div class="radio"><label><input name="a3"type="radio" value="3"  required> SA </label>
                <label><input name="a3"type="radio" value="2"> A </label><label><input name="a3"type="radio" value="1"> N </label>
                <label><input name="a3"type="radio" value="0"> D </label>
<div id="a3" name="a1ValidationError"></div>
            </div>
         </div>
         </div>
         <div class="form-group">
            <label for="a4">1.4 The instructor has always been accessible for clearing doubts outside the class.
<span style="color:red;">*</span> : </label><br>
            <div class="radio"><label><input name="a4" type="radio" value="3" required> SA </label><label><input name="a4" type="radio" value="2"> A </label><label><input name="a4" type="radio" value="1"> N </label><label><input name="a4" type="radio" value="0"> D </label></div>
         </div>
        <hr>
       <span style="font-size: 15px"><b> PART-2: Impact of the Faculty on the Students</b></span>
        <hr>
       
         <div class="form-group">
            <label for="a5">2.1 The faculty motivated me by words of encouragement and constructive criticism. <span style="color:red;">*</span> : </label><br>
            <div class="radio"><label><input name="a5" type="radio" value="3" required> SA </label><label><input name="a5" type="radio" value="2"> A </label><label><input name="a5" type="radio" value="1"> N </label><label><input name="a5" type="radio" value="0"> D </label></div>
         </div>
         <div class="form-group">
            <label for="a6">2.2 My interest in the subject has grown with continued exposure to the lecture presentation
by the faculty <span style="color:red;">*</span> : </label><br>
            <div class="radio"><label><input name="a6" type="radio" value="2" required> A </label><label><input name="a6" type="radio" value="3"> SA </label><label><input name="a6" type="radio" value="1"> N </label><label><input name="a6" type="radio" value="0" > D </label></div>
         </div>
         <div class="form-group">
            <label for="a7">2.3 My confidence in the faculty has grown so much that I often think of him/her as the best
person to give me guidance on major academic issues. <span style="color:red;">*</span> : </label><br>
            <div class="radio"><label><input name="a7" type="radio" value="3" required> SA </label><label><input name="a7" type="radio" value="2"> A </label><label><input name="a7" type="radio" value="1"> N </label><label><input name="a7" type="radio" value="0" > D </label></div>
         </div>
        <hr><!-- comment -->
        <span style="font-size: 15px"><b>PART-3: Quality of Instruction in the Course</b></span>
        <hr>
         <div class="form-group">
            <label for="a8">3.1 The lecture material and presentations were well organized to meet the course
objectives mentioned in the course bulletin. <span style="color:red;">*</span> : </label><br>
            <div class="radio"><label><input name="a8" type="radio" value="3" required> SA </label><label><input name="a8" type="radio" value="2"> A </label><label><input name="a8" type="radio" value="1"> N </label><label><input name="a8" type="radio" value="0"> D </label></div>
         </div>
         <div class="form-group">
            <label for="a9">3.2 The faculty member respected students as co-learners and responded positively to their
learning needs. <span style="color:red;">*</span>: </label><br>
            <div class="radio"><label><input name="a9" type="radio" value="3"  required> SA </label><label><input name="a9" type="radio" value="2"> A </label>
                <label><input name="a9" type="radio" value="1"> N </label>
                <label><input name="a9" type="radio" value="0" > D </label>
            </div>
         </div>
         <div class="form-group">
            <label for="a10">3.3 The class presentations were lucid and included interesting examples to enhance my
interest in the subject <span style="color:red;">*</span>: </label><br>
            <div class="radio"><label><input name="a10" type="radio" value="3" required> SA </label><label><input name="a10" type="radio" value="2"> A </label>
                <label><input name="a10" type="radio" value="1"> N </label>
                <label><input name="a10" type="radio" value="0"> D </label></div>
         </div>
         <div class="form-group">
            <label for="a11">3.4 The faculty laid sufficient emphasis on the presentation of basic principles. <span style="color:red;">*</span>: </label><br>
            <div class="radio"><label><input name="a11" type="radio" value="3"  required> SA </label><label><input name="a11" type="radio" value="2"> A </label><label><input name="a11" type="radio" value="1"> N </label><label><input name="a11" type="radio" value="0" > D </label></div>
         </div>
         <div class="form-group">
            <label for="a12">3.5 The lectures encouraged independent thinking and the ability to apply logical reasoning
methods in the understanding. <span style="color:red;">*</span> : </label><br>
            <div class="radio"><label><input name="a12" type="radio" value="3"  required> SA </label><label><input name="a12" type="radio" value="2"> A </label><label><input name="a12" type="radio" value="1"> N </label><label><input name="a12" type="radio" value="0"> D </label></div>
         </div>
         <div class="form-group">
            <label for="a13">3.6 The faculty showed the ability to answer and explain the most complex questions on the
topics <span style="color:red;">*</span>: </label><br>
            <div class="radio"><label><input name="a13" type="radio" value="3"  required> SA </label><label><input name="a13" type="radio" value="2"> A </label><label><input name="a13" type="radio" value="1"> N </label><label><input name="a13" type="radio" value="0"> D </label></div>
         </div>
         <div class="form-group">
            <label for="a14">3.7 Real-life problems and/or applications were included to provide the right balance
between theory and practice.<span style="color:red;">*</span>: </label><br>
            <div class="radio"><label><input name="a14" type="radio" value="3"  required> SA </label><label><input name="a14" type="radio" value="2"> A </label><label><input name="a14" type="radio" value="1"> N </label><label><input name="a14" type="radio" value="0" > D </label></div>
         </div>
         <div class="form-group">
            <label for="a15">3.8 The faculty provided well compiled reference material and
 used innovative teaching aids to facilitate better assimilation of the subject matter.<span style="color:red;">*</span>
 : </label><br>
            <div class="radio"><label><input name="a15" type="radio" value="3"  required> SA </label><label><input name="a15" type="radio" value="2"> A </label><label><input name="a15" type="radio" value="1"> N </label><label><input name="a15" type="radio" value="0"> D </label></div>
         </div>
         <div class="form-group">
            <label for="a16">3.9 The enthusiasm and the energy shown by the faculty helped in creating a vibrant
atmosphere in the class. <span style="color:red;">*</span>: </label><br>
            <div class="radio"><label><input name="a16" type="radio" value="3"  required> SA </label><label><input name="a16" type="radio" value="2"> A </label><label><input name="a16" type="radio" value="1"> N </label><label><input name="a16" type="radio" value="0"> D </label></div>
         </div>
        <hr>
       <span style="font-size: 15px"><b>  PART-4: Evaluation or Assessment Approach </b></span>
        <hr>
         <div class="form-group"><label for="a17">4.1 Tutorials, assignments, quizzes etc. encouraged creativity and rational thinking capability
to handle open-ended problems. <span style="color:red;">*</span> :</label>
               <div class="radio"><label><input name="a17" type="radio" value="3" required> SA </label><label><input name="a17" type="radio" value="2"> A </label><label><input name="a17" type="radio" value="1"> N </label><label><input name="a17" type="radio" value="0" > D </label></div>
         </div>
         <div class="form-group"><label for="a18">4.2 Tutorials/Assignment were not just routine but called for a careful study and detailed
analysis demanding a thorough understanding of the subject. <span style="color:red;">*</span>:</label>
          <div class="radio"><label><input name="a18" type="radio" value="3"  required> SA </label><label><input name="a18" type="radio" value="2"> A </label><label><input name="a18" type="radio" value="1"> N </label><label><input name="a18" type="radio" value="0" > D </label></div>
         </div>
         <div class="form-group"><label for="a19">4.3 Examinations were designed to test my understanding of the subject.
 They could be completed in time with adequate preparation <span style="color:red;">*</span>:</label>
              <div class="radio"><label><input name="a19" type="radio" value="3"  required> SA </label><label><input name="a19" type="radio" value="2"> A </label><label><input name="a19" type="radio" value="1"> N </label><label><input name="a19" type="radio" value="0"> D </label></div>
         </div>
         <div class="form-group"><label for="a20">4.4 Evaluation of quizzes/assignments provided constructive feedback enabling the students
to understand the criteria & standards of evaluation. <span style="color:red;">*</span> : </label>
               <div class="radio"><label><input name="a20" type="radio" value="3" required> SA </label><label><input name="a20" type="radio" value="2"> A </label><label><input name="a20" type="radio" value="1"> N </label><label><input name="a20" type="radio" value="0" > D </label></div>
         </div>
        <hr>
         <span style="font-size: 15px"><b>PART-5: Other Comments/Feedback</b></span>
         <hr>

         <div class="form-group"><label for="p51">1. Has the theory course been designed to fulfil the student's learning needs?
 :</label><input class="form-control"  data-rule-maxlength="256" name="p51" type="text" value=""></div>
         <div class="form-group"><label for="p52">2. Does the corresponding practical/lab course, if any, complement the theory course well? :</label><input class="form-control" data-rule-maxlength="256" name="p52" type="text" value=""></div>
         <div class="form-group">
             <label for="p53">3. Your evaluation and comments about that associated Lab Course and its instructors on a scale of 1-10.</label><br>
             <label for="p53"> Associated Lab/Practical Course:  :</label>
             <input class="form-control" data-rule-maxlength="256" name="p53" type="text" value=""></div>
         <div class="form-group"><label for="p54">Instructor(s) of the Practical course: :</label>
             <input class="form-control" data-rule-maxlength="256" name="p54" type="text" value=""></div>
         <div class="form-group"><label for="p55">4. Suggestions about the personal traits of the faculty members which affect the course. :</label>
             <textarea class="form-control" cols="30" rows="3" name="p55"></textarea></div>
         <div class="form-group"><label for="p56">5. Any other comments/suggestions. :</label>
             <textarea class="form-control" cols="30" rows="3" name="p56"></textarea></div>
         <!--<div class="form-group"><label for="ipaddr">ipaddr :</label><input class="form-control" placeholder="Enter ipaddr" data-rule-maxlength="256" name="ipaddr" type="text" value=""></div>-->
         <!--<div class="form-group"><label for="stime">stime :</label><input class="form-control" placeholder="Enter stime" data-rule-maxlength="256" name="stime" type="text" value=""></div>-->
      </div>
   </div>
   <div class="modal-footer">
  
      <input class="btn btn-success btn-lg"   id="save" type="submit" value="Submit">
   </div>
</form>
          <!-- /.card -->

         

            <!-- /.card-header -->
            <div class="card-body p-0">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
 
@section('javascript')
<!-- jQuery -->
<script src="/dist/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)

</script>
<!-- Bootstrap 4 -->
<script src="/dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="/dist/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="/dist/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/dist/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/dist/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="/dist/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="/dist/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/dist/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/dist/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/dist/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/dist/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
<script type="text/javascript">
             function checkForm(form) // Submit button clicked
{
    
     var myButton = document.getElementById("save");
   
    myButton.disabled = true;
    myButton.value = "Please wait...";
     myButton.text = "Please wait...";
       setTimeout(function(){document.getElementById("save").disabled = false;document.getElementById("save").value = "Next";},3000);
    return true;
}
</script>
@stop