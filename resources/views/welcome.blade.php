<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>IT4371</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;

                width: 100%;
                background: url("/images/bg.png") no-repeat;
                background-size: 100% 100%;
                position: relative;
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
                background-color: rgba(0,0,0,0.5);
                width: 500px;
                height: auto;
                padding: 20px 20px 40px 20px;
                border-radius: 5px;
            }

            .title {
                font-size: 65px;
                color: white;
                font-weight: 600;
            }

            .links > a {
                color: white;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                cursor: pointer;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    My Internet Banking
                </div>

                <div class="links">
                    <a href="/home">Customer</a>
                    <a href="/staff/home">Staff</a>
                    <a href="/admin/home">Admin</a>
                </div>
            </div>
        </div>
    </body>
</html>
