<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>
    <!-- META SECTION -->
    <title>LOGIN</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    {{--css--}}
    <link href="{{url('css/app.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="/css/template/theme-default.css"/>
    <!-- EOF CSS INCLUDE -->
    <style>
        .login-logo-title{
            color: white;
            font-size: 28px;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="login-container">

    <div class="login-box animated fadeInDown">
        <div class="login-logo-title">USER</div>
        <div class="login-body">
            <div class="login-title"><strong>Welcome </strong>, Please login</div>
            <form action="/login" class="form-horizontal" method="post">
                {{ csrf_field() }}
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" name="email" class="form-control" placeholder="Email" required/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="password" name="password" class="form-control" placeholder="Password" required minlength="1"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-info btn-block">Log In</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="login-footer">
            <div class="pull-left">
            </div>
            <div class="pull-right">
            </div>
        </div>
    </div>

</div>

</body>
</html>