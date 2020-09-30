<?php

namespace App\Models;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Censor;
class Comment extends Model
{
    protected $table = "comment";
    public $timestamps = true;
    protected $primaryKey = 'comment_id';

    /**
     * 查询评论
     * @author zhuxianglin <github.com/lybbor>
     * @return void
     */
    public static function zxl_getCommentDetail(){
        try{
                $words=Censor::pluck('word');
                $datas = [];
                for($i = 0;$i<count($words);$i++) {
                    $word = $words[$i];
                    $res = self::select('comment_id','information_id','comment_content')
                               ->where('comment_content','like','%'.$word.'%')
                               ->get();
                    if(!empty($res[0]->comment_content)){
                        for($j=0;$j<count($res);$j++)
                        {
                        $datas[$i] = $res[$j];
                    }
                    }
                }
                $result = array_unique($datas);
                return $datas;
            }
        catch(\Exception $e){
            logError('查询评论失败！',null,'error',[$e->getMessage()]);
            return null;
       }
    }

    /**
     * 删除评论
     * @author zhuxianglin <github.com/lybbor>
     * @return void
     */
    public static function zxl_deleteComment($value){
        try{
            // dd($value);
            $res=self::where('comment_id','=',$value)->forceDelete();
            // dd($res);
            return $res;
        } catch(Exception $e){
            logError('删除评论失败！',null,'状态时失败',[$e->getMessage()]);
            return $res;
       }
    }
}
