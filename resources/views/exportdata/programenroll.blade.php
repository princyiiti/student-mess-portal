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
                                        <th>#</th>
                                        <th>Student</th>
<th>Program</th>
                                        <th>Academic Year</th>
                                         
                                        <th>Enrollment Date</th>
                                       
                                         <th>Academic Semester</th>
                                          
                                       
                                        <th>Course (Courses)</th>
                                        <th>Course Name (Courses)</th>
                                       <th>Course Name (Additional Learning Course)</th>
                                       <th>Course (Additional Learning Course)</th>
                                       <th>Course Name (Minor Course)</th>
                                       <th>Course (Minor Course)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($studentcourse as $item)
                                <?php $studentcourselist= $url = App\User::studentcurrent($item);?>
                              
                                @foreach($studentcourselist as $stuval)
                                      <tr>
                                        <td>{{$loop->iteration}}</td> 
                                        <td>
                                        @if($loop->iteration==1)
                                        {{ $stuval->rollno }}
                                          @endif
                                    </td>
                                        <td>
                                            @if($loop->iteration==1)
                                        {{$section}}
                                        @endif
                                    </td> 

                                        <!-- B.Tech. Section A First sem-2019-2019 (1) -->
                                      
                                         <td> @if($loop->iteration==1)
                                            {{ $item->acadyear }}
                                        @endif </td>
                                           <td> @if($loop->iteration==1)
                                           23-01-2023
                                       @endif</td>
 <!-- PH 105/B.Tech. Section A First sem/2023 (1) -->
  <td> @if($loop->iteration==1)
    {{ $item->acadyear }} ({{ $item->acadsem }})
@endif</td>


                                     
                                                                               
                                       
                                       
                                        @if($stuval->minor!='M'||$stuval->minor!='A')
                                         <td>{{ $stuval->crsecode }}</td>
                                          <td>
                                             <?php echo $studentcourselist=  App\User::coursename($stuval->crsecode);?>

                                            </td>
                                            <td></td>
                                       <td></td>
                                         @else
                                         <td></td>
                                       <td></td>
                                        <td>{{ $stuval->crsecode }}</td>
                                        <td>  <?php echo $studentcourselist=  App\User::coursename($stuval->crsecode);?>
                                        </td>
                                        @endif
                                        <td></td>
                                       <td></td>
                 
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
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
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
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
    </script>
@endsection
