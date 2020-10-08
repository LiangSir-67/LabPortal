<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use App\Models\Comment;
use App\Models\WebInformation;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    protected $table = "article";
    public $timestamps = true;
    protected $primaryKey = 'article_id';
    protected $guarded = [];


    /**
     * 搜索表中点赞最高
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
}
