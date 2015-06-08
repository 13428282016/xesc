<?php namespace xesc\Http\Controllers\ucenter;

use xesc\Http\Requests;
use xesc\Http\Controllers\Controller;

use Illuminate\Http\Request;
use xesc\Order;
use xesc\User;
use xesc\OrdersDishes;
use xesc\Dishes;

use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller {

	/**
	 * Display a listing of the resource.
     * 显示订单列表主页
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
        $user = $request->session()->get('user');
        return view('frontend/order',['title' => '订单','orderinfos' => $user->orders()->orderBy('created_at','desc')->get()]);
	}

	/**
	 * Show the form for creating a new resource.
     * 显示确认订单主页
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
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
	 * Store a newly created resource in storage.
     * 生成订单操作
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

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
            $order->dishes()->attach($dish->id,['dishes_amount' => $dish->pivot->dishes_amount,'dishes_name' => $dish->name,'dishes_price'=>$dish->price,'dishes_image'=>$dish->image]);
        }

        $cart=$user->cart;
        $cart->dishes()->detach();

        return Redirect::to('/order');

	}

	/**
	 * Display the specified resource.
     * 订单详情页
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id,Request $request)
	{
        $user = $request->session()->get('user');
        return view('frontend/order_details',['title' => '订单详细','orderinfo' => $user->orders()->find($id)]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
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
        return Redirect::to('order/'.$request->input('order_id'));

    }

    public function postChooseAddr(Request $request) {

        $user = $request->session()->get('user');
        $user->recvAddrs()->update(['is_default' => 0]);
        $userAddress = $user->recvAddrs()->find($request->input('addressId'));
        $userAddress->is_default = 1;
        $userAddress->save();

        return Redirect::to('order/create');

    }

}
