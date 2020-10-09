<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('auth')->namespace('Auth')->group(function () {
    Route::post('login', 'AuthController@login'); //登陆
    Route::post('logout', 'AuthController@logout'); //退出登陆
    Route::post('refresh', 'AuthController@refresh'); //刷新token
    Route::post('register', 'AuthController@registered'); //刷新token
});
Route::post('admin/commmanage/insertmember','Admin\CommManage\OperateController@insertMember');//插入成员
//Route::get('admin/commmanage/selectall','Admin\CommManage\OperateController@selectAll');//插入成员
Route::get('admin/commmanage/showmember','Admin\CommManage\OperateController@showMember');//展示成员
Route::get('admin/commmanage/querymember','Admin\CommManage\OperateController@queryMember');//查询成员
Route::post('admin/commmanage/modifymember','Admin\CommManage\OperateController@modifyMember');//修改状态
