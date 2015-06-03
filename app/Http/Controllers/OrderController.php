<?php namespace xesc\Http\Controllers;
use Illuminate\Http\Request;
use xesc\Orders;
use xesc\Carts;
use xesc\Dishes;
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


	public function confirm_order_view(Request $request) {


		$carts_data = $request->input('carts_data');

		return view('frontend/confirm_order',['carts_data' => json_decode($carts_data,1)]);

	}

	public function make_order(Request $request) {

		$carts_data = json_decode($request->input('carts_data'));


		dump($carts_data);

//		$order = new Orders();
//		$order->save();




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
