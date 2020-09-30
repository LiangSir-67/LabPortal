<?php

namespace App\Models;

use http\Exception;
use Illuminate\Database\Eloquent\Model;

class GoodMember extends Model
{
    protected $table = "good_members";
    public $timestamps = true;
    protected $primaryKey = 'member_id';


    /**
     * 通过优先级获取在goodmemeber表中的数据
     * @author tangbagnyan <github.com/doublebean>
     * @param $id
     * @return mixed
     */
    public static function tby_getExcellentContent()
    {
        try{
            $date=self::select('name','member_url','gm_bridf')
                ->orderby('priority','asc')
                ->take(3)
                ->get();

            return $date;
        }catch(Exception $e){
            logger::Error('没找到优秀成员信息',[$e->getMessage()]);
        }
    }

}
