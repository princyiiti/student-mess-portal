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
                        <h1 class="m-0 text-dark">Category List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v2</li>
                        </ol>
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
                    <div class="card-header">Category</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/category/create') }}" class="btn btn-success btn-sm" title="Add New Brand">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add Category
                        </a>

                        <form method="GET" action="{{ url('/admin/category') }}" accept-charset="UTF-8"
                            class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..."
                                    value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br />

                        <br />
                        @if (Session::has('flash_message'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('flash_message') }}</p>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th> Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($category)
                                @foreach($category as $list)
                                  <tr>
                                    <td>{{$list->id}}</td>
                                    <td>{{$list->category}}</td>
                                    <td>
                                  
                                  
                                    {{ Form::open(array('url' => 'admin/category/' . $list->id, 'class' => 'pull-left')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this category', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}
                                  </td>
                                  </tr>
                                @endforeach
                                @endif
                                </tbody>

                            </table>
                            <div class="pagination-wrapper"> </div>
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
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
$(document).ready(function() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(".designations").change(function(e) {
        var designation_id = this.value;
        var uid = $(this).attr('data-id');

        $.ajax({
            /* the route pointing to the post function */
            url: 'updateajax',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {
                _token: CSRF_TOKEN,
                designation_id: designation_id,
                id: uid
            },
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function(data) {
                // $(".writeinfo").append(data.msg); 
            }
        });
    });
    $(".role").change(function(e) {
        var role_id = this.value;
        var uid = $(this).attr('data-id');

        $.ajax({
            /* the route pointing to the post function */
            url: 'updateajax',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {
                _token: CSRF_TOKEN,
                role_id: role_id,
                id: uid
            },
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function(data) {
                // $(".writeinfo").append(data.msg); 
            }
        });
    });

    $(".department").change(function(e) {
        var department_id = this.value;
        var uid = $(this).attr('data-id');

        $.ajax({
            /* the route pointing to the post function */
            url: 'updateajax',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {
                _token: CSRF_TOKEN,
                department_id: department_id,
                id: uid
            },
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function(data) {
                // $(".writeinfo").append(data.msg); 
            }
        });
    });
});
</script>