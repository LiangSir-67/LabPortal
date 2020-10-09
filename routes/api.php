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

/*
 * @auther ZhongChun <github.com/RobbEr929>
 */
Route::get('showadmin', 'Admin\AdminPageController@showAdmin');//后台管理主页展示

/*
 * @auther ZhongChun <github.com/RobbEr929>
 */
Route::prefix('pagecontent')->namespace('Admin\PageContent')->group(function () {//页面内容路由组
    Route::post('addcontenttosql', 'PageContentController@addContentToSql');//将获取到的内容插入数据库的Content表

    Route::get('show','BulletinNewsController@show');//展示
    Route::post('operation','BulletinNewsController@operation');//操作
    Route::get('select','BulletinNewsController@select');//模糊查询
    Route::post('edit','BulletinNewsController@edit');//编辑

    Route::post('addtosql','LabController@addToSql');//将实验室介绍插入数据库的Labor表

    Route::get('showteacher','MemberIntroController@showTeacher');//展示指导老师信息
    Route::post('deleteteacher','MemberIntroController@deleteTeacher');//删除指导老师信息
    Route::post('updateteacher','MemberIntroController@updateTeacher');//修改指导老师信息
    Route::post('addteacher','MemberIntroController@addTeacher');//新增指导老师信息
    Route::get('showgoodmem','MemberIntroController@showGoodMem');//展示优秀成员信息
    Route::post('deletegoodmem','MemberIntroController@deleteGoodMem');//删除优秀成员信息
    Route::post('updategoodmem','MemberIntroController@updateGoodMem');//修改指导老师信息
    Route::post('addgoodmem','MemberIntroController@addGoodMem');//增加优秀成员信息

    Route::get('showfriendurl','FriendUrlController@showFriendUrl');//展示友链
    Route::post('deletefriendurl','FriendUrlController@deleteFriendUrl');//删除友链
    Route::post('updatefriendurl','FriendUrlController@updateFriendUrl');//更新友链
    Route::post('addfriendurl','FriendUrlController@addFriendUrl');//新增友链
});




