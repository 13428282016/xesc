<?php namespace xesc\Http\Controllers\admin;

use xesc\Http\Requests;
use xesc\Http\Controllers\Controller;

use Illuminate\Http\Request;
use xesc\Order;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //
        $args = $request->only(['type']);
        switch ($args['type']) {
            case Order::STATUS_SUBMITTED:
                $orders = Order::where('status', Order::STATUS_SUBMITTED)->get();

                break;
            case Order::STATUS_DOING:
                $orders = Order::where('status', Order::STATUS_DOING)->get();
                break;
            case Order::STATUS_SHIPPING:
                $orders = Order::where('status', Order::STATUS_SHIPPING)->get();
                break;
            case Order::STATUS_FINISHED:
                $orders = Order::where('status', Order::STATUS_FINISHED)->get();
                break;
            case Order::STATUS_CANCEL:
                $orders = Order::where('status', Order::STATUS_CANCEL)->get();
                break;
            case Order::STATUS_ALL:
                $orders = Order::all();
                break;
            default:
                $args['type'] = Order::STATUS_SUBMITTED;
                $orders = Order::where('status', Order::STATUS_SUBMITTED)->get();


        }
        $ordersAmount[Order::STATUS_SUBMITTED] = Order::where('status', Order::STATUS_SUBMITTED)->count();
        $ordersAmount[Order::STATUS_DOING] = Order::where('status', Order::STATUS_DOING)->count();
        $ordersAmount[Order::STATUS_SHIPPING] = Order::where('status', Order::STATUS_SHIPPING)->count();
        $ordersAmount[Order::STATUS_FINISHED] = Order::where('status', Order::STATUS_FINISHED)->count();
        $ordersAmount[Order::STATUS_CANCEL] = Order::where('status', Order::STATUS_CANCEL)->count();
        $ordersAmount[Order::STATUS_ALL] = Order::count();
        return view('admin.order.index', ['orders' => $orders, 'ordersAmount' => $ordersAmount, 'type' => $args['type']]);
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
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
        $order = Order::find($id);
        return view('', ['order', $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function  postDo(Request $request)
    {
        $args = $request->only('id');
        $order = Order::find($args['id']);
        $order->status = Order::STATUS_DOING;
        if($order->save())
        {
            return ["success"=>true];
        }

    }

    public function postShip(Request $request)
    {
        $args = $request->only('id');
        $order = Order::find($args['id']);
        $order->status = Order::STATUS_SHIPPING;
        if($order->save())
        {
            return ["success"=>true];
        }
    }

    public function postCancel(Request $request)
    {
        $args = $request->only('id');
        $order = Order::find($args['id']);
        $order->status = Order::STATUS_CANCEL;
        if($order->save())
        {
            return ["success"=>true];
        }
    }

}
