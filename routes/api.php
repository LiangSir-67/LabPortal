<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
/**
 * @author yangsiqi<github.com/Double-R111>
 */
Route::prefix('admin/membermanager')->namespace('Admin\MemberManage')->group(function () {
    Route::post('registstatus', 'ApplicationStatusController@registStatus');
    Route::post('addmembers', 'ApplicationManagerController@addMembers');
    Route::post('inquiremembers', 'ApplicationManagerController@inquireMembers');
    Route::post('showmembers', 'ApplicationManagerController@showMembers');
    Route::post('selfinformation', 'SelfInformationController@selfInformation');
    Route::get('emailconfirm', 'EmailConfirmController@emailConfirm');
});

