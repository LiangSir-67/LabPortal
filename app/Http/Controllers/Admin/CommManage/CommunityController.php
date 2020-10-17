<?php

namespace App\Http\Controllers\Admin\CommManage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommManage\DeleteArticleRequest;
use App\Http\Requests\Admin\CommManage\DeleteCommentRequest;
use App\Http\Requests\Admin\CommManage\DeleteWordRequest;
use App\Http\Requests\Admin\CommManage\GetArticleRequest;
use App\Http\Requests\Admin\CommManage\GetCommentRequest;
use App\Http\Requests\Admin\CommManage\InsertWordRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Censor;
use App\Models\Comment;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class CommunityController extends Controller
{
    /**
     * 新增审查关键字/词
     * @param InsertWordRequest $request
     *      ['word'] => 新增关键字
     * @return json
     * @author zhuxianglin <github.com/lybbor>
     */
    public function insertWord(Request $request)
    {
        $value = $request['word'];
        $res = Censor::zxl_addWord($value);
        return $res != null ?
            json_success('审查关键字/词添加成功!', null, 200) :
            json_fail('审查关键字/词添加失败!', null, 100);

    }

    /**
     * 删除审查关键字/词
     * @param InsertWordRequest $request
     * @return json
     * @author zhuxianglin <github.com/lybbor>
     */
    public function deleteWord(DeleteWordRequest $request)
    {
        $value = $request->word;
        $res = Censor::zxl_deleteWord($value);
        return $res ?
            json_success('删除关键字/词成功!', null, 200) :
            json_fail('删除关键字/词失败!', null, 100);
    }

    /**
     * 查询审查关键字/词
     * @return json
     * @author zhuxianglin <github.com/lybbor>
     *
     */
    public function getWord()
    {
        $word = Censor::zxl_getWord();
        return json_success('查询关键字/词成功！', $word, 200);
    }

    /**
     * 查询文章详情
     * @author zhuxianglin <github.com/lybbor>
     * @return json
     */
    //查文章详情
    public function getArticleDetail(){
        $article=Article::zxl_getArticleDetail();
        return $article;
    }

    public function pageArticle(Request $request){
        $hhh=$this->getArticleDetail();
        $perPage = 8;            //每页显示数量
        if ($request->has('page')) {
            $current_page = $request->input('page');
            $current_page = $current_page <= 0 ? 1 :$current_page;
        }
        else {
            $current_page = 1;
        }
        $item = array_slice($hhh,($current_page-1)*$perPage, $perPage);
        $totals = count($hhh);
        $paginator =new LengthAwarePaginator($item, $totals, $perPage, $current_page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        return response()->json(['code'=> 200,'msg'=>'页数显示成功','data'=>$paginator]);
    }

    /**
     * 删除文章
     * @return json
     * @author zhuxianglin <github.com/lybbor>
     *
     */
    public function deleteArticle(DeleteArticleRequest $request)
    {
        $article = $request->all();
        $res = Article::zxl_deleteArticle($article);
        //dd($res);
        return $res ?
            json_success('删除文章成功！', null, 200) :
            json_fail('删除文章失败！', null, 100);
    }


    /**
     * 查评论
     * @author zhuxianglin <github.com/lybbor>
     * @return void
     */
    //查评论详情
    public function getCommentDetail(){
        $comment=Comment::zxl_getCommentDetail();
        return $comment;
    }

    public function pageComment(Request $request){
        $hhh=$this->getCommentDetail();
        $perPage = 8;            //每页显示数量
        if ($request->has('page')) {
            $current_page = $request->input('page');
            $current_page = $current_page <= 0 ? 1 :$current_page;
        }
        else {
            $current_page = 1;
        }
        $item = array_slice($hhh,($current_page-1)*$perPage, $perPage);
        $totals = count($hhh);
        $paginator =new LengthAwarePaginator($item, $totals, $perPage, $current_page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
        return response()->json(['code'=> 200,'msg'=>'页数显示成功','data'=>$paginator]);
    }

    /**
     * 删除评论
     * @return void
     * @author zhuxianglin <github.com/lybbor>
     */
    public function deleteComment(DeleteCommentRequest $request)
    {
        $cmtid = $request->all();
        $res = Comment::zxl_deleteComment($cmtid['comment_id']);
        return $res ?
            json_success('删除评论成功！', null, 200) :
            json_fail('删除评论失败！', null, 100);
    }

    /**
     * 单条文章查询
     * @return void
     * @author zhuxianglin <github.com/lybbor>
     */
    public function  getArticle(GetArticleRequest $request)
    {
        $atcid=$request->all();
        $res=Article::zxl_getArticle($atcid['article_id']);
        return json_success('文章查询成功！', $res, 200) ;
    }

    /**
     * 单条评论查询
     * @return void
     * @author zhuxianglin <github.com/lybbor>
     */
    public function  getComment(GetCommentRequest $request)
    {
        $cmtid=$request->all();
        $res=Comment::zxl_getComment($cmtid['comment_id']);
        return json_success('评论查询成功！',$res, 200) ;
    }



}
