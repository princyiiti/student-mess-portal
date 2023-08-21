<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content={{csrf_token()}}>

    <title>IIT Indore Project MMS</title>
    <link rel="stylesheet" href="{{asset('/css/app.css')}}"></link>
    <link rel="stylesheet" type="text/css" href="http://iiti.ac.in/images/favicon.ico">
    <link rel="icon" href="http://iiti.ac.in/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('/dist/plugins/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/dist/css/adminlte.min.css')}}">
    <!-- iCheck -->
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <!-- bootstrap wysihtml5 - text editor -->
  
    
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body class="hold-transition sidebar-mini">
    @guest @yield('content') @else
    <div class="wrapper" id="app">
     
        <!-- Header -->
    @include('layouts.header')
        <!-- Sidebar -->
  
    @yield('content')
        <!-- Footer -->
    @include('layouts.footer')
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
<script src="{{asset('/dist/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('/dist/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{asset('/dist/js/adminlte.js')}}"></script>
<script src="{{asset('/dist/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->


<!-- OPTIONAL SCRIPTS -->

    @section('javascript')
    <script>
            var form = $("#myform1");
            $.validate({
                form: '#myform1'
            })
            $(document).ready(function() {
                $('#datatable').DataTable();
            } );
        </script>
@stop
    @endguest @yield('javascript')
    
</body>
</html>