<?php

namespace App\Models;

use http\Exception;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = "link";
    public $timestamps = true;
    protected $primaryKey = 'link_id';

    /**
     * 返回名字，博客url，图片url，简介
     * @author tangbagnyan <github.com/doublebean>
     * @return mixed
     */
    public static function tby_getFriendContet()
    {
        try{
            $date=self::select('name','tx_url','blog_url','produce')
                ->orderby('priority','asc')
                ->get();

            return $date;
        }catch(Exception $e){
            logger::Error('没找到优秀成员信息',[$e->getMessage()]);
        }
    }
}
