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
                        <h1 class="m-0 text-dark"> Structure</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card">
                    <div class="card-header">Edit Structure</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/feestructure') }}" title="Back"><button
                                class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back</button></a>
                        <br />
                        <br />
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

                       

                        <form method="POST" id="myform1" action="{{ url('/admin/feestructure/') }}/{{$feestructure->id}}"
                            accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.Feestructure.form_update', ['formMode' => 'update'])

                        </form>
                    

                    </div>
                </div>
            </div>
    </section>
</div>
<script>
$(".feeamount").focusout(function() {
    var sum = 0;
    $(".feeamount").each(function() {
        if (!isNaN(this.value) && this.value.length != 0) {
            sum += parseFloat(this.value);
        }
    });

    $('#totalamount').val(sum);
});
</script>
@endsection