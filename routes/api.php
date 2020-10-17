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

/**
 * @author yangsiqi<github.com/Double-R111>
 */
Route::prefix('admin/membermanager')->namespace('Admin\MemberManage')->group(function () {
    Route::post('registstatus', 'ApplicationStatusController@registStatus');
    Route::post('addmembers', 'ApplicationManagerController@addMembers');
    Route::get('inquiremembers', 'ApplicationManagerController@inquireMembers');
    Route::get('showmembers', 'ApplicationManagerController@showMembers');
    Route::post('selfinformation', 'SelfInformationController@selfInformation');
    Route::post('setstatus','ApplicationStatusController@setStatus');
    Route::post('emailconfirm', 'EmailConfirmController@emailConfirm');
    Route::get('showdetails', 'ApplicationManagerController@showDetails');
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

    Route::get('show', 'BulletinNewsController@show');//展示
    Route::post('operation', 'BulletinNewsController@operation');//操作
    Route::get('select', 'BulletinNewsController@select');//模糊查询
    Route::post('edit', 'BulletinNewsController@edit');//编辑

    Route::post('addtosql', 'LabController@addToSql');//将实验室介绍插入数据库的Labor表

    Route::get('showteacher', 'MemberIntroController@showTeacher');//展示指导老师信息
    Route::post('deleteteacher', 'MemberIntroController@deleteTeacher');//删除指导老师信息
    Route::post('updateteacher', 'MemberIntroController@updateTeacher');//修改指导老师信息
    Route::post('addteacher', 'MemberIntroController@addTeacher');//新增指导老师信息
    Route::post('reshowteacher','MemberIntroController@reShowTeacher');//回显指导老师信息
    Route::get('showgoodmem', 'MemberIntroController@showGoodMem');//展示优秀成员信息
    Route::post('deletegoodmem', 'MemberIntroController@deleteGoodMem');//删除优秀成员信息
    Route::post('updategoodmem', 'MemberIntroController@updateGoodMem');//修改指导老师信息
    Route::post('addgoodmem', 'MemberIntroController@addGoodMem');//增加优秀成员信息
    Route::post('reshowgoodmem', 'MemberIntroController@reShowGoodMem');//增加优秀成员信息


    Route::get('showfriendurl', 'FriendUrlController@showFriendUrl');//展示友链
    Route::post('deletefriendurl', 'FriendUrlController@deleteFriendUrl');//删除友链
    Route::post('updatefriendurl', 'FriendUrlController@updateFriendUrl');//更新友链
    Route::post('addfriendurl', 'FriendUrlController@addFriendUrl');//新增友链
    Route::post('reshowfriendurl', 'FriendUrlController@reShowFriendUrl');//回显友链
});


Route::prefix('community')->namespace('Admin\CommManage')->group(function () {
    Route::POST('insertword', 'CommunityController@insertWord');
    Route::post('deleteword', 'CommunityController@deleteWord');
    Route::GET('getword', 'CommunityController@getWord');
    Route::GET('getarticledetail', 'CommunityController@getArticleDetail');
    Route::post('deletearticle', 'CommunityController@deleteArticle');
    Route::GET('getcommentdetail', 'CommunityController@getCommentDetail');
    Route::post('deletecomment', 'CommunityController@deleteComment');
    Route::GET('getarticle','CommunityController@getArticle');
    Route::GET('getcomment','CommunityController@getComment');
});

/**
 * @author tangbangyan <github.com/doublebean>
 */
Route::prefix('labhome')->namespace('LabHome')->group(function () {
    Route::get('getrotationpicture', 'IntroduceLabController@getrotationpicture');//提供轮播图URL
    Route::get('getteachercontent', 'IntroduceLabController@getteachercontent');//提供指导老师图片及内容
    Route::get('getexcellentcontent', 'IntroduceLabController@getexcellentcontent');//提供优秀成员图片及简介
    Route::get('getfriendcontet', 'IntroduceLabController@getfriendcontet');//提供主页友链图片及其简介
    Route::get('getfriendhomepage','IntroduceLabController@getfriendhomepage');//提供友链专门页面的图片简介和分页功能c
    Route::get('getlabenvironment', 'IntroduceLabController@getlabenvironment');//提供实验室环境图片和内容
    Route::get('getlaborganization', 'IntroduceLabController@getlaborganization');//提供组织架构图片和内容
    Route::get('getlabdirection', 'IntroduceLabController@getlabdirection');//提供实验室方向图片和内容
    Route::get('getlabcontent', 'IntroduceLabController@getlabcontent');//提供主页实验室展示内容和图片
    Route::get('getlabtitle', 'IntroduceLabController@getlabtitle');//主页新闻公告的标题，时间
    Route::get('getlabnewcontent','IntroduceLabController@getlabnewcontent'); //提供聚焦实验室，实验室公告，实验室新闻标题,内容,时间,图片
    Route::post('getlabnew','IntroduceLabController@getlabnew'); //传给我新闻标题我返回具体内容
});

Route::post('admin/commmanage/insertmember', 'Admin\CommManage\OperateController@insertMember');//插入成员
Route::get('admin/commmanage/showmember', 'Admin\CommManage\OperateController@showMember');//展示成员
Route::get('admin/commmanage/querymember', 'Admin\CommManage\OperateController@queryMember');//查询成员
Route::post('admin/commmanage/modifymember', 'Admin\CommManage\OperateController@modifyMember');//修改状态

