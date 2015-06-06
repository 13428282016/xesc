<?php namespace xesc\Http\Controllers\ucenter;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use xesc\Http\Requests;
use xesc\Http\Controllers\Controller;

use Illuminate\Http\Request;
use xesc\RecvAddr;

class RecvAddrController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $user=Session::get('user');

        return view('recv_addr/index',['addrs'=>$user->recvAddrs,'title'=>'收货地址']);
	}


//	public function getAddressesView()
//	{
//		$addressinfos = array(array(
//			'id' => '1',
//			'name' => '西瓜',
//			'cellphone' => '18812341234',
//			'address' => '广东省广州市荔湾区动感小西瓜文昌楼4楼A区'
//		),array(
//			'id' => '2',
//			'name' => '西瓜',
//			'cellphone' => '18812341234',
//			'address' => '广东省广州市荔湾区动感小西瓜文昌楼4楼A区'
//		),);
//
//		return view('frontend/address',['title' => '送餐地址','addressinfos' => $addressinfos]);
//	}

//	public function getAddAddressView()
//	{
//
//
//		return view('frontend/address_add',['title' => '添加地址']);
//
//
//	}
//

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//

        return view('recv_addr/create',['title' => '添加地址']);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
        $formData=$request->only(['address','cellphone','name']);

        $addr= new RecvAddr($formData);
        $addr->sex= $request->get('sex')==1?RecvAddr::SEX_MAN:RecvAddr::SEX_WOMEN;
        $user=$request->session()->get('user');
        $addr->user_id=$user->id;
        $addrs_amount=$user->recvAddrs()->count();
        $addr->is_default= $addrs_amount?false:true;
        if($addr->save())
        {
            return Redirect::to('recvaddr');
        }
        else
        {
            return Redirect::to('recvaddr/create')->withInput()->withError('添加失败');
        }
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
        $user=Session::get('user');
        $addr=$user->recvAddrs()->where('id',$id)->get()->first();
        return view('recv_addr/edit',['addr'=>$addr,'title'=>'编辑收货地址']);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{
		//
        $formData=$request->only(['address','cellphone','name','sex']);
        $addr=RecvAddr::find($id);
        $addr->address=$formData['address'];
        $addr->cellphone=$formData['cellphone'];
        $addr->name=$formData['name'];
        $addr->sex=$formData['sex'];

        if($addr->save())
        {
            return Redirect::to('recvaddr');
        }
        else
        {
            return Redirect::to('recvaddr'.$id.'/edit')->withInput()->withError('编辑失败');
        }

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
        $addr=RecvAddr::find($id);
        if($addr->delete())
        {
            return Redirect::to('recvaddr');
        }
        else
        {

        }
	}

}
