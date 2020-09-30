<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Content extends Model
{
    protected $table = "content";
    public $timestamps = true;
    protected $primaryKey = 'nb_id';
    protected $guarded = [];

    /**
     * 插入数据到表
     * @auther ZhongChun <github.com/RobbEr929>
     * @param [string]$zc
     */
    public static function zc_insert($zc)
    {
        try {
            $zc['created_at'] = Carbon::now()->toDateTimeString();
            $zc['updated_at'] = $zc['created_at'];
            self::insert([
                'title' => $zc['title'],
                'p_url' => $zc['p_url'],
                'priority' => $zc['priority'],
                'neirong' => $zc['neirong'],
                'created_at' => $zc['created_at'],
                'updated_at' => $zc['updated_at']
            ]);
            return true;
        } catch (\Exception $e) {
            logError('填报错误', [$e->getMessage()]);
        }
    }

    /**
     * 获取当前表的nb_id
     * return int
     */
    public static function zc_getid(){
        try {
            $id = self::where('nb_id','>=',1)->max('nb_id');
            return $id;
        }catch (\Exception $e){
            LogError('查找失败',[$e->getMessage()]);
        }
    }

    /**
     * 当关联的表插入失败时 删除所对应关联的表
     * @param $nb_id
     */
    public static function zc_delete($nb_id){
        try {
            self::where('labor_id',$labor_id)
                ->delete();
            return true;
        }catch (\Exception $e){
            LogError('删除失败',[$e->getMessage()]);
        }
    }
}
