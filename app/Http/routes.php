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

Route::get('/', function () {
    return view('welcome');
});


//Route::post('/user',  ['as' => 'user.create', 'uses' => 'UserController@postCreate']);

//Dingo/Api
$api = app('Dingo\Api\Routing\Router');

// v1版本的API
// 不需要验证jwt-token

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\V1','middleware'=>'api.throttle', 'limit'=>10, 'expires'=>1], function ($api) {
    # Auth
    // 登录
    $api->post('auth/login', ['as' => 'auth.login', 'uses' => 'AuthController@login']);
    // 注册
    $api->post('auth/register', ['as' => 'auth.register', 'uses' => 'AuthController@register']);

    //上传
    $api->post('upload/img', 'UploadController@imgUpload');

    # Article
    // 列表
    $api->get('articles', ['as' => 'article.index','uses' => 'ArticleController@index']);

    // 需要jwt验证后才能使用的API
    $api->group([], function ($api) {
        # Auth
        // 刷新token
        $api->post('auth/refreshToken', ['as' => 'auth.refreshToken','uses' => 'AuthController@refreshToken']);
        #User
        //获取所有用户
        $api->get('/users', ['as' => 'users.all', 'uses' => 'UserController@getUsers']);
        // 获得当前登录的个人信息
        $api->get('/user', ['as' => 'user.me', 'uses' => 'UserController@show']);
        //增加用户
        $api->post('/user', ['as' => 'user.create', 'uses' => 'UserController@postCreate']);
        // 获得某个人信息
        $api->get('/user/{id}', ['as' => 'user.show', 'uses' => 'UserController@getUserById']);
        // 更新个人信息
        $api->put('/user/{id}', ['as' => 'user.update', 'uses' => 'UserController@update']);
        // 删除
        $api->delete('/user/{id}', ['as' => 'user.delete', 'uses' => 'UserController@delete']);
        //分页查询用户
        $api->get('/userList', ['as' => 'user.list', 'uses' => 'UserController@getUserList']);
    });
});


// v2版本的API
// header里面需要加    Accept:application/x.laravelapi.v2+json
$api->version('v2', ['namespace' => 'App\Api\Controllers\V2'], function ($api) {
    $api->get('foo', ['as' => 'foo', 'uses' => 'FooController@index']);
});
