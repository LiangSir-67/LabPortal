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
