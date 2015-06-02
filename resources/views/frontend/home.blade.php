@extends('layout.index')
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

	@for ($i = 0; $i < 6; $i++)


		<div id="{{$i}}" class="am-g dish">

			<div class="am-u-sm-4">
				<img class="dish-image" width="100%" src="https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=56381638,2357882918&fm=116&gp=0.jpg">
			</div>
			<div class="am-u-sm-8">
				<div class="dish-name">
					豆豉排骨
				</div>
				<div class="dish-sales">
					月售：912
				</div>
				<div class="dish-price">
					￥{{$i + 10}}.00
				</div>
				<span data-id="{{$i}}" class="add">+</span>
			</div>
		</div>
	@endfor

	{{--<div class="am-g dish">--}}

		{{--<div class="am-u-sm-4">--}}
			{{--<img class="dish-image" width="100%" src="https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=56381638,2357882918&fm=116&gp=0.jpg">--}}
		{{--</div>--}}
		{{--<div class="am-u-sm-8">--}}
			{{--<div class="dish-name">--}}
				{{--豆豉排骨--}}
			{{--</div>--}}
			{{--<div class="dish-sales">--}}
				{{--月售：912--}}
			{{--</div>--}}
			{{--<div class="dish-price">--}}
				{{--￥680.00--}}
			{{--</div>--}}
			{{--<span class="add">+</span>--}}
		{{--</div>--}}
	{{--</div>--}}
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
					买单
				</a>
			</div>

		</div>
	</div>
</div>


<script>

	$(function() {

		var data = [{
			id:0,
			price:10.00,
			amount:0
		},{
			id:1,
			price:11.00,
			amount:0
		},{
			id:2,
			price:12.00,
			amount:0
		},{
			id:3,
			price:13.00,
			amount:0
		},{
			id:4,
			price:14.00,
			amount:0
		},{
			id:5,
			price:15.00,
			amount:0
		}];

		var dishes = {

			total_amount:0,
			total_price:0.00,
			o_total_amount:$(".shopping-cart .amount"),
			o_total_price:$(".shopping-cart .price"),

			init:function(){

				var self = this;
				$(".add").click(function(){
					var id = $(this).data("id");
					self.add_dishe(id);
				});

				$('#payment_button').click(function(){
					self.make_order();
				});

			},
			add_dishe:function(id){

				var dish_data = data[id];
				this.total_amount ++;
				this.total_price += dish_data["price"];
				data[id]["amount"] ++ ;

				this.o_total_price.html(this.total_price);
				this.o_total_amount.html(this.total_amount);

			},
			make_order:function() {

				$.post('/order/make_order',{
					data:{otal_amount:1},
					_token:'{{ csrf_token() }}'
				});

			}


		};

		dishes.init();

	})

</script>

@endsection




