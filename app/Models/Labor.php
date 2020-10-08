<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Labor extends Model
{
    protected $table = "labor";
    public $timestamps = true;
    protected $primaryKey = 'labor_id';
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
