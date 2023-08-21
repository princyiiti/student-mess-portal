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
            <li class="breadcrumb-item active">Dashboard Academic</li>
          </ol>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container">
      <!-- Small boxes (Stat box) -->
      <h1 style="text-align: center;"></h1>
   
        Dear Student,<br>
           <p>
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
     <div class="row">
    
  
        <table id="example1" class="table table-bordered">
    <thead>
    <tr class="success">
      <td>Course Code</td>
      <td>Faculty  Name</td>
    </tr>
    @foreach($student_curr_course_new as $val)

    <tr>
      <td>{{ $val->crsecode}}</td>
      <td>
      
        <div class="row">
       @foreach(App\User::viewdata($val->crsecode) as $valstu)
         @if($valstu->name!='')
<div class="col-md-3">
 <form id="myform1" method="POST" action="{{ url('/feedbackallocation') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
{{ csrf_field() }}
<input type="hidden" name='crsecode' value="{{$val->crsecode}}">
<input type="hidden" name='facultyname' value="{{$valstu->facultyname}}">
@if(App\User::checkdata($valstu->facultyname,$val->crsecode))
<a  class="btn btn-success" value="{{$valstu->facultyname}}" style="color: white">{{$valstu->name}}</a> 
@else
<button type="submit"  class="btn btn-primary" value="{{$valstu->facultyname}}">{{$valstu->name}}</button> 
@endif
 </form>
</div>
@endif
@endforeach
</div>
      </td>
    </tr>
    @endforeach
  </thead>
  </table>

        </section><!-- /.content -->
          <!-- /.card -->

          <!-- Calendar -->
          
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
@stop