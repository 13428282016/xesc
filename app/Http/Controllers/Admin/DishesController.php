<?php namespace xesc\Http\Controllers\admin;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use xesc\Dishes;
use xesc\Http\Requests;
use xesc\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DishesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $rows=10;
        $dishes=Dishes::paginate($rows);
        return view('admin.dishes.index')->with('dishes',$dishes);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//

        return view('admin.dishes.create');

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        $dishes=new Dishes;
        $dishes->name=Input::get('name');
        $dishes->price=Input::get('price');
        $dishes->status=Input::get('status');
        $dishes->image=Input::get('image');
        $dishes->desc=Input::get('desc');
        if($dishes->save())
        {
             return Redirect::to('admin/dishes/'.$dishes->id);
        }
        else
        {
            return Redirect::back()->withInput()->withErrors('添加失败!');
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

        return view('admin.dishes.show')->with('dishes',Dishes::findOrFail($id));

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
        return view('admin.dishes.edit')->with('dishes',Dishes::findOrFail($id));

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

        $dishes=Dishes::findOrFail($id);
        $dishes->name=Input::get('name');
        $dishes->image=Input::get('image');
        $dishes->desc=Input::get('desc');
        $dishes->status=Input::get('status');
        $dishes->price=Input::get('price');
        if($dishes->save())
        {
            return Redirect::to('admin/dishes/'.$id);
        }
        else
        {
            return Redirect::back()->withInput()->withErrors('编辑失败!');
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
        $dishes=Dishes::findOrFail($id);
         if($dishes->delete())
         {
             return redirect('admin/dishes');
         }

    }

}
