<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Feedback Academic IIT Indore</title>
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .header {
    padding-top: 10px;
    color: #122f53;
    font-size: 35px;
}
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <!-- <a href="{{ route('login') }}">Login</a> -->
                        <!-- <a href="{{ route('register') }}">Register</a> -->
                    @endauth
                </div>
            @endif
   
            <div class="content">
                 <img src="https://www.iiti.ac.in/public/themes/iitindore/demos/update-logo.png" alt="IITI" 

                                                     style="opacity: .8;    height: 114px;">
                <div class="header">

                भारतीय प्रौद्योगिकी संस्थान इंदौर
                <br>
             Indian Institute of Technology Indore
               <br>
              
                <br>
              Academic
                
            </div>
                <div class="title m-b-md">
                 
                </div>
  
            <div class="social-auth-links text-center mb-3">
          
               <!--  <a href="{{ url('/redirect') }}" class="btn btn-block btn-primary">Login With Google</a>-->
       
            </div>
             <!--  <div class="links">
                    <a href="{{ route('login') }}">Login</a>                    
                </div>  -->
            </div>
        </div>
    </body>
</html>
