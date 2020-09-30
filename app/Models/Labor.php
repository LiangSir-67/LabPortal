<?php

namespace App\Models;

use http\Exception;
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


}
