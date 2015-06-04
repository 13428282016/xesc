@extends('layout.index')
@extends('layout.index_header')
@extends('layout.index_bottombar')

@section('content')

<style>

	body {
		background: url('{{asset('/image/frontend/index_background_img.png')}}') repeat ;
	}

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

	.dish span {
		padding: 0px 4px;
	}

	.dish span img {
		width: 25px;
	}

	.dish .dish-operation {
		position: absolute;
		right: -2px;
		bottom: 1px;
	}

	.dish .dish-operation .add {
		line-height: 0.5;
	}

	.dish .dish-operation .minus {
		font-size: 20px;
	}

	.shopping-cart {
		margin-top: 5px;
	}

	/** 底部 **/
	.am-navbar  {
		background: url('{{asset('/image/frontend/index_bottombar_bg.png')}}') no-repeat center  ;
		background-clip: content-box;
		background-size: auto 105%;
	}

	{{--.am-navbar .am-navbar-nav {--}}
		{{--background: url('{{asset('/image/frontend/index_bottombar_count_bg.png')}}') no-repeat center  ;--}}
		{{--background-size: auto 80%;--}}
	{{--}--}}

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
			<div class="am-u-sm-9">
				<div class="dish-name">
					{{$dishes[$i]['name']}}
				</div>
				<div class="dish-sales">
					月售：912
				</div>
				<div class="dish-price">
					￥{{$dishes[$i]['price']}}
				</div>
				<div class="dish-operation">

					<span data-index="{{$i}}" class="minus" style="display: none"><img src="{{asset('/image/frontend/dish_minus.png')}}"></span>
					<span  class="amount" style="display: none">0</span>
					<span data-index="{{$i}}" class="add"><img src="{{asset('/image/frontend/dish_add.png')}}"></span>

				</div>
			</div>
		</div>

	@endfor

</div>

<div data-am-widget="navbar" class="am-navbar am-cf " id="">
	<div class="am-navbar-nav am-cf am-avg-sm-4" style="height: 49px;padding: 0px;overflow: visible">

		<div class="am-g">

			<div class="am-u-sm-6 shopping-cart">
				 <span class="dish-price" >￥0</span>
			</div>


			<div class="dish-count" align="center">
				<span class="value"> <img class="cart" style="width: 20px;" src="{{asset('/image/frontend/index_bottombar_cart.png')}}"></span>

			</div>

			<div class="am-u-sm-6">

				<a class="am-btn"  id="payment_button" style="  line-height: 35px;">
					选好了
				</a>
			</div>

		</div>
	</div>
</div>

<form id="confirm_order" action="/order/confirm-order-view" method="get" >

	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input id="carts_data" type="hidden" name="carts_data" value="">

</form>

<script src="{{asset('/js/frontend/index.js')}}"></script>

@endsection


