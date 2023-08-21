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
                        <h1 class="m-0 text-dark"> Import Mess Subscription Data </h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card">
                    <div class="card-header"><a href="{{url('public/mess_data.csv')}}">Import Mess Subscription Data</a>
                    </div>
                    <div class="card-body">

                        <br />
                        <br />

                        @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif
                        <a href="{{url('public/mess_data.csv')}}">Sample File format Download</a>
                        <form method="POST" action="{{ url('/admin/user/uploadcsv') }}" accept-charset="UTF-8"
                            class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @if (Session::has('success'))
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                            @endif
                            @if (Session::has('notsuccess'))
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('notsuccess') }}</p>
                            </div>
                            @endif
                            <input type="file" name="import_file" accept=".csv, .xlsx" />
                            <button class="btn btn-primary">Import File</button>
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