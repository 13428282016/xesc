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
    'admin/auth'=>'Admin\AuthController',

]);
Route::get('/', ['middleware' => 'openID','uses'=>'IndexController@index']);


Route::group(['prefix'=>'admin','middleware'=>'admin','namespace'=>'Admin'],function(){
    Route::resources([
            'dishes'=>'DishesController',
            'order'=>'OrderController',
            'user'=>'UserController'
        ]
    );
    Route::get('/','HomeController@index');
    Route::controllers([
        'order'=>'OrderController'
        ]);

});

Route::group(['middleware'=>'openID','namespace'=>'ucenter'],function(){

    Route::resources([

            'recvaddr'=>'RecvAddrController',
            'order'=>'OrderController',

        ]
    );
    Route::controllers([
        'order'=>'OrderController',

        'cart'=>'CartController',

    ]);

});
