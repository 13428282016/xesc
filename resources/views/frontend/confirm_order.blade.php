
@extends('layout.index')
@extends('layout.header')


@section('content')

<style>

    .dish {
        padding: 5px 0px;
    }

    .am-container {
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

    <div class="am-g">
    @foreach ($carts_data as $dishes)

        <div id="{{$dishes['id']}}" class="am-g dish">

            <div class="am-u-sm-8">
                <div class="dish-name">
                    {{$dishes['name']}}
                </div>
            </div>
            <div class="am-u-sm-4">


                <div class="am-g">
                    <div class="am-u-sm-4" style="padding: 0px;">
                        x{{$dishes['amount']}}
                    </div>

                    <div class="am-u-sm-1" style="padding: 0px;line-height: 26px">
                        ￥
                    </div>
                    <div class="am-u-sm-6 dish-price" style="">
                        {{$dishes['price']}}
                    </div>
                </div>
            </div>

        </div>

    @endforeach
    </div>

    <form method="post" id="make_order_form" action="/order/make_order" style="">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input id="carts_data" type="hidden" name="carts_data" value="{{json_encode($carts_data)}}">
        <div class="am-g details">

            <div class="am-g">
                <input type="text" name="address" class="am-form-field am-radius" placeholder="地址" />
            </div>
            <div class="am-g">
                <input type="text" name="phone"   class="am-form-field am-radius" placeholder="手机/电话号码" />
            </div>
            <div class="am-g">
                <input type="text" name="remark"  class="am-form-field am-radius" placeholder="备注" />
            </div>

            <div class="am-g">
                <input type="hidden" name="pay_type" value="1">
                <div class="am-form-field  payment-ways">餐到付款</div>
            </div>

        </div>

        <div class="make-order-btn">
            <button id="make_order" type="submit" class="am-btn am-btn-secondary am-btn-block">立即下单</button>
        </div>
    </form>


    <script type="text/javascript">

        $(function(){

            var order = {

                init:function(){



                }

            };

            order.init();

        })




    </script>


</div>
@endsection
