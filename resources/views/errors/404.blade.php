<!DOCTYPE html>
<html>
    <head>
        <title>Be right back.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
            .title2 {
              font-size: 36px;
              margin-bottom: 40px;
            }
            
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <h3 class="title"><b>Error</b> : {{$message}}</h3>
                <div class="title2"><a href="{{url('/')}}">{{url('/')}}</a></div>
            </div>
        </div>
    </body>
</html>
