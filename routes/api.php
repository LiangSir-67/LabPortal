<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use Symfony\Component\Routing\Route;
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

Route::prefix('community')->namespace('Admin\CommManage')->group(function(){
    Route::POST('insertword','CommunityController@insertWord');
    Route::post('deleteword','CommunityController@deleteWord');
    Route::GET('getword','CommunityController@getWord');
    Route::GET('getarticledetail','CommunityController@getArticleDetail');
    Route::post('deletearticle','CommunityController@deleteArticle');
    Route::GET('getcommentdetail','CommunityController@getCommentDetail');
    Route::post('deletecomment','CommunityController@deleteComment');
});

/**
 * @author tangbangyan <github.com/doublebean>
 */
Route::prefix('labhome')->namespace('LabHome')->group(function (){
    Route::get('getrotationpicture','IntroduceLabController@getrotationpicture');//提供轮播图URL
    Route::get('getteachercontent','IntroduceLabController@getteachercontent');//提供指导老师图片及内容
    Route::get('getexcellentcontent','IntroduceLabController@getexcellentcontent');//提供优秀成员图片及简介
    Route::get('getfriendcontet','IntroduceLabController@getfriendcontet');//提供主页友链图片及其简介
    Route::get('getlabenvironment','IntroduceLabController@getlabenvironment');//提供实验室环境图片和内容
    Route::get('getlaborganization','IntroduceLabController@getlaborganization');//提供组织架构图片和内容
    Route::get('getlabdirection','IntroduceLabController@getlabdirection');//提供实验室方向图片和内容
    Route::get('getlabcontent','IntroduceLabController@getlabcontent');//提供主页实验室展示内容和图片
    Route::get('getlabtitle','IntroduceLabController@getlabtitle');//主页新闻公告的标题，时间
    Route::get('getlabnewcontent','IntroduceLabController@getlabnewcontent'); //提供聚焦实验室，实验室公告，实验室新闻标题,内容,时间,图片
    Route::get('getlabnew','IntroduceLabController@getlabnew'); //传给我新闻标题我返回具体内容

});

Route::post('admin/commmanage/insertmember','Admin\CommManage\OperateController@insertMember');//插入成员
//Route::get('admin/commmanage/selectall','Admin\CommManage\OperateController@selectAll');//插入成员
Route::get('admin/commmanage/showmember','Admin\CommManage\OperateController@showMember');//展示成员
Route::get('admin/commmanage/querymember','Admin\CommManage\OperateController@queryMember');//查询成员
Route::post('admin/commmanage/modifymember','Admin\CommManage\OperateController@modifyMember');//修改状态

