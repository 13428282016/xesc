<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable = 0">
    <meta name="csrf-token" content="{{csrf_token()}}"/>
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
        /* 弹出确认框 */
        .am-modal-hd {
            padding: 15px 10px 15px;
            font-size: 1.8rem;
            border-bottom: 1px solid #e0e0e0;
        }

        .am-modal-dialog {
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            border-radius: 15px;
        }
    </style>
</head>
<body>
<script>
	$.ajaxSetup({
	    headers:{
	    'X-CSRF-TOKEN':$('meta[name="csrf-token]').attr('content')
	    }
	})
	</script>
@yield('header')
@yield('content')
@yield('bottombar')
@yield('footer')



</body>
</html>