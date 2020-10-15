<?php

namespace App\Models;

use Carbon\Carbon;
use http\Exception;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = "teacher";
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [];


    /**
     * 展示表
     * @auther ZhongChun <github.com/RobbEr929>
     * return [string]
     */
    public static function zc_show()
    {
        try {
            $res = Teacher::orderBy('priority', 'asc')
                ->paginate(8);
            return $res;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
        }
    }

    /**
     * 删除表中数据
     * @auther ZhongChun <github.com/RobbEr929>
     * @param [string]
     */
    public static function zc_delete($zc)
    {
        try {
            $res = Teacher::where('id', $zc['id'])
                ->delete();
            return $res == 1?
                true:
                false;
        } catch (\Exception $e) {
            logError('删除错误', [$e->getMessage()]);
        }
    }

    /**
     * 修改表中数据
     * @auther ZhongChun <github.com/RobbEr929>
     * @param [string]
     */
    public static function zc_update($zc)
    {
        try {
            $zc['updated_at'] = Carbon::now()->toDateTimeString();
            $res = Teacher::where('id', $zc['id'])
                ->update([
                    'name' => $zc['name'],
                    'profession' => $zc['profession'],
                    't_url' => $zc['t_url'],
                    't_bridf' => $zc['t_bridf'],
                    'priority' => $zc['priority'],
                ]);
            return $res == 1?
                true:
                false;
        } catch (\Exception $e) {
            logError('修改错误', [$e->getMessage()]);
        }
    }

    /**
     * 新增数据
     * @auther ZhongChun <github.com/RobbEr929>
     * @param [string]
     */
    public static function zc_insert($zc)
    {
        try {
            $zc['created_at'] = Carbon::now()->toDateTimeString();
            $zc['updated_at'] = $zc['created_at'];
            $res = Teacher::insert([
                'name' => $zc['name'],
                'profession' => $zc['profession'],
                't_url' => $zc['t_url'],
                't_bridf' => $zc['t_bridf'],
                'priority' => $zc['priority'],
                'created_at' => $zc['created_at'],
                'updated_at' => $zc['updated_at']
            ]);
            return true;
        } catch (\Exception $e) {
            logError('增加错误', [$e->getMessage()]);
        }
    }

    /**
     * 返回老师名字，职称，介绍，图片
     * @return mixed
     * @author tangbangyan <github.com/doublebean>
     */
    public static function tby_getTeacherContent()
    {
        try {

            $date = self::select('name', 'profession', 't_url', 't_bridf')
                ->orderby('priority', 'asc')
                ->get();

            return $date;
        } catch (Exception $e) {
            logger::Error('没找到该图片', [$e->getMessage()]);
        }
    }
}
