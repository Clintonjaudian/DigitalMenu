<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('app.name', 'Template')}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Bootstrap 4.4.1 -->
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-4.4/css/bootstrap.min.css')}}">
     <!-- Animate CSS -->
     <link rel="stylesheet" href="{{asset('assets/plugins/animation-css/animate.css')}}">
     <!-- Waypoints -->
     <link rel="stylesheet" href="{{asset('assets/plugins/waypoints/css/waypoints.css')}}">

    @stack('css')
  
</head>
<body>
    
    <section class="content">
        <div class="container-fluid">
         
         @yield('content')
    
        </div><!-- /.container-fluid -->
      </section>
    
    <!-- jQuery -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/plugins/bootstrap-4.4/js/bootstrap.min.js')}}"></script>
    <!-- Waypoints -->
    <script src="{{asset('assets/plugins/waypoints/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/plugins/waypoints/js/waypoints.js')}}"></script>

    @stack('js')
</body>
</html>