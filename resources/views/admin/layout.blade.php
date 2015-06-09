<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}"/>
    <title>Laravel</title>
    <!-- JS -->
    <script src="{{asset('/js/lib/jquery/jquery-2.1.4.min.js')}}"></script>
    <link href="{{asset('css/app.css')}} " rel="stylesheet">

</head>
<body>




@yield('content')
<script>
	$.ajaxSetup({
	    headers:{
	    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
	    }
	})
	</script>



</body>
</html>