<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable = 0">
    <title>小二上菜</title>

    <!-- CSS -->
    <link href="{{ asset('/css/amazeui.min.css') }}" rel="stylesheet">

    <!-- JS -->
    <script src="{{asset('/js/lib/jquery/jquery-2.1.4.min.js')}}"></script>
    <script src="{{asset('/js/lib/amazeui/amazeui.min.js')}}"></script>
    <script src="{{asset('/js/lib/amazeui/handlebars.min.js')}}"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body {
            background: url('{{asset('/image/frontend/index_background_img.png')}}') repeat ;
        }
    </style>
</head>
<body>

@yield('header')
@yield('content')
@yield('bottombar')
@yield('footer')



</body>
</html>