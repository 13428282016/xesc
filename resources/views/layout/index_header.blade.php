@section("header")


    <style>
        .am-header {
            background-color: #ffffff;
            border-bottom: 1px solid #fd4548;
        }
    </style>

    <header data-am-widget="header" class="am-header am-header-fixed">
        <div class="am-header-left am-header-nav">
            <a href="#left-link" class="">
                <i class="am-header-icon am-icon-home" style="font-size: 25px"></i>
            </a>
        </div>
        <h1 class="am-header-title">
            <a href="#title-link" class="">小二上菜</a>
        </h1>
        <div class="am-header-right am-header-nav">
            <a href="#right-link" class="">
                <img src="{{asset('/image/frontend/dish_person.png')}}" style="height: 25px" alt=""/>
            </a>
        </div>
    </header>

    {{--<header class="am-topbar" style="margin-bottom: 0px">--}}
        {{--<div class="am-header-left am-header-nav">--}}
            {{--<a href="#left-link" class="">--}}
                {{--<i class="am-header-icon am-icon-home"></i>--}}
            {{--</a>--}}
        {{--</div>--}}
        {{--<h1 class="am-header-title">--}}
            {{--<a href="#title-link" class="">小儿上菜</a>--}}
        {{--</h1>--}}
        {{--<button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"--}}
                {{--data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span--}}
                    {{--class="am-icon-bars"></span></button>--}}

        {{--<div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">--}}
            {{--<ul class="am-nav am-nav-pills am-topbar-nav">--}}
                {{--<li class="am-active dish-menu-item">--}}
                    {{--<a href="#">首页</a>--}}
                {{--</li>--}}
                {{--<li class="dish-menu-item">--}}
                    {{--<a href="#">个人资料</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</header>--}}

@endsection