<?php

namespace App\Models;

use http\Exception;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = "teacher";
    public $timestamps = true;
    protected $primaryKey = 'id';

    /**
     * 返回老师名字，职称，介绍，图片
     * @author tangbangyan <github.com/doublebean>
     * @return mixed
     */
    public static function tby_getTeacherContent()
    {
        try{

            $date = self::select('name','profession','t_url','t_bridf')
                ->orderby('priority','asc')
                ->get();

            return $date;
        }catch(Exception $e){
            logger::Error('没找到该图片',[$e->getMessage()]);
        }
    }
}
