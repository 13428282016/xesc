<?php namespace xesc\Http\Controllers\ucenter;

use xesc\Http\Requests;
use xesc\Http\Controllers\Controller;

use Illuminate\Http\Request;
use xesc\Order;

class OrderController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		//
        $args=$request->only(['open_id','addr_id']);
        $user=User::where('open_id',$args['open_id'])->get()->first();
        $orders=$user->orders;
        return view('')->with('orders',$orders);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		//
        $args=$request->only(['open_id','addr_id']);
        $user=User::where('open_id',$args['open_id'])->get()->first();
        $cart=$user->cart;
        if($args['addr_id'])
        {
            $defaultAddr=$user->recvAddrs()->where('id',$args['addr_id']);
        }
        else
        {
            $defaultAddr=$user->recvAddrs()->where('is_default',true);
        }

        return view('',['default_addr'=>$defaultAddr,'dishes'=>$cart->dishes]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//

        $args=$request->only(['open_id','addr_id','remark']);
        $user=User::where('open_id',$args['open_id'])->get()->first();
        $cart=$user->cart;
        $dishes=$cart->dishes;
        $addr=$user->addrs()->where('id',$args['addr_id'])->first();
        $order=new Order();
        $order->recv_address=$addr->address;
        $order->recv_name=$addr->name;
        $order->recv_concact=$addr->cellphone;
        $order->recv_sex=$addr->sex;
        $order->remark=$args['remark'];
        $order->price='';
        $order->buyer_id=$user->id;
        $order->freight=0;
        $order->status=Order::STATUS_WAITTING_PAY;
        $sum=0;
        foreach($dishes as $dish)
        {
            $sum+=$dish->price*$dish->pivot->dishes_amount;
        }
        $order->price=$sum;
        $order->save();

        foreach($dishes as $dish)
        {
            $order->dishes()->attach($dish->id,['dishes_amount'=>$dish->pivot->dishes_amount,'dishes_price'=>$dish->price,'dishes_name'=>$dish->name]);
        }


	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id,Request $request)
	{
		//
        $args=$request->only(['open_id']);
        $user=User::where('open_id',$args['open_id'])->get()->first();
        $order=$user->orders()->where('id',$id)->get()->first();
        return view('',['order',$order]);

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

    public function  cancel(Request $request)
    {
        $args=$request->only(['open_id','id']);
        $user=User::where('open_id',$args['open_id'])->get()->first();
        $order=$user->orders()->where('id',$args['id'])->get()->first();
        $order->status=Order::STATUS_CANCEL;
    }
    public function  comfirm(Request $request)
    {
        $args=$request->only(['open_id','id']);
        $user=User::where('open_id',$args['open_id'])->get()->first();
        $order=$user->orders()->where('id',$args['id'])->get()->first();
        $order->status=Order::STATUS_FINISHED;
    }



}
