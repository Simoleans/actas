<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PDF</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Icon 16x16 -->
   <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
   {{--  <link rel="stylesheet" type="text/css" href="{{asset('css/AdminLTE.min.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/glyphicons.css')}}">

  </head>
  <body class="" style="background-color: #fff;">
    <div class="wrapper">
     {{--  <header class="">
        <center>
          <img src="{{ asset('img/encabezado.png') }}" width="1200" class="img-responsive">
        </center>
      </header> --}}

      <div class="content-wrapper">
        <section class="content">
        	@yield('content')
        </section>
      </div>
      
    </div>
    
  
    
  </body>
</html>