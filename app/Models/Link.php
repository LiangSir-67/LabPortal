<?php

namespace App\Models;

use http\Exception;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = "link";
    public $timestamps = true;
    protected $primaryKey = 'link_id';
    protected $guarded = [];


    /**
     * 展示友链
     * @auther ZhongChun <github.com/RobbEr929>
     * return [string]
     */
    public static function zc_show()
    {
        try {
            $zc = self::orderBy('priority', 'asc')
                ->paginate(8);
            return $zc;
        } catch (\Exception $e) {
            logError('搜索失败', [$e->getMessage()]);
        }
    }

    /**
     * 删除友链
     * @auther ZhongChun <github.com/RobbEr929>
     * @param [string]
     */
    public static function zc_delete($zc)
    {
        try {
            $res = self::where('link_id', $zc['link_id'])
                ->delete();
            return $res == 1 ?
                true :
                false;
        } catch (\Exception $e) {
            logError('搜索失败', [$e->getMessage()]);
            return null;
        }
    }

    /**
     * 修改友链
     * @auther ZhongChun <github.com/RobbEr929>
     * @param [string]
     */
    public static function zc_update($zc)
    {
        try {
            $res = Link::where('link_id', $zc['link_id'])
                ->update([
                    'name' => $zc['name'],
                    'produce' => $zc['produce'],
                    'priority' => $zc['priority'],
                    'tx_url' => $zc['tx_url'],
                    'blog_url' => $zc['blog_url']
                ]);

            return $res == 1 ?
                true :
                false;
        } catch (\Exception $e) {
            logError('搜索失败', [$e->getMessage()]);
        }
    }

    /**
     * 新增友链
     * @auther ZhongChun <github.com/RobbEr929>
     * @param [string]
     */
    public static function zc_insert($zc)
    {
        try {
            Link::create([
                'name' => $zc['name'],
                'produce' => $zc['produce'],
                'priority' => $zc['priority'],
                'tx_url' => $zc['tx_url'],
                'blog_url' => $zc['blog_url']
            ]);
            return true;
        } catch (\Exception $e) {
            logError('搜索失败', [$e->getMessage()]);
        }
    }

    /**
     * 返回名字，博客url，图片url，简介
     * @return mixed
     * @author tangbangyan <github.com/doublebean>
     */
    public static function tby_getFriendContet()
    {
        try {
            $date = self::select('name', 'tx_url', 'blog_url', 'produce')
                ->orderby('priority', 'asc')
                ->get();

            return $date;
        } catch (Exception $e) {
            logger::Error('没找到优秀成员信息', [$e->getMessage()]);
        }
    }

    /**
     * 返回友链专门页面的名字，博客url，图片url，简介
     * @return mixed
     * @author tangbangyan <github.com/doublebean>
     */
    public static function tby_getFriendhomepage()
    {
        try {
            $date = self::select('name', 'tx_url', 'blog_url', 'produce')
                ->orderby('priority', 'asc')
                ->paginate();

            return $date;
        } catch (Exception $e) {
            logger::Error('没找到优秀成员信息', [$e->getMessage()]);
        }
    }
}
