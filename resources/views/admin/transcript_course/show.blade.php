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
                    <h1 class="m-0 text-dark">Feedback_allocation </h1>
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
                    <div class="card-header">Feedback_allocation {{ $feedback_allocation->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/feedback_allocation') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/feedback_allocation/' . $feedback_allocation->id . '/edit') }}" title="Edit Feedback_allocation"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/feedback_allocation' . '/' . $feedback_allocation->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Feedback_allocation" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $feedback_allocation->id }}</td>
                                    </tr>
                                    <tr><th> Crsecode </th><td> {{ $feedback_allocation->crsecode }} </td></tr><tr><th> Acadsem </th><td> {{ $feedback_allocation->acadsem }} </td></tr><tr><th> Acadyear </th><td> {{ $feedback_allocation->acadyear }} </td></tr>
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
