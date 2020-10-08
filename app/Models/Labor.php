<?php

namespace App\Models;


use http\Exception;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Labor extends Model
{
    protected $table = "labor";
    public $timestamps = true;
    protected $primaryKey = 'labor_id';



    /**
     * 提供在labor表中的实验室介绍，和实验室介绍图片数据
     * @author tangbagnyan <github.com/doublebean>
     * @return mixed
     */
    public static function tby_getLabContent()
    {
        try{
            $date=self::select('produce','pro_url')
                ->get();
            return $date;
        }catch(Exception $e){
            logger::Error('没找到实验室介绍图片和内容',[$e->getMessage()]);
        }
    }
    /**
     * 提供在labor表中的实验室环境内容和图片数据
     * @author tangbagnyan <github.com/doublebean>
     * @return mixed
     */
    public static function tby_getLabEnvironment()
    {
        try{
            $date=self::select('enviroment','env_url')
                ->get();
            return $date;
        }catch(Exception $e){
            logger::Error('没找到环境介绍图片和内容',[$e->getMessage()]);
        }
    }
    /**
     * 提供在labor表中的实验室架构内容和图片数据
     * @author tangbagnyan <github.com/doublebean>
     * @return mixed
     */
    public static function tby_getLabOrganization()
    {
        try{
            $date=self::select('architect','arc_url')
                ->get();
            return $date;
        }catch(Exception $e){
            logger::Error('没找到架构介绍图片和内容',[$e->getMessage()]);
        }
    }
    /**
     * 提供在labor表中的实验室方向内容和图片数据
     * @author tangbagnyan <github.com/doublebean>
     * @return mixed
     */
    public static function tby_getLabDirection()
    {
        try{
            $date=self::select('direction','dir_url')
                ->get();
            return $date;
        }catch(Exception $e){
            logger::Error('没找到实验室介绍图片和内容',[$e->getMessage()]);
        }
    }


    protected $guarded = [];


    /**
     * 插入数据到表
     * @auther ZhongChun <github.com/RobbEr929>
     * @param [string]$zc
     */
    public static function zc_update($zc)
    {
        try {
            $zc['updated_at'] = Carbon::now()->toDateTimeString();
            self::where('labor_id',1)
                ->update([
                    'produce'=>$zc['produce'],
                    'pro_url'=>$zc['pro_url'],
                    'enviroment'=>$zc['enviroment'],
                    'env_url'=>$zc['env_url'],
                    'architect'=>$zc['architect'],
                    'arc_url'=>$zc['arc_url'],
                    'direction'=>$zc['direction'],
                    'dir_url'=>$zc['dir_url']
                ]);
            return true;
        } catch (\Exception $e) {
            logError('填报错误', [$e->getMessage()]);
        }
    }
}
