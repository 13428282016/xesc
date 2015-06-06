@extends('layout.index')

@section('content')

    <style>

        .am-container {
            padding-top: 10px;
        }
        .am-header {
            background-color: #ffffff;
            border-bottom: 1px solid #fd4548;
            margin-bottom: 10px;

        }
        .am-header .am-header-title a {
            color: #333333;
        }

        div.am-container>.orders{
            padding: 5px 10px;
            margin: 10px 0px;
            background-color: #ffffff;
            border-bottom: 1px solid #efefef;
            border-radius: 15px;
            height: 100px;
        }

        .order-header {
            border-bottom: 1px solid #e0e0e0;
            line-height: 30px;
            padding-bottom: 5px;
        }

        .order-header .status {
            color: #ff2828;
            float: right;
        }

        .dishes {
            padding-top: 6px;
            line-height: 40px;
            overflow: hidden;

        }
        .dishes > img {
            margin-right: 5px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
        }

        .dishes .dishes-img {
            float: left;
        }

        .dishes .right-arrow {
            float: right;
        }

        .no-order-icon,.no-orders,.reminder-notes {
            text-align: center;
        }

        .no-order-icon {
            margin-top: 20%;
        }

        .no-orders {
            margin-top: 20px;
            color: #333333;
        }

        .reminder-notes {
            margin-top: 10px;
            color: #808080;
        }

    </style>

    <header data-am-widget="header" class="am-header am-header-fixed">
        <div class="am-header-left am-header-nav">
            <a id="back" href="\" style="cursor: pointer" >
                <img src="{{asset('/image/frontend/orderconfirm_left_yellow_arrow.png')}}">
            </a>

        </div>
        <h1 class="am-header-title">
            <a href="#title-link" class="">{{$title}}</a>
        </h1>

    </header>

    <div class="am-container">


        @if($orderinfos)

            @foreach($orderinfos as $orderinfo)
            <div class="am-g orders">
                <div class="order-header">
                    <span class="created-time">{{$orderinfo['created_at']}}</span>
                    <span class="status">
                        {{$orderinfo->orderStatus($orderinfo['status'])}}
                    </span>
                </div>
                <a href="/order/order-details-view?order_id={{$orderinfo['id']}}">
                <div class="dishes">
                    <div class="dishes-img">
                    @foreach($orderinfo["dishes"] as $dish)
                        <img height="45" src="{{asset('/image/frontend/dish_paigu.png')}}">
                    @endforeach
                    </div>
                    <span class="right-arrow"> <img width="9" src="{{asset('/image/frontend/orderconfirm_right_gray_arrow.png')}}"></span>
                </div>
                </a>
            </div>
            @endforeach

        @else

            <div class="no-order-icon">
                <img width="40" src="{{asset('/image/frontend/order_list_no_order.png')}}">
            </div>
            <div class="no-orders">
                还没点餐哦
            </div>
            <div class="reminder-notes">
                快去找小二下单吧
            </div>
        @endif

    </div>

@endsection