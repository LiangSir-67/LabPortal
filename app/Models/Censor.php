<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Censor extends Model
{
    protected $table = "censor";
    public $timestamps = true;
    protected $primaryKey = 'censor_id';
    protected $guarded = [];


    /**
     * 获取所有编号
     * @auther ZhongChun <github.com/RobbEr929>
     * @return mixed
     */
    public static function getNumber()
    {
        try {
            $data = self::select('word')
                ->groupBy('word')
                ->pluck('word');
            return $data;
        } catch (\Exception $e) {
            logError('获取用户信息错误', [$e->getMessage()]);
        }
    }

    /**
     * 新增审查关键字/词
     * @param [string] $value
     * @return void
     * @author zhuxianglin <github.com/lybbor>
     */
    public static function zxl_addWord($value)
    {
        try {
            $model = new Censor();
            $model->word = $value;
            $res = $model->save();
            return $res;
        } catch (Exception $e) {
            logError('新增审查关键字/词失败！', $value, '状态时失败', [$e->getMessage()]);
            return null;
        }
    }


    /**
     * 获取关键字出现次数
     * @auther ZhongChun <github.com/RobbEr929>
     * @param $zc
     * @return mixed
     */
    public static function getComNumber($zc)
    {
        try {
            $res = self::where('word', '=', $zc)
                ->select('word')
                ->count();
            return $res;
        } catch (\Exception $e) {
            logError('获取用户信息错误', [$e->getMessage()]);
        }
    }

    /*
     * 删除审查关键字/词
     * @author zhuxianglin <github.com/lybbor>
     * @param [type] $value
     * @return void
     */
    public static function zxl_deleteword($value)
    {
        try {
            return self::where('word', '=', $value)->delete();
        } catch (Exception $e) {
            logError('删除审查关键字失败', [$e->getMessage()]);
        }
    }

    /**
     * 查询审查关键字/词
     * @return void
     * @author zhuxianglin <github.com/lybbor>
     */
    public static function zxl_getWord()
    {
        try {
            $res = DB::select('select * from censor');
            return $res;
        } catch (Exception $e) {
            logError('查询审查关键字/词失败！状态时失败', [$e->getMessage()]);
            return null;
        }
    }
}
