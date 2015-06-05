<?php namespace xesc\Http\Controllers;
use Illuminate\Http\Request;
use xesc\Orders;
use xesc\Carts;
use xesc\Dishes;
use xesc\OrdersDishes;
class OrderController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Order Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	public function __construct()
	{

	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */


	public function getConfirmOrderView(Request $request) {


		$carts_data = $request->input('carts_data');

		return view('frontend/confirm_order',['carts_data' => json_decode($carts_data,1),'title' => '订单确认']);

	}

	public function postMakeOrder(Request $request) {

		$carts_data = json_decode($request->input('carts_data'));

		$order = new Orders();
		$order->address  = $request->input('address');
		$order->phone    = $request->input('phone');
		$order->pay_type = $request->input('pay_type');
		$order->remark   = $request->input('remark');
		$order->save();

		foreach ($carts_data as $dish_id => $cart_dish) {

				$orderdishes = new OrdersDishes();
			    $orderdishes->order_id 		= $order->id;
			    $orderdishes->dishes_amount = $cart_dish["amount"];
			    $orderdishes->dishes_name   = $cart_dish["name"];
			    $orderdishes->dishes_price  = $cart_dish["price"];
			    $orderdishes->save();

		}

		return "下单成功";

	}


	public function getOrdersView(Request $request) {

		$orderinfos = array(
			array(
				'id' => '1',
				'created_at' => date('Y-m-d H:i:s'),
				'status' => '订单已提交',
				'dishes' => array(
					array(
						'dish_id' => '1',
						'dishes_image' => '',
					),
					array(
						'dish_id' => '2',
						'dishes_image' => '',
					),
					array(
						'dish_id' => '3',
						'dishes_image' => '',
					),
					array(
						'dish_id' => '3',
						'dishes_image' => '',
					),
					array(
						'dish_id' => '3',
						'dishes_image' => '',
					),
					array(
						'dish_id' => '3',
						'dishes_image' => '',
					),
					array(
						'dish_id' => '3',
						'dishes_image' => '',
					)
				)
			),
			array(
				'id' => '2',
				'created_at' => date('Y-m-d H:i:s'),
				'status' => '订单已提交',
				'dishes' => array(
					array(
						'dish_id' => '1',
						'dishes_image' => '',
					)
				)
			),
		);

		return view('frontend/order',['title' => '订单','orderinfos' => $orderinfos]);
	}

	public function getOrderDetailsView(Request $request) {

		$orderinfo = array(

			'id' => '1',
			'order_no' => '',


		);

		return view('frontend/order_details',['title' => '订单详细','orderinfo' => $orderinfo]);
	}

	/**
	 *  for generate test data
	 */

	function dishtestdata() {
		$data = array(
			array(
				'name' => "豆豉排骨",
				'price' => "10.00",
				'status' => 1,
				'image' => 'https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=56381638,2357882918&fm=116&gp=0.jpg'
			),array(
				'name' => "鱼香肉丝",
				'price' => "11.00",
				'status' => 1,
				'image' => 'https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=56381638,2357882918&fm=116&gp=0.jpg'
			),array(
				'name' => "青椒回锅肉",
				'price' => "12.00",
				'status' => 1,
				'image' => 'https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=56381638,2357882918&fm=116&gp=0.jpg'
			),array(
				'name' => "老干妈炒肉",
				'price' => "13.00",
				'status' => 1,
				'image' => 'https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=56381638,2357882918&fm=116&gp=0.jpg'
			),array(
				'name' => "辣椒炒牛肉",
				'price' => "14.00",
				'status' => 1,
				'image' => 'https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=56381638,2357882918&fm=116&gp=0.jpg'
			),array(
				'name' => "酸辣猪肚",
				'price' => "15.00",
				'status' => 1,
				'image' => 'https://ss0.bdstatic.com/70cFvHSh_Q1YnxGkpoWK1HF6hhy/it/u=56381638,2357882918&fm=116&gp=0.jpg'
			)
		);

		foreach ($data as $index => $dishdata) {

			$dishes = new Dishes();
			$dishes->name   = $dishdata['name'];
			$dishes->price  = $dishdata['price'];
			$dishes->status = $dishdata['status'];
			$dishes->image  = $dishdata['image'];
			$dishes->save();

		}
	}




}
