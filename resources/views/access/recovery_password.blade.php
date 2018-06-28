<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BEGAMES</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/assets/custom.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="brainy-bg-style" style="display:flex;">
<div class="login-boxer">
    <div class="text-center">
        <img src="#" alt="BEGAMES" width="60%">
        <p class="login-boxer-p">BEGAMES</p>
    </div>
    <div class="login-box">
        <div class="row">
            <div class="col-md-12">
                @include('template._success')
            </div>
        </div>
        <div class="login-box-title">
            <h3>Recuperar Contraseña</h3>
        </div>
        <div class="login-box-body">

            <div class="text-center">
                <p class="login-box-msg">Ingrese su email y le enviaremos un código para restablecer su contraseña.</p>
            </div>

            <form action="{{ route('login.recovery-password') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group has-feedback {{ $errors->has('pin') ? 'has-error':'' }}">
                    <input type="text" maxlength="4" class="form-control" placeholder="Código PIN" name="pin"
                           value="{{ old('pin') ? old('pin') :'' }}">
                    <span class="glyphicon glyphicon-th form-control-feedback"></span>
                    {!! $errors->first('pin','<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error':'' }}">
                    <input type="email" class="form-control" placeholder="Email" name="email"
                           value="{{ old('email') ? old('email') :'' }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    {!! $errors->first('email','<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error':'' }}">
                    <input type="password" class="form-control" placeholder="Contraseña" name="password" value="{{ old('password') ? old('password') :'' }}" >
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    {!! $errors->first('password','<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error':'' }}">
                    <input type="password" class="form-control" placeholder="Repita Contraseña" name="password_confirmation">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    {!! $errors->first('password_confirmation','<span class="help-block">:message</span>') !!}
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <a href="{{ route('login.show') }}" class="">Iniciar Sesión</a>
                    </div>
                    <div class="col-xs-6">
                        <button type="submit" class="btn btn-primary btn-block">Cambiar Contraseña</button>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>
