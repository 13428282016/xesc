<?php namespace xesc\Http\Controllers\admin;

use xesc\Http\Requests;
use xesc\Http\Controllers\Controller;

use Illuminate\Http\Request;
use xesc\Order;

class OrdersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $orders=Order::all();
        return view('',['orders'=>$orders]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
        $order=Order::find($id);
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

    public function  doing(Request $request)
    {
        $args=$request->only('id');
        $order=Order::find($args['id']);
        $order->status=Order::STATUS_DOING;
        $order->save();

    }
    public function ship(Request $request)
    {
        $args=$request->only('id');
        $order=Order::find($args['id']);
        $order->status=Order::STATUS_SHIPPING;
        $order->save();
    }

}
