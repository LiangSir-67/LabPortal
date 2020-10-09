<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebInformation extends Model
{
    protected $table = "web_information";
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $guarded = [];


    /**
     * 插入数据到表
     * @auther ZhongChun <github.com/RobbEr929>
     * @param [string]$zc
     */
    public static function zc_update($zc)
    {
        try {
            if (!$zc['sc_name'])
                $zc['sc_name'] = "成都东软学院";
            self::where('id', 1)
                ->update([
                    'sc_name' => $zc['sc_name'],
                    'name' => $zc['name'],
                    'title' => $zc['title'],
                    'footer' => $zc['footer']
                ]);
            return true;
        } catch (\Exception $e) {
            logError('填报错误', [$e->getMessage()]);
        }
    }
}
