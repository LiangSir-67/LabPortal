<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Exception;
use App\Models\Censor;

class Article extends Model
{
    protected $table = "article";
    public $timestamps = true;
    protected $primaryKey = 'article_id';



    /**
     * 获取文章 模糊查询
     * @author zhuxianglin <github.com/lybbor>
     * @return void
     */
    public static function zxl_getArticleDetail(){
        try{
            $words=Censor::pluck('word');
                $datas = [];
                for($i = 0;$i<count($words);$i++) {
                    $word = $words[$i];
                    $res = self::select('article_id','title','neirong')
                               ->where('neirong','like','%'.$word.'%')
                               ->orWhere('title','like','%'.$word.'%')
                               ->get();
                    if(!empty($res[0]->title)){
                        for($j=0;$j<count($res);$j++)
                        {
                        $datas[$i] = $res[$j];
                    }
                }}
                $result = array_unique($datas);
                return $result;
        }
        catch(\Exception $e){
            logError('查询文章失败！',null,'error',[$e->getMessage()]);
            return null;
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
}
