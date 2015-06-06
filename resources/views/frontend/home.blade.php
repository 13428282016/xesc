@extends('layout.index')
@extends('layout.index_header')
@extends('layout.index_bottombar')

@section('content')

<style>

	div.am-container>.dish{
		padding: 5px 0px;
		margin: 10px 0px;
		background-color: #ffffff;
		border-bottom: 1px solid #efefef;
		border-radius: 15px;
	}

	.dish .dish-sales {
		font-size: 14px;
		color: #919191;
		margin-bottom: 7px;
	}

	.dish .dish-name {
		font-size: 18px;
		line-height: 1.3;
		margin-top: 3px;
	}

	.dish-price {
		color:#ff2828;
		font-size: 16px;
		font-family: arial;
	}

	.dish .dish-image {
		/*border: 1px solid #efefef;*/
		/*padding: 1px;*/
		border-radius: 15px;
		padding-left: 5px;
	}

	.dish .dish-details {
		padding-left: 10px;
		float: left;
	}

	.dish span {
		width: 30px;
		display: inline-block;
		text-align: center;
	}

	.dish span img {
		width: 25px;
	}

	.dish .dish-operation {
		float: right;
		margin-top: 53px;
	}

	.dish .dish-operation .add {
		line-height: 0.5;
	}

	.shopping-cart {
		margin-top: 5px;
	}

	/** 底部 **/
	.am-navbar .am-navbar-nav div.dish-count {
		position: absolute;
		top: -21px;
		width: 100%;
	}
	.am-navbar .am-navbar-nav div.dish-count .value {
		background: url('{{asset('/image/frontend/index_bottombar_count_bg.png')}}') no-repeat center  ;
		background-size: auto 100%;
		width: 39px;
		height: 39px;
		display: block;
		color: #ffffff;
		line-height: 39px;

	}

	.am-navbar .am-navbar-nav .am-btn {
		color: #ffffff;
	}



</style>

<div class="am-container">

	<input id="dish_data" type="hidden" value="{{json_encode($dishes)}}">

	@for($i = 0;$i < count($dishes);$i++)

		<div id="{{$i}}" class="am-g dish">

			<img class="dish-image" style="float: left" width="85" src="{{asset('/image/frontend/dish_paigu.png')}}">
			<div class="dish-details">
				<div class="dish-name">
					{{$dishes[$i]['name']}}
				</div>
				<div class="dish-sales">
					{{--月售：912--}}
					{{$dishes[$i]["id"]}}
				</div>
				<div class="dish-price">
					￥{{$dishes[$i]['price']}}
				</div>

			</div>
			<div class="dish-operation">

				@if($cartDishes[$dishes[$i]['id']])
					<span data-index="{{$i}}" class="minus" ><img src="{{asset('/image/frontend/dish_minus.png')}}"></span>
					<span  class="amount" >{{$cartDishes[$dishes[$i]['id']]['dishes_amount']}}</span>
				@else
					<span data-index="{{$i}}" class="minus" style="display: none"><img src="{{asset('/image/frontend/dish_minus.png')}}"></span>
					<span  class="amount" style="display: none">0</span>
				@endif
				<span data-index="{{$i}}" class="add"><img src="{{asset('/image/frontend/dish_add.png')}}"></span>

			</div>
		</div>

	@endfor

</div>

<!-- 底栏 -->
<div data-am-widget="navbar" class="am-navbar am-cf " id="" style="z-index: 1009">
	<div class="am-navbar-nav am-cf am-avg-sm-4" style="height: 49px;padding: 0px;overflow: visible">

		<div class="am-g">

			<!-- 总价钱 -->
			<div class="am-u-sm-6 shopping-cart">
				 <span class="dish-price" >￥{{$totalPrice}}</span>
			</div>

			<!-- 底部 所点的餐品份数 -->
			<div class="dish-count" align="center">
				<span class="value">

					@if($totalAmount)
						<span class="total-amount">{{$totalAmount}}</span>
						<img class="cart-icon" style="width: 20px;display: none" src="{{asset('/image/frontend/index_bottombar_cart.png')}}">
					@else
						<span class="total-amount"></span>
						<img class="cart-icon" style="width: 20px;" src="{{asset('/image/frontend/index_bottombar_cart.png')}}">
					@endif
				</span>
			</div>

			<div class="am-u-sm-6">

				<a class="am-btn"  id="payment_button" style="  line-height: 35px;">
					选好了
				</a>
			</div>
			<div class="background" style="  position: absolute;
  width: 100%;
  z-index: -1;">
				<img style="width: 100%" src="{{asset('/image/frontend/index_bottombar_bg.png')}}">
			</div>
		</div>

	</div>

</div>

<form id="confirm_order" action="/order/confirm-order-view" method="get" >

	<input id="csrf_totken" type="hidden" name="_token" value="{{ csrf_token() }}">
	<input id="carts_data" type="hidden" name="carts_data" value="">

</form>

<script>

	var totalPrices = {{$totalPrice}};
	var totalAmount = {{$totalAmount}};

</script>

<script src="{{asset('/js/frontend/index.js')}}"></script>

@endsection


