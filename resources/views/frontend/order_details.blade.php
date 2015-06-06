@extends('layout.index')

@section('content')

    <style>
        div.am-container>.am-g{
            padding: 5px 10px;
            margin: 10px 0px;
            background-color: #ffffff;
            border-radius: 15px;
        }
        .am-header {
            background-color: #ffffff;
            border-bottom: 1px solid #fd4548;
            margin-bottom: 10px;
        }
        .am-header .am-header-title a {
            color: #333333;
        }

        .order-status img{
            margin: 3%;
        }
        .order-status .notes>span{
            font-size: 14px;
            color: #FCC315;
        }

        .am-navbar .am-navbar-nav .am-btn {
            color: #ffffff;
            line-height: 35px;
        }

        .am-navbar .am-navbar-nav .am-btn img {
            display: inline-block;
            width: 16px;
            height: 16px;
            vertical-align: text-top;
            margin: 3px 10px 0px 0px;
        }

        .am-navbar .am-navbar-nav .background {
            position: absolute;left: -1px;width: 101%;z-index: -1;
        }

        .order-details-info .info p {
            margin: 0px;
            color: #808080;
            padding-bottom: 5px;
            font-size: 14px;
        }

        .order-details-info .title {
            border-bottom: 1px solid #e0e0e0;
            padding: 5px 0px;
            margin-bottom: 5px;
        }


        .dishes {
            padding: 0px 10px;
        }

        .dishes .dish {
            height: 40px;
            line-height: 40px;
            padding: 0px ;
            border-bottom: 1px solid #e0e0e0;
            margin: 0px;
        }


        .dishes .total-price {
            padding: 5px 0px;
            margin: 0px;
        }

        .dishes .total-price .value {
            color: #ff2828;
            float: right;
        }

        [class*=am-u-] {
            padding: 0px 6px 0px 0px;
        }


        /* 弹出确认框 */
        .am-modal-hd {
            padding: 15px 10px 15px;
            font-size: 1.8rem;
            border-bottom: 1px solid #e0e0e0;
        }
        
        #confirm_recv .am-modal-dialog {
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            border-radius: 15px;
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
        <div class="am-header-right am-header-nav">
            <a href="tel:13318342850" class="">
                <img src="{{asset('/image/frontend/order_details_phone.png')}}" style="height: 25px" alt=""/>
            </a>
        </div>

    </header>

    <div class="am-container">

        <div class="am-g order-status">

            <div align="center">
                @if($orderinfo['status'] == 1)
                    <img width="94%" src="{{asset('/image/frontend/order_details_submit_order.png')}}">
                @elseif($orderinfo['status'] == 2)
                    <img width="94%" src="{{asset('/image/frontend/order_details_confirm_order.png')}}">

                @elseif($orderinfo['status'] == 3)
                    <img width="94%" src="{{asset('/image/frontend/order_details_delivering.png')}}">

                @else
                    <img width="94%" src="{{asset('/image/frontend/order_details_recieved.png')}}">

                @endif
            </div>

        </div>

        <div class="am-g order-details-info">

            <div class="title">订单详情</div>
            <div class="info">
                <p>订单编号: {{$orderinfo['order_no']}}</p>
                <p>下单时间: {{$orderinfo['created_at']}}</p>
                <p>支付方式: {{$orderinfo->orderPaytype($orderinfo['pay_type'])}}</p>
                <p>手机号码: {{$orderinfo['recv_cellphone']}}</p>
                <p>收餐地址: {{$orderinfo['recv_address']}}</p>
                <p>备注: {{$orderinfo['remark']}}</p>
            </div>

        </div>


        <div class="am-g dishes">
            @foreach ($orderinfo['dishes'] as $dish)

                <div  class="am-g dish">

                    <div class="am-u-sm-7">
                        <div class="dish-name">
                            {{$dish['name']}}
                        </div>
                    </div>
                    <div class="am-u-sm-5">

                        <div class="am-g">
                            <div class="am-u-sm-4" style="padding: 0px;  text-align: center;">
                                x{{$dish->pivot->dishes_amount}}
                            </div>
                            <div class="am-u-sm-8 dish-price" style="text-align: right">
                                ￥{{$dish['pivot']['dishes_price']}}
                            </div>
                        </div>
                    </div>

                </div>

            @endforeach

            <div class="am-g total-price">
                        合计
                       <span class="value">￥{{$orderinfo['price']}}</span>
            </div>

        </div>

        @if($orderinfo['status'] < 4)
        <!-- 底栏 -->
        <div data-am-widget="navbar" class="am-navbar am-cf " id="" style="z-index: 1009">
            <div class="am-navbar-nav am-cf am-avg-sm-4" style="height: 49px;padding: 0px;overflow: visible">
                <div class="am-g">
                    <div class="am-u-sm-12">
                        <button class="am-btn"  id="doc-confirm-toggle" style=" background-color: transparent;line-height: 35px;">

                            确认收餐
                        </button>
                    </div>
                    <div class="background" style="  position: absolute;left: -1px;width: 101%;z-index: -1;">
                        <img style="width: 100%" src="{{asset('/image/frontend/address_bottombar_bg.png')}}">
                    </div>
                </div>
            </div>
        </div>
        <!-- 底栏 -->

        <div class="am-modal am-modal-confirm" tabindex="-1" id="confirm_recv">
            <div class="am-modal-dialog">
                <div class="am-modal-hd">确认收餐</div>
                {{--<div class="am-modal-bd">--}}

                {{--</div>--}}
                <div class="am-modal-footer">
                    <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                    <span class="am-modal-btn" data-am-modal-confirm>确定</span>
                </div>
            </div>
        </div>

        <form id="confirmRecv" action="/order/confirm-recv" method="post">

            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <input type="hidden" name="order_id" value="{{$orderinfo->id}}">

        </form>


    <script>
        $(function() {
            $('#doc-confirm-toggle').click(function() {
                $('#confirm_recv').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                        $('#confirmRecv').submit();
                    },
                    onCancel: function() {
                    }
                });
            });
        });
    </script>
    @endif

    </div>




@endsection