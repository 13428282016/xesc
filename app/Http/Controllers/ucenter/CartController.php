<?php namespace xesc\Http\Controllers\ucenter;

use DB;
use xesc\Cart;
use xesc\Http\Requests;
use xesc\Http\Controllers\Controller;

use Illuminate\Http\Request;
use xesc\User;

class CartController extends Controller {

	public  function  postIncreaseDishes(Request $request)
    {

        $cartItem=$request->only(['dishes_id']);
        $user=$request->session()->get('user');
        $cart=$user->cart;
        $cartDishes=$cart->dishes()->where('dishes_id',$cartItem['dishes_id'])->get();
        if(count($cartDishes))
        {
            $cart->dishes()->updateExistingPivot($cartItem['dishes_id'],['dishes_amount'=>$cartDishes->first()->pivot->dishes_amount+1]);
        }
        else
        {
            $cart->dishes()->attach($cartItem['dishes_id'],['dishes_amount'=>1]);
        }





    }
    public  function  postDecreaseDishes(Request $request)
    {
        $cartItem=$request->only(['dishes_id']);
        $user=$request->session()->get('user');
        $cart=$user->cart;
        $cartDishes=$cart->dishes()->where('dishes_id',$cartItem['dishes_id'])->get()->first();
        if($cartDishes)
        {
            if($cartDishes->pivot->dishes_amount>1)
                $cart->dishes()->updateExistingPivot($cartItem['dishes_id'],['dishes_amount'=>$cartDishes->pivot->dishes_amount-1]);
            else
                $cart->dishes()->detach($cartItem['dishes_id']);
        }


    }
    public  function  postRemoveDishes(Request $request)
    {
        $cartItem=$request->only(['dishes_id']);
        $user=$request->session()->get('user');
        $cart=$user->cart;
        $cart->dishes()->detach($cartItem['dishes_id']);

    }
    public  function postClear(Request $request)
    {
        $cartItem=$request->only(['dishes_id']);
        $user=$request->session()->get('user');
        $cart=$user->cart;
        $cart->dishes()->detach();
    }

    public function getIndex(Request $request)
    {
        $user=$request->session()->get('user');
            $dishes= $user->cart->dishes;
        return view('cart/index',['dishes'=>$dishes]);
    }



}
