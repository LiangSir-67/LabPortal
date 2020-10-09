<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ApplicationSetting extends Model
{
    protected $table = "application_setting";
    public $timestamps = true;
    protected $primaryKey = 'setting_id';

    /***
     * 得到当前报名系统状态
     * @return null
     * @var string
     * @author yangsiqi<github.com/Double-R111>
     */
    public static function getStatus()
    {
        try {
            $res = self::select('setting_status', 'updated_at')
                ->where('setting_id', 1)
                ->get();
            return $res;
        } catch (\Exception $err) {
            logError('报名系统状态获取失败', [$err->getMessage()]);
            return null;
        }
    }

    /**
     * 更改当前报名系统状态
     * @param $value
     * @return null
     * @author yangsiqi<github.com/Double-R111>
     *
     */
    public static function changeStatus($value)
    {
        try {
            $res = self::update([
                'setting_status' => $value
            ])->where('setting_id', 1);

            return $res;
        } catch (\Exception $e) {
            logError('报名系统状态改变失败', [$e->getMessage()]);
            return null;
        }

    }
}
