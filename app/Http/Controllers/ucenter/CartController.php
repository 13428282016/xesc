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

        $cartDishes=DB::table('cart_dishes_mid')->where('dishes_id',$cartItem['dishes_id'])->where('cart_id',$cart->id)->get();
        if(count($cartDishes))
        {
            $cart->dishes()->updateExistingPivot($cartDishes[0]->dishes_id,['amount'=>$cartDishes[0]->amount+1]);
        }
        else
        {
            $cart->dishes()->attach($cartItem['dishes_id'],['amount'=>1]);
        }





    }
    public  function  postDecreaseDishes(Request $request)
    {
        $cartItem=$request->only(['dishes_id','open_id']);
        $user=User::where('open_id',$cartItem['open_id'])->get()->first();
        $cart=$user->cart;
        $cartDishes=DB::table('cart_dishes_mid')->where('dishes_id',$cartItem['dishes_id'])->where('cart_id',$cart->id)->get();
        if(count($cartDishes))
        {
            if($cartDishes[0]->amount>1)
            $cart->dishes()->updateExistingPivot(   $cartItem['dishes_id'],['amount'=>$cartDishes[0]->amount-1]);
            else
                $cart->dishes()->detach($cartItem['dishes_id']);
        }


    }
    public  function  postRemoveDishes(Request $request)
    {
        $cartItem=$request->only(['dishes_id','open_id']);
        $user=User::where('open_id',$cartItem['open_id'])->get()->first();
        $cart=$user->cart;
        $cart->dishes()->detach($cartItem['dishes_id']);

    }
    public  function postClear(Request $request)
    {
        $cartItem=$request->only(['open_id']);
        $user=User::where('open_id',$cartItem['open_id'])->get()->first();
        $cart=$user->cart;
        $cart->dishes()->detach();
    }



}
