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
                    <h1 class="m-0 text-dark">Create Rebate</h1>
                  </div><!-- /.col -->                  
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            </div>
               <section class="content">
              <div class="container">
<div class="card card-primary">
                <div class="card">
                    <div class="card-header">Create Rebate</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/rebate') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
                         @if (Session::has('flash_message'))
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('flash_message') }}</p>
                    </div>
                @endif

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" id="myform1" action="{{ url('/admin/rebate') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.Rebate.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
              </div>
            </section>
</div>
            </div>
        </div>
    </div>
    <!-- <script>
     $('#from_date').on('click', function () {
        $('#to_date').datepicker('option', 'minDate', new Date(dateText));
     });
     $('#to_date').on('click', function () {
        $('#from_date').datepicker('option', 'minDate', new Date(dateText));
     });
     </script> -->
@endsection
