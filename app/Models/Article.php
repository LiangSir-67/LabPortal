<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Exception;

class Article extends Model
{
    protected $table = "article";
    public $timestamps = true;
//    protected $primaryKey = 'article_id';
    protected $guarded = [];


    /**
     * 搜索表中点赞最高
     * @auther ZhongChun <github.com/RobbEr929>
     * return [string]
     */
    public static function zc_point(){
        try {
            $res = Article::join('like','article.article_id','like.article_id')
                ->select('article.title')
                ->orderBy('like.count','desc')
                ->get();
            return $res;
        }catch (\Exception $e){
            logError('搜索失败',[$e->getMessage()]);
        }
    }

    /**
     * 搜索表中评论最高
     * @auther ZhongChun <github.com/RobbEr929>
     * return [string]
     */
    public static function zc_comment(){
        try {
            $num =0;
            $max = 0;
            $Number = Comment::getNumber();
            foreach($Number as $value){
                $max = Comment::getComNumber($value);
                if ($num < $max){
                    $num = $max;
                    $max = $value;
                }
            }
            $res = Article::select('title')
                ->where('article_id',$max)
                ->get();
            return $res;
        }catch (\Exception $e){
            logError('搜索失败',[$e->getMessage()]);
        }
    }

    /**
     * 返回网站的数据
     * @auther ZhongChun <github.com/RobbEr929>
     * return [string]
     */
    public static function zc_web(){
        try {
            $res = WebInformation::where('id',1)
                ->select('name','sc_name')
                ->get();
            return $res;
        }catch (\Exception $e){
            logError('搜索失败',[$e->getMessage()]);
        }
    }

    /**
     * 返回注册的数据
     * @auther ZhongChun <github.com/RobbEr929>
     * return [string]
     */
    public static function zc_register(){
        try {
            $res = Application::count('*');
            return $res;
        }catch (\Exception $e){
            logError('搜索失败',[$e->getMessage()]);
        }
    }

    /**
     * 返回文章总量的数据
     * @auther ZhongChun <github.com/RobbEr929>
     * return [string]
     */
    public static function zc_total(){
        try {
            $res = Article::count();
            return $res;
        }catch (\Exception $e){
            logError('搜索失败',[$e->getMessage()]);
        }
    }

    /**
     * 返回关键词的数据
     * @auther ZhongChun <github.com/RobbEr929>
     * return [string]
     */
    public static function zc_totalWord(){
        try {
            $num =0;
            $max = 0;
            $Number = Censor::getNumber();
            foreach($Number as $value){
                $max = Censor::getComNumber($value);
                if ($num < $max){
                    $num = $max;
                    $max = $value;
                }
            }
            return $max;
        }catch (\Exception $e){
            logError('搜索失败',[$e->getMessage()]);
        }
    }


    /**
     * 获取文章 模糊查询
     * @author zhuxianglin <github.com/lybbor>
     * @return void
     */
    public static function zxl_getArticleDetail(){
        try{
            //先得到关键字 article
            $words=Censor::pluck('word');
            $datas = [];
            $flag = 0;
            for($i = 0;$i<count($words);$i++) {
                $word = $words[$i];
                $res = self::select('article_id','title','neirong')
                    ->where('neirong','like','%'.$word.'%')
                    ->orWhere('title','like','%'.$word.'%')
                    ->get();
                if(!empty($res[0]->neirong)){
                    for($x = 0;$x < count($res);$x++) {
                        $datas[$flag] = $res[$x];
                        $flag++;
                    }
                }
            }
            return array_unique($datas);
        } catch(\Exception $e){
            logError('查询评论失败！',null,'error',[$e->getMessage()]);
            return 1;
        }

    }





    /**
     * 删除文章
     * @author zhuxianglin <github.com/lybbor>
     * @return void
     */
    public static function zxl_deleteArticle($value){
        try{
            $res=self::where('article_id','=',$value)->delete();
            return $res;
        }
        catch(Exception $e){
            logError('删除文章失败！',null,'状态时失败',[$e->getMessage()]);
            return null;
       }
    }

    /**
     * 查询单个文章
     * @author zhuxianglin <github.com/lybbor>
     * @return void
     */
    public  static  function zxl_getArticle($value){
        try{
            $res=self::where('article_id','=',$value)->get();
            return $res;
        }
        catch(Exception $e){
            logError('查询文章失败！',null,'状态时失败',[$e->getMessage()]);
            return null;
        }
    }
}
