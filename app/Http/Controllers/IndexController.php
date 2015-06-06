<?php namespace xesc\Http\Controllers;

use xesc\Dishes;
use xesc\Cart;
use Illuminate\Http\Request;

class IndexController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Index Controller
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
	public function getIndex(Request $request)
	{
		$dishes = Dishes::all()->toArray();

		$user=$request->session()->get('user');
		$userDishes  =$user->cart->dishes()->get();
		$totalPrice  = 0.00;
		$totalAmount = 0;
		$cartDishes  = array();
		foreach($userDishes as $id => $dish) {
			$cartDishes[$dish['id']] = $dish->pivot->toArray();
			$totalPrice  += $dish->price * $dish->pivot->dishes_amount;
			$totalAmount += $dish->pivot->dishes_amount;
//			echo $dish->price." * ".$dish->pivot->dishes_amount." = ".$totalPrice."   <br/>";
		}


		return view('frontend/home',['dishes' => $dishes,'cartDishes' => $cartDishes,'totalPrice' => $totalPrice,'totalAmount' => $totalAmount]);
	}

}
