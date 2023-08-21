@extends('layouts.master') 
@section('content')
<div class="login-box">
    <div class="login-logo">
  IIT Indore<br>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{ __('Login') }}</p>

            <form action="{{ route('login') }}" method="post">
                @csrf
              @if ($errors->has('email'))
              <div class="alert alert-danger">                       
                                        {{ $errors->first('email') }}                                    
              </div>@endif
                <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                        <span class="fa fa-envelope input-group-text"></span> @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    <div class="input-group-append">
                        <span class="fa fa-lock input-group-text"></span>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="checkbox icheck">
                            <label>
                <input type="checkbox"> Remember Me
              </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                  <!-- <a href="{{ url('/redirect') }}" class="btn btn-block btn-primary">Login With Google</a> -->
                <a href="{{ url('/redirect') }}" class="btn btn-block btn-primary">Click Here login with institute email id</a>
       
            </div>
            <!-- /.social-auth-links -->

            {{--<p class="mb-1">
                <a href="#">I forgot my password</a>
            </p>
              <p class="mb-0">
                <a href="{{route('register')}}" class="text-center">Register a new membership</a>
            </p>  --}}
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
@endsection