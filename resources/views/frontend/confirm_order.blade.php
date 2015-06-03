
@extends('.........public.index')


@section('content')

<style>

    body {
        background-color: #eeeeee;
    }

    .dish {
        padding: 5px 0px;
        border-bottom: 1px solid #e0e0e0;
    }

    .dish .am-g {
    }

    .am-g {
        background-color: #ffffff;
    }

    .am-header {
        margin-bottom: 10px;
    }

    .am-container {
        border-top: 1px solid #e0e0e0;
    }

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

<header data-am-widget="header" class="am-header am-header-default">
    <div class="am-header-left am-header-nav">
        <a id="back"  class="" style="cursor: pointer" onclick="history.go(-1)">
            返回
        </a>

    </div>
    <h1 class="am-header-title">
        <a href="#title-link" class="">确认餐品</a>
    </h1>

</header>

<div class="am-container">

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

    <form method="post" id="make_order_form" action="/order/make_order" style="">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input id="carts_data" type="hidden" name="carts_data" value="{{json_encode($carts_data)}}">
        <div class="am-g details">

            <div class="am-g">
                <input type="text" name="address" class="am-form-field am-radius" placeholder="地址" />
            </div>
            <div class="am-g">
                <input type="text" name="phone" class="am-form-field am-radius" placeholder="手机/电话号码" />
            </div>

            <div class="am-g">
                <input type="hidden" name="payment_ways" value="1">
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
