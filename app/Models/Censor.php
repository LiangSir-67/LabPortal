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

    /**
     * 新增审查关键字/词
     * @author zhuxianglin <github.com/lybbor>
     * @param [string] $value
     * @return void
     */
    public static function zxl_addWord($value) {
        try {
            $model = new Censor();
            $model->word = $value;
            $res= $model ->save();
            return $res;
        }catch(Exception $e){
            logError('新增审查关键字/词失败！',$value,'状态时失败',[$e->getMessage()]);
            return null;
        }
    }

    /**
     * 删除审查关键字/词
     * @author zhuxianglin <github.com/lybbor>
     *
     * @param [type] $value
     * @return void
     */
    public static function zxl_deleteword($value){
        return self::where('word','=',$value)->delete();
    }

    /**
     * 查询审查关键字/词
     * @author zhuxianglin <github.com/lybbor>
     * @return void
     */
    public static function zxl_getWord(){
        try{
            $res=DB::select('select * from censor');
            //dd($res);
            //->paginate(8);
            //dd($res);
            return $res;
        }
        catch(Exception $e){
             logError('查询审查关键字/词失败！状态时失败',[$e->getMessage()]);
             return null;
        }
    }
}
