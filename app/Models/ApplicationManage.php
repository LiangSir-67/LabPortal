<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationManage extends Model
{
    protected $table = "application";
    public $timestamps = true;
    /**
     * 成员信息获取
     *  @author yangsiqi<github.com/Double-R111>
     * @var string
     * @return mixed
     */
    //protected $primaryKey = 'manage_id';
    public static function getMembersInformation()
    {
        try {
            $data = self::selet('*')
                ->get();

            return $data;

        } catch (\Exception $e) {
            logError('无成员信息', [$e->getMessage()]);
        }
//        $showtables=select('*');
//        return $showtables;
    }

}
