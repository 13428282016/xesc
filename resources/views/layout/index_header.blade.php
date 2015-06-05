@section("header")


    <style>
        .am-header {
            background-color: #ffffff;
            border-bottom: 1px solid #fd4548;
        }
        .am-offcanvas .am-offcanvas-bar {
            background-color: #ffffff;
            border: 0px;
        }
        .am-offcanvas-bar:after {
            background-color: #ffffff;
        }

        .am-offcanvas-content .avatar img {
            margin-top: 25px;
        }

        .am-offcanvas-content .avatar .username {
            color:#333;
        }

        .am-offcanvas-content .orders a, .am-offcanvas-content .addresses a {
            color: #808080;
        }

        .am-offcanvas-content>div {
            width: 100%;
        }

        .am-offcanvas-content .avatar .username,.am-offcanvas-content .orders, .am-offcanvas-content .addresses {
            line-height: 35px;
        }

        .am-offcanvas-content .orders, .am-offcanvas-content .addresses {
            font-size: 1.4rem;
            margin-bottom: 7px;
        }

        .am-offcanvas-content span img {
            margin-right: 15px;
        }
        hr {
           margin: 10px 0px;

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
            <a href="#right-link" class="" data-am-offcanvas="{target: '#doc-oc-demo3'}">
                <img src="{{asset('/image/frontend/dish_person.png')}}" style="height: 25px" alt=""/>
            </a>
        </div>

        <!-- 侧边栏内容 -->
        <div id="doc-oc-demo3" class="am-offcanvas">
            <div class="am-offcanvas-bar am-offcanvas-bar-flip" style="  width: 50%;">
                <div class="am-offcanvas-content">
                    <div class="avatar" align="center">

                        <img width="67" src="{{asset('/image/frontend/siderbar_person.png')}}">
                        <div class="username">
                            hello man
                        </div>

                    </div>
                    <hr />
                    <div class="orders">
                        <span><img width="25" src="{{asset('/image/frontend/siderbar_myaddresses.png')}}"><a href="/address/addresses-view">我的送餐地址</a></span>
                    </div>
                    <div class="addresses">
                        <span><img width="25" src="{{asset('/image/frontend/siderbar_myorders.png')}}"><a href="#">我的订单</a></span>
                    </div>
                </div>
            </div>
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