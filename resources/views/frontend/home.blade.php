@extends('.........public.index')
@extends('layout.index_header')
@extends('layout.index_bottombar')
@extends('layout.index_footer')

@section('content')

<style>

	div.dish{
		padding: 10px 0px;
		/*background-color: #ffffff;*/
		border-bottom: 1px solid #efefef;
	}

	.dish .dish-sales {
		font-size: 12px;
		color: #919191;
		margin-bottom: 5px;
	}

	.dish .dish-name {
		font-size: 15px;
	}

	.dish .dish-price {
		color:#ff2828;
		font-size: 14px;
	}

	.dish .dish-image {
		border: 1px solid #efefef;
		padding: 1px;
	}

	.dish .add {
		position: absolute;
		right: 15px;
		bottom: 0px;
		font-size: 20px;
		padding: 8px;
		padding-bottom: 9px;
		line-height: 0.5;
		border: 1px solid #cccccc;
		color: #0e90d2;
		-webkit-border-radius: 16px;
		-moz-border-radius: 16px;
		border-radius: 16px;
	}

	.shopping-cart {
		line-height: 23px;
		text-align: left;
	}
	.shopping-cart .price {
		color: #ff2828;
	}

</style>

<div class="am-container">

	<input id="dish_data" type="hidden" value="{{json_encode($dishes)}}">

	@for($i = 0;$i < count($dishes);$i++)

		<div id="{{$i}}" class="am-g dish">

			<div class="am-u-sm-4">
				<img class="dish-image" width="100%" src="{{$dishes[$i]['image']}}">
			</div>
			<div class="am-u-sm-8">
				<div class="dish-name">
					{{$dishes[$i]['name']}}
				</div>
				<div class="dish-sales">
					月售：912
				</div>
				<div class="dish-price">
					￥{{$dishes[$i]['price']}}
				</div>
				<span data-id="{{$i}}" class="add">+</span>
			</div>
		</div>

	@endfor

</div>

<div data-am-widget="navbar" class="am-navbar am-cf am-navbar-default "
	 id="">
	<div class="am-navbar-nav am-cf am-avg-sm-4" style="height: 49px;background-color: #efefef;padding: 0px">

		<div class="am-g">

			<div class="am-u-sm-7 shopping-cart">
				总计： <span class="price">0 </span><span style="color:#ff2828"> ￥</span>
				<br/>
				份数： <span class="amount">0</span>
			</div>

			<div class="am-u-sm-5" style="  padding-right: 0px;">

				<a class="am-btn am-btn-secondary" href="#" id="payment_button">
					<i class="am-icon-shopping-cart " style="display: inline-block;vertical-align: bottom;"></i>
					选好了
				</a>
			</div>

		</div>
	</div>
</div>

<form id="confirm_order" action="/order/confirm_order_view" method="get" >

	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input id="carts_data" type="hidden" name="carts_data" value="">

</form>

<script src="{{asset('/js/frontend/index.js')}}"></script>

<script>



</script>

@endsection




