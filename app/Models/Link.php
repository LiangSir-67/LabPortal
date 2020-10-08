<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = "link";
    public $timestamps = true;
    protected $primaryKey = 'link_id';
    protected $guarded = [];


    /**
     * 展示友链
     * return [string]
     */
    public static function zc_show(){
        try {
            $zc = self::orderBy('priority','asc')
                ->get();
            return $zc;
        }catch (\Exception $e){
            logError('搜索失败',[$e->getMessage()]);
        }
    }

    /**
     * 删除友链
     * @param [string]
     */
    public static function zc_delete($zc){
        try {
            self::where('link_id',$zc['link_id'])
                ->delete();
            return true;
        }catch (\Exception $e){
            logError('搜索失败',[$e->getMessage()]);
            return  null;
        }
    }

    /**
     * 修改友链
     * @param [string]
     */
    public static function zc_update($zc){
        try {
            Link::where('link_id',$zc['link_id'])
                ->update([
                    'name'=>$zc['name'],
                    'produce'=> $zc['produce'],
                    'priority'=> $zc['priority'],
                    'tx_url'=> $zc['tx_url'],
                    'blog_url'=> $zc['blog_url']
                ]);
            return true;
        }catch (\Exception $e){
            logError('搜索失败',[$e->getMessage()]);
        }
    }

    /**
     * 新增友链
     * @param [string]
     */
    public static function zc_insert($zc){
        try {
            Link::create([
                'name' => $zc['name'],
                'produce' => $zc['produce'],
                'priority' => $zc['priority'],
                'tx_url' => $zc['tx_url'],
                'blog_url' => $zc['blog_url']
            ]);
            return true;
        }catch (\Exception $e){
            logError('搜索失败',[$e->getMessage()]);
        }
    }
}
