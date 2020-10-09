<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    logInfo('网站部署成功');
    return json_success('网站部署成功');
});
Route::get('test', 'TestController@test');

Route::prefix('admin/membermanage/regist')->namespace('Admin\MemberManage')->group(
    function () {
        Route::get('registStatus', 'RegistStatusController@registStatus');
        Route::get('self_Information', 'RegistController@self_Information');
        Route::get('addMembers', 'RegistManagerController@addMembers');
        Route::get('inquireMembers', 'RegistManagerController@inquireMembers');
        Route::get('emailConfirm', 'EmailConfirmController@emailConfirm');
    }
);
