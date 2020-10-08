<?php

namespace App\Models;

use App\Models\Content;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class NewsBulletinManage extends Model
{
    protected $table = "news_bulletin_manage";
    public $timestamps = true;
    protected $primaryKey = 'nb_id';
    protected $guarded = [];


    /**
     * 插入数据到管理表
     * @auther ZhongChun <github.com/RobbEr929>
     * @param [string]$zc
     */
    public static function zc_insert($zc){
        try {
            $res['create_at'] = Carbon::now()->toDateTimeString();
            $res['updated_at'] = $res['create_at'];
            self::insert([
                'class_id'=>$zc['class_id'],
                'operate'=>1,
                'status'=>1,
                'create_at' => $res['create_at'],
                'updated_at' => $res['updated_at']
            ]);
            return true;
        }catch (\Exception $e){
            logError('填报错误',[$e->getMessage()]);
            return null;
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
            self::where('labor_id',$nb_id)
                ->delete();
            return true;
        }catch (\Exception $e){
            logError('删除失败',[$e->getMessage()]);
        }
    }

    /**
     * 搜索表中所有数据
     * return [string]
     */
    public static function zc_show(){
        try {
            $zc = self::join('content','content.nb_id','news_bulletin_manage.nb_id')
                ->select('news_bulletin_manage.*','content.title','content.priority','content.neirong')
                ->orderBy('priority','asc')
                ->get();
            return $zc;
        }catch (\Exception $e){
            logError('搜索失败',[$e->getMessage()]);
        }
    }

    /**
     * 修改状态 (0-禁用，1-启用)
     * @param [string]
     */
    public static function zc_operation($zc){
        try {
            $res = NewsBulletinManage::find($zc['nb_id']);
            $res['updated_at']=Carbon::now()->toDateTimeString();
            if($res['status']==1)
            {
                NewsBulletinManage::where('nb_id', $res['nb_id'])
                    ->update(['status' => 0]);
                Content::where('nb_id', $res['nb_id'])
                    ->update(['updated_at'=>$res['updated_at']]);
            }else{
                NewsBulletinManage::where('nb_id', $res['nb_id'])
                    ->update(['status' => 1]);
                Content::where('nb_id', $res['nb_id'])
                    ->update(['updated_at'=>$res['updated_at']]);
            }
            return true;
        }catch (\Exception $e){
            logError('修改失败',[$e->getMessage()]);
        }
    }

    /**
     * 模糊查询
     * @param [string]
     */
    public static function zc_select($zc){
        try {
            $res = NewsBulletinManage::join('content','content.nb_id','news_bulletin_manage.nb_id')
                ->select('content.*','news_bulletin_manage.class_id')
                ->where('title',$zc['title'])
                ->orWhere('title','like','%'.$zc['title'].'%')
                ->orderBy('priority','asc')
                ->get();
            return $res;
        }catch (\Exception $e){
            logError('搜索失败',[$e->getMessage()]);
        }
    }

    /**
     * 编辑回显
     * @param [string]
     * return [string]
     */
    public static function zc_edit($zc){
        try {
            $res = self::join('content','content.nb_id','news_bulletin_manage.nb_id')
                ->select('news_bulletin_manage.*','content.title','content.priority','content.neirong')
                ->find($zc['nb_id']);
            $res['operate'] = 2;
            return $res;
        }catch (\Exception $e){
            logError('搜索失败',[$e->getMessage()]);
        }
    }
}

