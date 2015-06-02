<?php namespace xesc\Http\Controllers\admin;

use Illuminate\Support\Facades\View;
use xesc\Http\Requests;
use xesc\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AuthController extends Controller {


    /*
     * 后台管理员模型
     *
     * @var $auth
     */
    protected $auth;

    /*
     *
     * 登录页面
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return View('admin.auth.login');
    }

    public  function  postLogin()
    {

    }







}
