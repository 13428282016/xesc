@extends('layout.index')
@extends('layout.header')

@section('content')

    <style>

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

        .dishes .right-arrow {
            float: right;
        }
        /*.dishes>div {*/
            /*display: inline-block;*/
        /*}*/

    </style>

    <div class="am-container">


        @if($orderinfos)

            @foreach($orderinfos as $orderinfo)
            <div class="am-g orders">
                <div class="order-header">
                    <span class="created-time">{{$orderinfo['created_at']}}</span>
                    <span class="status">{{$orderinfo['status']}}</span>
                </div>
                <div class="dishes">
                    <div class="dishes-img">

                    <nobr>
                    @foreach($orderinfo["dishes"] as $dish)

                        <img height="45" src="{{asset('/image/frontend/dish_paigu.png')}}">

                    @endforeach
                    </nobr>
                    </div>
                    {{--<div class="arrow-icon">--}}
                        <span class="right-arrow"> <img width="9" src="{{asset('/image/frontend/orderconfirm_right_gray_arrow.png')}}"></span>
                    {{--</div>--}}
                </div>
            </div>
            @endforeach

        @else


        @endif

    </div>

@endsection