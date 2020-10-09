<?php

namespace App\Http\Controllers\Admin\CommManage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommManage\DeleteArticleRequest;
use App\Http\Requests\Admin\CommManage\DeleteCommentRequest;
use App\Http\Requests\Admin\CommManage\DeleteWordRequest;
use App\Http\Requests\Admin\CommManage\InsertWordRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Censor;
use App\Models\Comment;

class CommunityController extends Controller
{
    //插入关键字
    /**
     * 新增审查关键字/词
     * @author zhuxianglin <github.com/lybbor>
     * @param InsertWordRequest $request
     *      ['word'] => 新增关键字
     * @return json
     */
    public function insertWord(Request $request){
        $value = $request['word'];
        $res = Censor::zxl_addWord($value);
        return  $res !=null?
        json_success('审查关键字/词添加成功!',null,200):
        json_fail('审查关键字/词添加失败!',null,100);

    }

    /**
     * 删除审查关键字/词
     * @author zhuxianglin <github.com/lybbor>
     * @param InsertWordRequest $request
     * @return json
     */
    //删除关键字
    public function deleteWord(DeleteWordRequest $request){
        $value=$request->word;
        $res=Censor::zxl_deleteWord($value);
        return $res ?
            json_success('删除关键字/词成功!',null,200) :
            json_fail('删除关键字/词失败!',null,100);
    }

    /**
     * 查询审查关键字/词
     * @author zhuxianglin <github.com/lybbor>
     *
     * @return json
     */
    //查询关键字
    public function getWord(){
        $word=Censor::zxl_getWord();
        return json_success('查询关键字/词成功！',$word,200) ;
    }

    /**
     * 查询文章详情
     * @author zhuxianglin <github.com/lybbor>
     * @return json
     */
    //查文章详情
    public function getArticleDetail(){
        $article=Article::zxl_getArticleDetail();
        return json_success('查询文章成功！',$article,200) ;
    }
    /**
     * 删除文章
     * @author zhuxianglin <github.com/lybbor>
     *
     * @return json
     */
    //删除文章
    public function deleteArticle(DeleteArticleRequest $request){
        $article=$request->all();
        $res=Article::zxl_deleteArticle($article);
        //dd($res);
        return $res ?
            json_success('删除文章成功！',null,200) :
            json_fail('删除文章失败！',null,100);
    }


    /**
     * 查评论
     * @author zhuxianglin <github.com/lybbor>
     * @return void
     */
    //查评论详情
    public function getCommentDetail(){
        $comment=Comment::zxl_getCommentDetail();
        return json_success('查询评论成功！',$comment,200) ;
    }



    /**
     * 删除评论
     * @author zhuxianglin <github.com/lybbor>
     * @return void
     */
    //删除评论
    public function deleteComment(DeleteCommentRequest $request){
        $cmtid=$request->all();
        //dd($cmtid['comment_id']);
        $res=Comment::zxl_deleteComment($cmtid['comment_id']);
        dd($res);
        return $res ?
            json_success('删除评论成功！',null,200) :
            json_fail('删除评论失败！',null,100);
    }


}
