<?php namespace xesc\Http\Middleware;

use Closure;

class Admin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

        $admin=$request->session()->get('admin');

        if(!$admin)
        {
            return redirect('admin/auth/login');
        }
        $admin=\xesc\Admin::findOrFail($admin->id);
        $request->session()->set('admin',$admin);
		return $next($request);
	}

}
