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
                    <h1 class="m-0 text-dark">Create Fee Structure</h1>
                  </div><!-- /.col -->                  
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            </div>
               <section class="content">
              <div class="container-fluid">
<div class="card card-primary">
                <div class="card">
                    <div class="card-header">Create Fee Structure</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/feestructure') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
<!-- <?php print_r($errors);?> -->
@if (session('repeted'))
    <div class="alert alert-danger">
        {{ session('repeted') }}
    </div>
@endif
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" id="myform1" action="{{ url('/admin/feestructure') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.Feestructure.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
              </div>
            </section>
</div>
            </div>
        </div>
    </div>
@endsection
