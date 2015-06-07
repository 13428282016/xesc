<?php namespace xesc\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use xesc\Dishes;
use xesc\Order;
use xesc\Carts;
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

	public function postChooseAddr(Request $request) {

		$user = $request->session()->get('user');
		$user->recvAddrs()->update(['is_default' => 0]);
		$userAddress = $user->recvAddrs()->find($request->input('addressId'));
		$userAddress->is_default = 1;
		$userAddress->save();

		return Redirect::to('order/confirm-order-view');

	}

	/**
	 * 展示确认订单页面
	 *
	 * @return Response
	 */
	public function getConfirmOrderView(Request $request) {


		$user = $request->session()->get('user');
		$userDishes  =$user->cart->dishes()->get();
		$userAddress = $user->recvAddrs()->where('is_default','=',1)->first();

		$total_price = 0;
		foreach($userDishes as $userDish) {
			$total_price += $userDish->price * $userDish->pivot->dishes_amount;
		}

		$params = array(
			'title'		  => '订单确认',
			'userDishes'  => $userDishes,
			'total_price' => $total_price,
			'userAddress' => $userAddress
		);

		return view('frontend/confirm_order',$params);

	}

	/**
	 * 下单
	 * @param Request $request
	 * @return \Illuminate\View\View
	 */
	public function postMakeOrder(Request $request) {


		$user 		= $request->session()->get('user');
		$userDishes = $user->cart->dishes()->get();

		if (empty($userDishes) || count($userDishes) == 0) {
			return Redirect::to("/");
		}

		$userAddress = $user->recvAddrs()->find($request->input('addressId'));
		$total_price = 0;

		foreach($userDishes as $index => $dish) {
			$total_price += $dish->price * $dish->pivot->dishes_amount;
		}

		$order = new Order();
		$order->recv_address   = $userAddress->address;
		$order->recv_name      = $userAddress->name;
		$order->recv_cellphone = $userAddress->cellphone;
		$order->recv_sex       = $userAddress->sex;
		$order->pay_type       = $request->input('pay_type');
		$order->remark		   = $request->input('remark');
		$order->price		   = $total_price;
		$order->status		   = Order::STATUS_SUBMITTED;
		$order->order_no       = time();
		$order->buyer_id       = $user->id;
		$order->save();

		foreach ($userDishes as $dish) {

			$orderdishes = new OrdersDishes();
			$orderdishes->order_id 		= $order->id;
			$orderdishes->dishes_id     = $dish->id;
			$orderdishes->dishes_amount = $dish->pivot->dishes_amount;
			$orderdishes->dishes_name   = $dish->name;
			$orderdishes->dishes_price  = $dish->price;
			$orderdishes->dishes_image  = $dish->image;
			$orderdishes->save();

		}

		$cart=$user->cart;
		$cart->dishes()->detach();

		return Redirect::to('/order/orders-view');

	}

	public function postConfirmRecv(Request $request) {

		$order = Order::find($request->input('order_id'));
		if ($order->status != Order::STATUS_FINISHED) {

			$order_dishes = OrdersDishes::where('order_id',$request->input('order_id'))->get();
			foreach($order_dishes as $dishes) {
				$dish = Dishes::find($dishes['dishes_id']);
				$dish->sales += $dishes['dishes_amount'];
				$dish->save();
			}

			$order->status = Order::STATUS_FINISHED;
			$order->save();
		}

		return Redirect::to('order/order-details-view?order_id='.$request->input('order_id'));

	}

	public function getOrdersView(Request $request) {

		$user = $request->session()->get('user');
		return view('frontend/order',['title' => '订单','orderinfos' => $user->orders()->orderBy('created_at','desc')->get()]);

	}

	public function getOrderDetailsView(Request $request) {

		$user = $request->session()->get('user');
		return view('frontend/order_details',['title' => '订单详细','orderinfo' => $user->orders()->find($request->input('order_id'))]);

	}

}
