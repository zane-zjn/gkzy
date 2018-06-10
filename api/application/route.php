<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

Route::resource('user', 'index/user');
Route::resource('login', 'index/session');

Route::group('admin', function () {
    Route::post('login', 'admin/index/login');
    Route::get('index', 'admin/index/index');
    Route::resource('user', 'admin/user');
    Route::resource('school','admin/school');
    Route::resource('article','admin/article');
    Route::resource('resources','admin/resources');
    Route::resource('fraction','admin/fraction');
    Route::resource('major','admin/major');
    Route::resource('recruit','admin/recruit');
});
Route::group('index',function (){
    Route::resource('resources','index/resources');
    Route::resource('article','index/article');
    Route::resource('comment','index/comment');
    Route::resource('major','index/major');
    Route::resource('collection','index/collection');
    Route::resource('fraction','index/fraction');
    Route::resource('recruit','index/recruit');
    Route::resource('school','index/school');

});
//Route::any('accessToken','index/auth/accessToken');//Oauth
//Route::group('v1',function (){
//    Route::group('user', function () {
//        Route::resource('/');
//        Route::resource(':id');
//        Route::get('/', 'index/user/index');
//        Route::get(':id', 'index/user/read');
        //        Route::post('/');
//    });
//    Route::resource('user','index/User');
//    Route::resource('user/:id','index/User');
//});

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
