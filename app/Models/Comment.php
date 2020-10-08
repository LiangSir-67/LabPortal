<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comment";
    public $timestamps = true;
    protected $primaryKey = 'comment_id';
    protected $guarded = [];

    /**
     * 获取所有文章编号
     */
    public static function getNumber(){
        try{
            $res = self::select('article_id')
                ->groupBy('article_id')
                ->pluck('article_id');
            return $res;
        }catch(\Exception $e){
            logError('获取用户信息错误',[$e->getMessage()]);
        }
    }

    /**
     * 获取所有评论编号
     */
    public static function getComNumber($zc){
        try{
            $res = self::where('article_id','=',$zc)
                ->select('comment_id')
                ->count();
            return $res;
        }catch(\Exception $e){
            logError('获取用户信息错误',[$e->getMessage()]);
        }
    }
}
