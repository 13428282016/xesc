<?php namespace xesc\Http\Controllers;
use Illuminate\Http\Request;
use xesc\Order;
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

		$user = $request->session()->get('user');
		$userDishes  =$user->cart->dishes()->get();
		$userAddress = $user->recvAddrs()->where('is_default','=',1)->first();

		$total_price = 0;
		foreach($userDishes as $userDish) {
			$total_price += $userDish->price * $userDish->pivot->dishes_amount;
		}

		$params = array(
			'carts_data'  => json_decode($carts_data,1),
			'title'		  => '订单确认',
			'userDishes'  => $userDishes,
			'total_price' => $total_price,
			'userAddress' => $userAddress
		);

		return view('frontend/confirm_order',$params);

	}

	public function postMakeOrder(Request $request) {


		$user = $request->session()->get('user');
		$userDishes  =$user->cart->dishes()->get();
		$userAddress = $user->recvAddrs()->find($request->input('addressId'));

//		dump($userDishes);
//		dump($userAddress);

		$order = new Order();
		$order->recv_address   = $userAddress->address;
		$order->recv_name      = $userAddress->name;
		$order->recv_cellphone = $userAddress->cellphone;
		$order->recv_sex       = $userAddress->sex;
		$order->pay_type       = $request->input('pay_type');
		$order->remark		   = $request->input('remark');
		$order->price		   = $request->input('price');
		$order->status		   = Order::STATUS_WAITTING_PAY;
		$order->order_no       = time();
		$order->save();

		foreach ($userDishes as $dish) {

				$orderdishes = new OrdersDishes();
			    $orderdishes->order_id 		= $order->id;
			    $orderdishes->dishes_id     = $dish->id;
			    $orderdishes->dishes_amount = $dish->pivot->dishes_amount;
			    $orderdishes->dishes_name   = $dish->name;
			    $orderdishes->dishes_price  = $dish->price * $dish->pivot->dishes_amount;
			    $orderdishes->dishes_image  = $dish->image;
			    $orderdishes->save();

		}

//		dump($order->dishes->first()->pivot);

		return  view('frontend/order_details',['title' => '订单详细','orderinfo' => $order]);

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
			'order_no' => '2314124211312',
			'created_at' => date('Y-m-d H:i:s'),
			'pay_type' => '餐到付款',
			'recv_contact' => '18812341234',
			'recv_address' => '广州市荔湾区动感小西瓜',
			'price' => "680.00",
			'status' => 2,
			'dishes' => array(
				array(
					'dish_id' => '1',
					'dishes_name' => '香辣排骨',
					'dishes_amount' => 1,
					'dishes_price' => "12.00",
				),
				array(
					'dish_id' => '2',
					'dishes_name' => '香辣牛肉',
					'dishes_amount' => 3,
					'dishes_price' => "45.00",
				),
				array(
					'dish_id' => '3',
					'dishes_name' => '牛肉炒粉',
					'dishes_amount' => 10,
					'dishes_price' => "100.00",
				),
			)
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
