<?php namespace xesc\Http\Controllers;

use xesc\Http\Requests;
use xesc\Http\Controllers\Controller;

use Illuminate\Http\Request;
use xesc\Orders;

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
        $args= $request->only(['addr_id']);
        $args=$request->only(['open_id','addr_id']);
        $user=User::where('open_id',$args['open_id'])->get()->first();
        $cart=$user->cart;
        



	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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

}
