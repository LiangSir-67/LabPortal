<?php

namespace App\Models;

use http\Exception;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = "content";
    public $timestamps = true;
    protected $primaryKey = 'nb_id';


    /**
     * 根据优先级返回 id,标题
     * @author tangbangyan <github.com/doublebean>
     * @return mixed
     */
    public static function tby_getRotationPicture()
    {
        try{
            $date=Content::select('nb_id','p_url')
               ->orderby('priority','asc')
                ->take(4)
               ->get();
            return $date;
        }catch(Exception $e){
            logger::Error('没找到该图片',[$e->getMessage()]);
        }
    }


    /**
     * 根据优先级返回前6个新闻标题，时间
     * @author tangbangyan <github.com/doublebean>
     * @return mixed
     */
    public static function tby_getLabTitle()
    {
        try{
            $date=self::select('created_at','title')
                ->orderby('priority','asc')
                ->take(6)
                ->get();

            return $date;
        }catch(Exception $e){
            logger::Error('没找到该图片',[$e->getMessage()]);
        }
    }
   /**
     * 传入title数据，返回新闻公告具体内容
    * @author tangbangyan <github.com/doublebean>
     * @param $title
     * @return mixed
     */
    public static function tby_getLabNew($title)
    {
        try{
            $date=self::where('title',$title)
                ->first();

            return $date;
        }catch(Exception $e){
            logger::Error('没找到该图片',[$e->getMessage()]);
        }
    }
   /**
     * 根据优先级返回内容，图片，标题，时间
    * @author tangbangyan <github.com/doublebean>
     * @return mixed
     */
    public static function tby_getlabnewcontent()
    {
        try{
            $date=self::select('title','neirong','p_url','created_at')
                ->orderby('priority','asc')
                ->get();

            return $date;
        }catch(Exception $e){
            logger::Error('没找到该图片',[$e->getMessage()]);
        }
    }

}
