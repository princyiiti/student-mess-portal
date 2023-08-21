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
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Crsecode</th>
                                        <th>Acadsem</th>
                                        <th>Acadyear</th>
                                         <th> Department</th>
                                        <th>Faculty Username</th>
  <th>No. Feedback Students Response </th>
  <th>Total Registered Students</th>

                                        <th>No. Repeated Students </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($couse_listone as $item)
                                 <?php   $total = App\User::Totalstudent($item->crsecode,$item->acadyear, $item->acadsem,$item->facultyname);
                                      //  if($total>0){ 
                                            ?>
                                    <tr>

                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->crsecode }}</td>
                                        <td>{{ $item->acadsem }}</td>
                                        <td>{{ $item->acadyear }}</td>
                                        <td>{{ $item->dept }}</td>
                                        <td>{{ $item->facultyname }}</td>
                  <td> <?php echo $url = App\User::countdata($item->crsecode,$item->facultyname);             


              ?></td>
                    <td> <?php echo $total ?></td>
                    <td> <?php if($url>$total){
                    echo $url-$total;
                  }


              ?></td>
                                      
                                    </tr>
                                <?php //} ?>
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
@endsection
