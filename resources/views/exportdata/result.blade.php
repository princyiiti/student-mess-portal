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
<th>Program</th>
                                        <th>Admission Year</th>
                                         <!-- <th>#</th> -->
                                        <th>Current Academic Year</th>
                                        <!-- <th>Student Group</th> -->

                                        <!-- <th>Acadsem</th>
                                        <th>Acadyear</th> -->
                                         <!-- <th> Department</th> -->
                                         <th>Current Academic Sem</th>
                                          <th>Roll no (Grade Result)</th>
                                        <th>Current Credit (Grade Result)</th>
                                           <th>Current Grade Point (Grade Result)</th>
                                           <th>SPI (Grade Result)</th>
                                           <th>Total Credit Registered (Grade Result)</th>
                                           <th>Total Grade Point (Grade Result)</th>
                                           <th>CPI (Grade Result)</th>
                                           <th>Minor Current credit (Grade Result)</th>
                                           <th>Minor Current Grade Point (Grade Result)</th>
                                           <th>MSPI (Grade Result)</th>
                                           <th>Minor Total Credit Registered (Grade Result)</th>
                                           <th>Minor Total Grade Point (Grade Result)</th>
                                           <th>MCPI (Grade Result)</th>
                                           <th>Year (Grade Result)</th>
                                          
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($studentcourse as $item)
                                    <tr>   
                                    @if($loop->iteration==1)                                   
                                        <td>{{ $item->program }}</td>
                                        <td>{{ $item->batchyear }}</td>
                                       <td>{{ $item->acadyear }}</td>
                                        <td>{{ $item->acadyear }} ({{ $item->acadsem }})</td>
                                           
                                  @else
                                  <td></td><td></td><td></td><td></td>
                                  @endif
  

                                      <td>{{ $item->rollno }}</td>                              
                                       
                                        <td>{{ $item->semcredits }}</td>
                                         <td>{{ $item->semgradepts }}</td>
                                         <td>{{ $item->spi }}</td>

                                       <td>{{ $item->totcredits }}</td>
                                       <td>{{ $item->totgradepts }}</td>
                                        <td>{{ $item->cpi }}</td>
                                      
                                      <td>{{ $item->msemcredits }}</td>
                                      <td>{{ $item->msemgradepts }}</td>
                                      <td>{{ $item->mspi }}</td>

                                      <td>{{ $item->mtotcredits }}</td>
                                      <td>{{ $item->mtotgradepts }}</td>
                                      <td>{{ $item->mcpi }}</td>
                                      <td>{{ $item->curryear }}</td>
                                      
                                    </tr>
                                   

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
        bPaginate: false,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
    </script>
@endsection
