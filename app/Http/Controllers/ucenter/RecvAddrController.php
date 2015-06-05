<?php namespace xesc\Http\Controllers\ucenter;

use Illuminate\Support\Facades\Redirect;
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
        return view('')->with('addrs',RecvAddr::all());
	}


	public function getAddressesView()
	{
		$addressinfos = array(array(
			'id' => '1',
			'name' => '西瓜',
			'cellphone' => '18812341234',
			'address' => '广东省广州市荔湾区动感小西瓜文昌楼4楼A区'
		),array(
			'id' => '2',
			'name' => '西瓜',
			'cellphone' => '18812341234',
			'address' => '广东省广州市荔湾区动感小西瓜文昌楼4楼A区'
		),);

		return view('frontend/address',['title' => '送餐地址','addressinfos' => $addressinfos]);
	}

	public function getAddAddressView()
	{


		return view('frontend/address_add',['title' => '添加地址']);


	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		//



	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
        $formData=$request->only(['address','cellphone','name','sex']);
        $addr= new RecvAddr($formData);
        if($addr->save())
        {
            return Redirect::to('ucenter/recvAddr');
        }
        else
        {
            return Redirect::to('ucnter/recvAddr')->withInput()->withError('添加失败');
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
        return view('')->with('addr',RecvAddr::find($id));
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
        return view('')->with('addr',RecvAddr::find($id));
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
        $formData['id']=$id;
        $addr= new RecvAddr($formData);
        if($addr->save())
        {
            return Redirect::to('ucenter/recvAddr');
        }
        else
        {
            return Redirect::to('')->withInput()->withError('编辑失败');
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

        }
        else
        {

        }
	}

}
