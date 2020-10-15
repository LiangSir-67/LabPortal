<?php

namespace App\Models;

use Carbon\Carbon;
use http\Exception;
use Illuminate\Database\Eloquent\Model;

class GoodMember extends Model
{
    protected $table = "good_members";
    public $timestamps = true;
    protected $primaryKey = 'member_id';
    protected $guarded = [];


    /**
     * 展示成员表
     * @auther ZhongChun <github.com/RobbEr929>
     * return [string]
     */
    public static function zc_show()
    {
        try {
            $res = GoodMember::orderBy('priority', 'asc')
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
            $res = GoodMember::where('member_id', $zc['member_id'])
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
            $res = GoodMember::where('member_id', $zc['member_id'])
                ->update([
                    'name' => $zc['name'],
                    'gm_bridf' => $zc['gm_bridf'],
                    'member_url' => $zc['member_url'],
                    'priority' => $zc['priority'],
                    'updated_at' => $zc['updated_at']
                ]);
            return true;
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
            $res = GoodMember::insert([
                'name' => $zc['name'],
                'gm_bridf' => $zc['gm_bridf'],
                'member_url' => $zc['member_url'],
                'priority' => $zc['priority'],
                'created_at' => $zc['created_at'],
                'updated_at' => $zc['updated_at']
            ]);
            return true;
        } catch (\Exception $e) {
            logError('增加错误', [$e->getMessage()]);
            return false;
        }
    }


    /**
     * 通过优先级获取在goodmemeber表中的数据
     * @param $id
     * @return mixed
     * @author tangbangyan <github.com/doublebean>
     */
    public static function tby_getExcellentContent()
    {
        try {
            $date = self::select('name', 'member_url', 'gm_bridf')
                ->orderby('priority', 'asc')
                ->take(3)
                ->get();

            return $date;
        } catch (Exception $e) {
            logger::Error('没找到优秀成员信息', [$e->getMessage()]);
        }
    }
}
