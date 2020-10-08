<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Censor extends Model
{
    protected $table = "censor";
    public $timestamps = true;
    protected $primaryKey = 'censor_id';
    protected $guarded = [];


    /**
     * 获取所有编号
     */
    public static function getNumber(){
        try{
            $data = self::select('word')
                ->groupBy('word')
                ->pluck('word');
            return $data;
        }catch(\Exception $e){
            logError('获取用户信息错误',[$e->getMessage()]);
        }
    }

    /**
     *
     */
    public static function getComNumber($zc){
        try{
            $res = self::where('word','=',$zc)
                ->select('word')
                ->count();
            return $res;
        }catch(\Exception $e){
            logError('获取用户信息错误',[$e->getMessage()]);
        }
    }
}
