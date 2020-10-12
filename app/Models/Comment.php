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
    protected $guarded = [];

    /**
     * 获取所有文章编号
     */
    public static function getNumber()
    {
        try {
            $res = self::select('article_id')
                ->groupBy('article_id')
                ->pluck('article_id');
            return $res;
        } catch (\Exception $e) {
            logError('获取用户信息错误', [$e->getMessage()]);
        }
    }

    /**
     * 获取所有评论编号
     */
    public static function getComNumber($zc)
    {
        try {
            $res = self::where('article_id', '=', $zc)
                ->select('comment_id')
                ->count();
            return $res;
        } catch (\Exception $e) {
            logError('获取用户信息错误', [$e->getMessage()]);
        }
    }

    /**
     * 查询评论
     * @return void
     * @author zhuxianglin <github.com/lybbor>
     */
    public static function zxl_getCommentDetail()
    {
        try {
            $words = Censor::pluck('word');
            $datas = [];
            for ($i = 0; $i < count($words); $i++) {
                $word = $words[$i];
                $res = self::select('comment_id', 'information_id', 'comment_content')
                    ->where('comment_content', 'like', '%' . $word . '%')
                    ->get();
                if (!empty($res[0]->comment_content)) {
                    for ($j = 0; $j < count($res); $j++) {
                        $datas[$i] = $res[$j];
                    }
                }
            }
            $result = array_unique($datas);
            return $datas;
        } catch (\Exception $e) {
            logError('查询评论失败！', null, 'error', [$e->getMessage()]);
            return null;
        }
    }

    /**
     * 删除评论
     * @return void
     * @author zhuxianglin <github.com/lybbor>
     */
    public static function zxl_deleteComment($value)
    {
        $res = null;
        try {
            $res = self::where('comment_id', '=', $value)->delete();
            return $res;
        } catch (Exception $e) {
            logError('删除评论失败！', null, '状态时失败', [$e->getMessage()]);
            return $res;
        }
    }
}
