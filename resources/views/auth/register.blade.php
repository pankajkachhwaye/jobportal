<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Job Portal</title>
    <!-- Favicon-->
    <link rel="icon" href="{{URL::asset('public/favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{URL::asset('public/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{URL::asset('public/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{URL::asset('public/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{URL::asset('public/css/style.css')}}" rel="stylesheet">
</head>

<body class="login-page">
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);">JOB<b>PORTAL</b></a>
        {{--<small>Admin BootStrap Based - Material Design</small>--}}
    </div>
    <div class="card">
        <div class="body">
            <div class="msg">Sign in to start your session</div>

        <form id="sign_in" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

            <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                <div class="form-line">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                </div>
                @if ($errors->has('name'))
                    <label id="username-error" class="error" for="username">{{ $errors->first('name') }}</label>
                @endif
            </div>

            <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                <div class="form-line">
                    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                </div>
                @if ($errors->has('email'))
                    <label id="username-error" class="error" for="username">{{ $errors->first('email') }}</label>
                @endif
            </div>

            <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                <div class="form-line">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                @if ($errors->has('password'))
                    <label id="username-error" class="error" for="username">{{ $errors->first('password') }}</label>
                @endif
            </div>



            <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                <div class="form-line">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>
            <div class="form-group">
                <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
            </div>

            <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP</button>

            <div class="m-t-25 m-b--5 align-center">
                <a href="{{ url('/login') }}">You already have a membership?</a>
            </div>


                    </form>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="{{URL::asset('public/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap Core Js -->
<script src="{{URL::asset('public/plugins/bootstrap/js/bootstrap.js')}}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{URL::asset('public/plugins/node-waves/waves.js')}}"></script>

<!-- Validation Plugin Js -->
<script src="{{URL::asset('public/plugins/jquery-validation/jquery.validate.js')}}"></script>

<!-- Custom Js -->
<script src="{{URL::asset('public/js/admin.js')}}"></script>
<script src="{{URL::asset('public/js/pages/examples/sign-in.js')}}"></script>
</body>

</html>