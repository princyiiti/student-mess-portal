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
                        <h1 class="m-0 text-dark">Category Add</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <section class="content">
    <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">category</h3>
            </div>
            <form method="POST" action="{{ url('/admin/category') }}" >
            {{ csrf_field() }}
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Category Name</label>
                <input type="text" id="inputName" name="category" class="form-control">
              </div>
              
</div>
<div class="card-footer">
                  <button type="submit"  class="btn btn-primary">Submit</button>
                </div> 
            </form>
                      
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
    </section>
</div>
</div>
</div>
</div>
@endsection