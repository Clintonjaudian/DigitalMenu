<!DOCTYPE html>
<html lang="en">
<head>
   @include('layouts.plugins.css')
  <style>
    .box
    {
     width:100%;
     max-width:600px;
     background-color:#f9f9f9;
     border:1px solid #ccc;
     border-radius:5px;
     padding:16px;
     margin:0 auto;
    }
    input.parsley-success,
    select.parsley-success,
    textarea.parsley-success {
      color: #468847;
      background-color: #ecf1ea;
      border: 1px solid #D6E9C6;
    }
  
    input.parsley-error,
    select.parsley-error,
    textarea.parsley-error {
      color: #B94A48;
      background-color: #fbf3f3;
      border: 1px solid #ef435c;
    }
  
    .parsley-errors-list {
      margin: 2px 0 3px;
      padding: 0;
      list-style-type: none;
      font-size: 0.9em;
      line-height: 0.9em;
      opacity: 0;
  
      transition: all .3s ease-in;
      -o-transition: all .3s ease-in;
      -moz-transition: all .3s ease-in;
      -webkit-transition: all .3s ease-in;
    }
  
    .parsley-errors-list.filled {
      opacity: 1;
    }
    
    .parsley-type, .parsley-required, .parsley-equalto, .parsley-pattern, .parsley-length{
     color:#ff0000;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('layouts.backend.partials.navbar')
        @include('layouts.backend.partials.sidebar')
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <main class="py-4">
          @yield('content')
          </main>
        </div>
        <!-- /.content-wrapper -->
    
        @include('layouts.backend.partials.footer')      
    </div>
    <!-- ./wrapper -->
    
    @include('layouts.plugins.js')
</body>
</html>