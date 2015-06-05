
@section('header')

    <style>
        .am-header {
            background-color: #ffffff;
            border-bottom: 1px solid #fd4548;
            margin-bottom: 10px;
        }
        .am-header .am-header-title a {
            color: #333333;
        }
    </style>

    <header data-am-widget="header" class="am-header am-header-fixed">
        <div class="am-header-left am-header-nav">
            <a id="back"  class="" style="cursor: pointer" onclick="history.go(-1)">
                <img src="{{asset('/image/frontend/orderconfirm_left_yellow_arrow.png')}}">
            </a>

        </div>
        <h1 class="am-header-title">
            <a href="#title-link" class="">{{$title}}</a>
        </h1>

    </header>


@endsection