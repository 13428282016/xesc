
@extends('layout.index')
@extends('layout.header')


@section('content')

<style>

    .dishes {
        padding: 0px 10px;
        font-family: arial;
    }

    .dish ~.dish {
        border-top: 1px solid #e0e0e0;
        margin: 0px;
    }

    .am-u-sm-8 {
        padding: 0px;
    }

    .am-container {
        padding-top: 10px;
    }

    .am-container>.am-g {
        background-color: #ffffff;
        margin-bottom: 10px;
        margin-left: 0px;
        margin-right: 0px;
        -webkit-border-radius: 15px;
        -moz-border-radius: 15px;
        border-radius: 15px;

    }


    /* 地址部分 */

    .am-container .address {
        height: 70px;
    }

    .am-container .address>div {
        display: inline-block;
    }

    .am-container .address .address-details {
        color: #333333;
        font-size: 1.2em;
    }

    .am-container .address-icon {
        margin-left: 10px;
        line-height: 70px;
        width: 25px;
    }

    .am-container .address .right-arrow {

        float: right;
        margin-right: 15px;
        line-height: 70px;
    }


    /* */
    .make-order-btn {
        margin-top: 20px;
    }
    .details {
        margin-top: 20px;
        border-top: 1px solid #e0e0e0;
    }
    .details .am-g {
        border-bottom: 1px solid #e0e0e0;
    }
    .details .am-g .am-form-field {
        padding-left: 1rem;
        padding-right: 1rem;
        border: 0px;
    }
    .dish-price {
        padding: 0px;
        text-align: left;
    }
    form {
        padding: 0px;
    }

    /* 备注 */
    .remark {
        padding-left: 10px;
    }
    .remark input{
       height: 45px;
        width: 80%;

    }

    /* 支付方式 */
    .payment-ways {
        padding: 0px 10px;
    }
    .payment-ways >div,.dish {
        height: 45px;
        line-height: 45px;
        padding: 0px;
    }
    .payment-ways >div ~div {
        border-top: 1px solid #e0e0e0;
    }
    label {
        cursor: pointer;
        background: url('../image/frontend/address_radio_unchecked.png') no-repeat right center ;
        font-weight: normal;
        font-size: 16px;
        width: 100%;
    }

    label.checked {
        background: url('../image/frontend/address_radio_checked.png') no-repeat right center ;
    }

    /* 菜品列表 */
    .total_price {
        color: #ff2828;
        float: right;
    }
    .am-navbar .am-navbar-nav .am-btn {
        color: #ffffff;
    }
</style>



<div class="am-container">

    <div class="am-g">
        <a href="/address/add-address-view">
            <div class="address">

                <div class="address-icon">
                    <img width="25" src="{{asset('/image/frontend/siderbar_myaddresses.png')}}">
                </div>
                <div class="address-details" style="  padding-left: 25%;">
                    <div class="no-addresses-notes">
                        请添加地址
                    </div>
                </div>

                <span class="right-arrow"> <img width="9" src="{{asset('/image/frontend/orderconfirm_right_gray_arrow.png')}}"></span>

            </div>
        </a>
    </div>


    <div class="am-g remark">
            备注:<input name="remark" style="border: 0px" placeholder="添加备注">
    </div>

    <div>支付方式</div>

   <div class="am-g payment-ways">
       <div class="am-u-sm-12 online-pay">
           <input id="onlinepay" name="pay_type" type="radio" style="display: none" value="1">
           <label name="onlinepay" for="onlinepay" class="checked">在线支付</label>
       </div>
       <div class="am-u-sm-12 arrival-pay">
           <input id="arrivalpay" name="pay_type" type="radio" style="display: none" value="2">
           <label name="arrivalpay" for="arrivalpay">餐到付款</label>
       </div>
   </div>

    <div class="am-g dishes">
        <div class="dish">
            订单总计
            <span class="total_price">￥88888</span>
        </div>
        @foreach ($carts_data as $dishes)

        <div id="{{$dishes['id']}}" class="am-g dish">

            <div class="am-u-sm-8">
                <div class="dish-name">
                    {{$dishes['name']}}
                </div>
            </div>
            <div class="am-u-sm-4">

                <div class="am-g">
                    <div class="am-u-sm-4" style="padding: 0px;  text-align: center;">
                        x{{$dishes['amount']}}
                    </div>
                    <div class="am-u-sm-8 dish-price" style="text-align: right">
                        ￥{{$dishes['price']}}
                    </div>
                </div>
            </div>

        </div>

    @endforeach
    </div>
    <!-- 底栏 -->
    <div data-am-widget="navbar" class="am-navbar am-cf " id="" style="z-index: 1009">
        <div class="am-navbar-nav am-cf am-avg-sm-4" style="height: 49px;padding: 0px;overflow: visible">
            <div class="am-g">
                <div class="am-u-sm-12">
                    <a class="am-btn"  id="make_order_btn" style="  line-height: 35px;">
                        立即下单
                    </a>
                </div>
                <div class="background" style="  position: absolute;left: -1px;
  width: 101%;
  z-index: -1;">
                    <img style="width: 100%" src="{{asset('/image/frontend/address_bottombar_bg.png')}}">
                </div>
            </div>
        </div>
    </div>
    <!-- 底栏 -->
    {{--<form method="post" id="make_order_form" action="/order/make_order" style="">--}}
        {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
        {{--<input id="carts_data" type="hidden" name="carts_data" value="{{json_encode($carts_data)}}">--}}
        {{--<div class="am-g details">--}}

            {{--<div class="am-g">--}}
                {{--<input type="text" name="address" class="am-form-field am-radius" placeholder="地址" />--}}
            {{--</div>--}}
            {{--<div class="am-g">--}}
                {{--<input type="text" name="phone"   class="am-form-field am-radius" placeholder="手机/电话号码" />--}}
            {{--</div>--}}
            {{--<div class="am-g">--}}
                {{--<input type="text" name="remark"  class="am-form-field am-radius" placeholder="备注" />--}}
            {{--</div>--}}

            {{--<div class="am-g">--}}
                {{--<input type="hidden" name="pay_type" value="1">--}}
                {{--<div class="am-form-field  payment-ways">餐到付款</div>--}}
            {{--</div>--}}

        {{--</div>--}}

        {{--<div class="make-order-btn">--}}
            {{--<button id="make_order" type="submit" class="am-btn am-btn-secondary am-btn-block">立即下单</button>--}}
        {{--</div>--}}
    {{--</form>--}}


    <script type="text/javascript">

        $(function(){



            var order = {
                init:function(){
                    $('.payment-ways label').click(function(){
                        var radioId = $(this).attr('name');
                        $('label').removeAttr('class') && $(this).attr('class', 'checked');
                        $('input[type="radio"]').removeAttr('checked') && $('#' + radioId).attr('checked', 'checked');
                    });
                }
            };

            order.init();

        })




    </script>


</div>
@endsection
