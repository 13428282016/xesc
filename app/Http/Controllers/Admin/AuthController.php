<?php namespace xesc\Http\Controllers\admin;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use xesc\Admin;
use xesc\Http\Requests;
use xesc\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
class AuthController extends Controller {


    /*
     * 后台管理员模型
     *
     * @var $auth
     */
    protected $auth;

    protected $session;

    /*
     *
     * 登录页面
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        if($this->isLogin())
        {
            return redirect('admin');
        }

        return View('admin.auth.login');
    }

    public  function  postLogin(Request $request)
    {

        $this->validate($request,[
            'account'=>'required',
            'password'=>'required'
        ]);

        $admin=$request->only(['account','password']);

        if($this->check($admin))
        {
            $this->login($admin);
            return redirect('admin');
        }
        else
        {
            return redirect('admin/auth/login')->withErrors(['auth'=>'用户名或密码错误'])->withInput($request->only('account'));
        }



    }

    function  login($admin)
    {
        $this->session->set('admin',$admin);

    }

    function  check($admin)
    {

        if($this->isLogin())
        {
            return true;
        }
        $admin=Admin::where('account',$admin['account'])->where('password',$admin['password'])->get();
        if($admin->isEmpty())
        {
            return false;
        }
        else
        {
            $this->session->set('admin',$admin->first());
            return true;
        }

    }
    function isLogin()
    {
        if($this->session->get('admin'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function getLogout(SessionInterface $session)
    {
        $this->logout($session);
        return redirect('admin/auth/login');
    }

    function logout()
    {
        $this->session->remove('admin');

    }

    public function __construct(SessionInterface $session)
    {
        $this->session=$session;

    }









}
