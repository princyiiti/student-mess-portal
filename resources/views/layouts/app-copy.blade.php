<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content={{csrf_token()}}>
    <title>Student Portal </title>
    <link rel="stylesheet" href="{{asset('/css/core.css')}}">
    </link>
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    </link>
    <link rel="stylesheet" href="{{asset('/dist/plugins/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('/dist/plugins/select2/select2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/dist/css/adminlte.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('/dist/plugins/iCheck/flat/blue.css')}}">
    <!-- Morris chart -->
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('dist/plugins/fontawesome-free/css/all.min.css')}}">
    </link>
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('/dist/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
    <!-- Date Picker -->
    <!-- <link rel="stylesheet" href="{{asset('/dist/plugins/datepicker/datepicker3.css')}}"> -->
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('/dist/plugins/daterangepicker/daterangepicker-bs3.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <script src="{{ asset('/dist/plugins/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/dist/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('/dist/plugins/datepicker/datepicker3.css')}}">

    <style>
    .table.dataTable tbody tr {
        background-color: #ffffff;
        color: #1f2d3d;
        font-weight: 600;
        font-size: medium;
    }

    .buttons-html5 {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
        /* background-image: linear-gradient(to bottom, #fff 0%, #007bff 100%) !important; */
    }

    .paginate_button {
        /* background: linear-gradient(to bottom, #fff 0%, #007bff 100%) !important; */
        border: 1px solid #007bff;

    }

    .buttons-print {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
        background-image: linear-gradient(to bottom, #fff 0%, #007bff 100%) !important;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">
        <!-- Header -->
        @include('layouts.header')
        <!-- Sidebar -->
        @if(auth()->user()->role_id==1)
        @include('layouts.sidebaradmin')
        @elseif(auth()->user()->role_id==5)
        @include('layouts.sidebarstoreuser')
        @elseif(auth()->user()->role_id==6)
        @include('layouts.sidebarmms')
        @elseif(auth()->user()->role_id==2)
        @include('layouts.sidebarmms')
        @elseif(auth()->user()->role_id==4)
        @include('layouts.sidebarfinance') 
         @elseif(auth()->user()->role_id==7)
        @include('layouts.sidebarfaculty')   
         @elseif(auth()->user()->role_id==8)
        @include('layouts.sidebarhod') 
         @elseif(auth()->user()->role_id==9)
        @include('layouts.sidebaracademic') 
        @else

        @include('layouts.sidebar')

        @endif
        @yield('content')
        <!-- Footer -->
        @include('layouts.footer')
    </div>
    <script src="{{asset('/dist/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/dist/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('/dist/js/adminlte.js')}}"></script>
    <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

        <!-- OPTIONAL SCRIPTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" type="text/javascript"></script>

    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> -->
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>   -->
  
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<!-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> -->
    
    <!--- export,psd,print -->
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script>
    function getuserdatafun() {

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{url(' / getuserdata ')}}',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {
                _token: CSRF_TOKEN
            },
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function(data) {
                $("#usernoti").html(data.html);
            }
        });
    }

    function viewnotication() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{url(' / updatenoti ')}}',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {
                _token: CSRF_TOKEN
            },
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function(data) {

            }
        });
    }
    </script>
    <script>
    $(function() {
        //Initialize Select2 Elements
        //$('.select2').select2()
    });
    var form = $("#myform1");
    $.validate({
        form: '#myform1',
        submitHandler: function(form) {
            // do other things for a valid form

            form.submit();
        }
    })
    $(document).ready(function() {
        // $('#datatable').DataTable();
    });
    </script>
  
    <script type="text/javascript">
    //alert(maxBirthdayDate);
    $(function() {
        $(".dateclass").datepicker({
            //changeMonth: true,
            changeYear: true,
             minDate: 2,
            dateFormat: 'mm/dd/yy',
            //changeMonth: true,
            changeYear: true,
            yearRange: '2023:2023',

        }).on('change', function() {

        });
    });
    </script>
    <script type="text/javascript">
    $(function() {
        $(".dateclassrebate").datepicker({
            //changeMonth: true,
             maxDate: 2,
            // data-date-start-date="2d",
            changeYear: true,
            dateFormat: 'mm/dd/yy',
            //changeMonth: true,
            changeYear: true,
            yearRange: '2023:2023',

        }).on('change', function() {
        });
    });
    </script>

</body>

</html>