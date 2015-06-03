<?php namespace xesc\Http\Controllers;
use Illuminate\Http\Request;
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

	public function make_order() {

		echo "下单成功!";
	}



}
