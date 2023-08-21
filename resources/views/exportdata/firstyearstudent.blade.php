@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css"></link>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css"></link>
@section('content')
   <div class="content-wrapper" style="min-height: 543px;">
        <!-- Content Header (Page header) -->       
            <!-- Content Header (Page header) -->
            <div class="card card-primary">
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Feedback_allocation</h1>
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
                    <div class="card-header">Feedback_allocation</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/feedback_allocation/create') }}" class="btn btn-success btn-sm" title="Add New Feedback_allocation">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/feedback_allocation') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table" id="example">
                                <thead>
                                    <tr>
<th>Student Name (Student Score)</th>
                                        <th>plan</th>
                                         <!-- <th>#</th> -->
                                        <th>student_group (Student Score)</th>
                                        <!-- <th>Student Group</th> -->

                                        <!-- <th>Acadsem</th>
                                        <th>Acadyear</th> -->
                                         <!-- <th> Department</th> -->
                                         <th>coursecode (Student Score)</th>
                                          <th>crsecode Name</th>
                                        <th>Credit (Student Score)</th>
                                        <th>Grade Scale (Student Score)</th>
                                         <th>Current course credit (Student Score)</th>
                                         <th>Grade Point (Student Score)</th>
                                           <th>student_group (Student Score)</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($studentcourse as $item)
                                <?php $studentcourselist= $url = App\User::trancourse($item);?>
                              
                                @foreach($studentcourselist as $stuval)
                                      <tr>
                                        <td>{{ $item->rollno }}</td> 
                                        <!-- B.Tech. Section A First sem-2019-2019 (1) -->
                                      
                                         <td>{{$program[$item->dept]}}-{{ $item->acadyear }}-{{ $item->acadyear }}({{ $item->acadsem }})</td>
                                           
 <!-- PH 105/B.Tech. Section A First sem/2023 (1) -->
  <td>{{ $stuval->crsecode }}/{{$program[$item->dept]}}/{{ $item->acadyear }}({{ $item->acadsem }})</td>


                                     
                                                                               
                                       
                                        <td>{{ $stuval->crsecode }}</td>
                                         <td>{{ $stuval->crsename }}</td>
                                         <td>{{ $stuval->credit }}</td>
                                       <td>{{ $stuval->grade }}</td>
                                       <td>
                                             <?php echo $grade_point= $url = App\User::previousFRcheck($item,$stuval);?>
                                           
                                       </td>
                                       <td>
                                         <?php $grade_point= $url = App\User::gradepoint($stuval->grade);?>
                                        <?php echo $grade_point->gradpoint*$stuval->credit?></td>
                                         <td>{{ $stuval->crsecode }}/{{$program[$item->dept]}}/{{ $item->acadyear }}({{ $item->acadsem }})</td>                 
                                    </tr>
                                     @endforeach

                                @endforeach
                                </tbody>
                            </table>
                          
                        </div>

                    </div>
                </div>
                </div>
                           </section>
</div>
            </div>
        </div>
    </div>
   
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script>
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        bSort: false,
        bPaginate: false,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
    </script>
@endsection
