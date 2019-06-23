<!DOCTYPE html>
<html>
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/glyphicons.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="shortcut icon" href="{{asset('img/logo.png')}}">
  </head>
	<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
     <center><img class="img-responsive" src="{{ asset('img/logo.png') }}" alt="Logo" style="height:75px"></center>
	      <a href="#"><b>{{ config('app.name') }}</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Restablecer Contraseña</p>
      <form method="POST" action="{{ route('password.update') }}">
          @csrf

          <input type="hidden" name="token" value="{{$token}}">

          <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

              <div class="col-md-8">
                  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                  @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

              <div class="col-md-8">
                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                  @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group row">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Repetir Contraseña') }}</label>

              <div class="col-md-8">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>
          </div>

          <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                      {{ __('Guardar') }}
                  </button>
              </div>
          </div>
      </form>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
<script type="text/javascript" src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>
<script type="text/javascript">
	$(".rut").inputmask({
            mask: "9[9.999.999]-[9|K|k]",
          });

        $(".tlf").inputmask({
            mask: "[9-9999-9999]",
          });
</script>
</body>
</html>
