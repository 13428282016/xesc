<?php namespace xesc\Http\Controllers\ucenter;

use DB;
use xesc\Cart;
use xesc\Http\Requests;
use xesc\Http\Controllers\Controller;

use Illuminate\Http\Request;
use xesc\User;

class CartController extends Controller {

	public  function  getIncreaseDishes(Request $request)
    {

        $cartItem=$request->only(['dishes_id','open_id']);
        $cartItem['dishes_id']=3;
        $cartItem['open_id']=1;
        $user=User::where('open_id',$cartItem['open_id'])->get()->first();
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
    public  function  getDecreaseDishes(Request $request)
    {
        $cartItem=$request->only(['dishes_id','open_id']);
        $cartItem['dishes_id']=3;
        $cartItem['open_id']=1;
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
    public  function  getRemoveDishes(Request $request)
    {
        $cartItem=$request->only(['dishes_id','open_id']);
        $cartItem['dishes_id']=1;
        $cartItem['open_id']=1;
        $user=User::where('open_id',$cartItem['open_id'])->get()->first();
        $cart=$user->cart;
        $cart->dishes()->detach($cartItem['dishes_id']);

    }
    public  function getClear()
    {
        $cartItem['dishes_id']=1;
        $cartItem['open_id']=1;
        $user=User::where('open_id',$cartItem['open_id'])->get()->first();
        $cart=$user->cart;
        $cart->dishes()->detach();
    }



}
