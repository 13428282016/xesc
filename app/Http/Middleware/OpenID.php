<?php namespace xesc\Http\Middleware;

use Closure;
use xesc\Cart;
use xesc\Http\Requests\Request;
use xesc\User;

class OpenID {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

        $user=$request->session()->get('user');
         if(!$user)
         {
             if(!$request->get('open_id'))
             {
                 abort(404);
             }
             $user=User::where('open_id',$request->get('open_id'))->get()->first();
             if(empty($user))
             {
                 $user=new User();
                 $user->open_id = $request->input('open_id');
                 $user->last_ip=$request->ip();
                 $user->save();

                 $cart = new Cart();
                 $cart->user_id = $user->id;
                 $cart->save();
             }
         }
        else
        {
           $user=User::findOrFail($user->id);
        }
        $request->session()->put('user',$user);


		return $next($request);
	}

}
