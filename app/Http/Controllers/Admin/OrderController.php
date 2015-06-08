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
        $rows=10;
        $args = $request->input('type',Order::STATUS_SUBMITTED);

        if(!in_array($args['type'],[Order::STATUS_SUBMITTED,Order::STATUS_DOING,Order::STATUS_SHIPPING,Order::STATUS_FINISHED,Order::STATUS_CANCEL,Order::STATUS_ALL]))
        {
            $args['type'] = Order::STATUS_SUBMITTED;
        }
        if($args['type']==Order::STATUS_ALL)
        {
            $orders = Order::orderBy('created_at','desc')->paginate($rows);
        }
        else
        {
            $orders = Order::where('status',  $args['type'])->orderBy('created_at','desc')->paginate($rows);
        }

        $ordersAmount[Order::STATUS_SUBMITTED] = Order::where('status', Order::STATUS_SUBMITTED)->count();
        $ordersAmount[Order::STATUS_DOING] = Order::where('status', Order::STATUS_DOING)->count();
        $ordersAmount[Order::STATUS_SHIPPING] = Order::where('status', Order::STATUS_SHIPPING)->count();
        $ordersAmount[Order::STATUS_FINISHED] = Order::where('status', Order::STATUS_FINISHED)->count();
        $ordersAmount[Order::STATUS_CANCEL] = Order::where('status', Order::STATUS_CANCEL)->count();
        $ordersAmount[Order::STATUS_ALL] = Order::count();
        $orders->addQuery('type',$args['type']);
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
        $order = Order::findOrFail($id);
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
        $order = Order::findOrFail($args['id']);
        $order->status = Order::STATUS_DOING;
        if($order->save())
        {
            return response()->json(["success"=>true]);
        }

    }

    public function postShip(Request $request)
    {
        $args = $request->only('id');
        $order = Order::findOrFail($args['id']);
        $order->status = Order::STATUS_SHIPPING;
        if($order->save())
        {
            return response()->json( ["success"=>true]);
        }
    }

    public function postCancel(Request $request)
    {
        $args = $request->only('id');
        $order = Order::findOrFail($args['id']);
        $order->status = Order::STATUS_CANCEL;
        if($order->save())
        {
            return response()->json(["success"=>true]);
        }
    }

}
