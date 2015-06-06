<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'IndexController@index');

//Route::get('home', 'HomeController@index');

// order
//Route::get('/order/confirm_order_view','OrderController@confirm_order_view');
//Route::post('/order/make_order', 'OrderController@make_order');


Route::controllers([
	'order'=> 'OrderController',
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
    'admin/auth'=>'Admin\AuthController',
    'cart'=>'ucenter\CartController',
	'address' => 'ucenter\RecvAddrController'
]);



Route::group(['middleware'=>'admin'],function(){
    Route::resources([
            'admin/dishes'=>'Admin\DishesController',
            'admin/order'=>'Admin\OrderController',
            'admin/user'=>'Admin\UserController'
        ]
    );
    Route::get('admin','Admin\HomeController@index');

});

Route::group(['middleware'=>'openID'],function(){
    Route::resources([

            'recvaddr'=>'ucenter\RecvAddrController',
            'order'=>'ucenter\OrderController',

        ]
    );
    Route::controllers([
       'order'=>'ucenter\OrderController',
        'cart'=>'ucenter\CartController',
        '/' => 'IndexController'
    ]);

});
