<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $table = "user_information";
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = ['information_id'];

    /**
     * 展示成员
     * @return $data
     * @author Chenqiuxiang <github.com/Varsion>
     */
    public static function showMember()
    {
        $data = self::join('login', 'information_id', 'login_id')
            ->select('information_id', 'nichen', 'name', 'sex', 'login_date', 'login_status')
            ->get();
        return $data;

    }

    /**
     * 根据昵称或者账号查询成员
     * @param nichen=>昵称，information_id=>账号
     * @return $data
     * @author Chenqiuxiang <github.com/Varsion>
     */
    public static function queryMember($nichen, $information_id)
    {
        if ($nichen != null) {
            $data = self::join('login', 'information_id', 'login_id')
                ->select('information_id', 'nichen', 'name', 'sex', 'login_date')
                ->where('nichen', $nichen)
                ->get();
            return $data;
        } else {
            $data = self::join('login', 'information_id', 'login_id')
                ->select('information_id', 'nichen', 'name', 'sex', 'login_date')
                ->where('information_id', $information_id)
                ->get();
            return $data;
        }

    }

    /**
     * 根据传入的参数存入数据库
     * @param $login_id
     * @return $res
     * @author Chenqiuxiang <github.com/Varsion>
     */
    public static function insertInformation($login_id)
    {
        try {
            $res = self::insert(
                [
                    'information_id' => $login_id,
                ]
            );
            return $res;
        } catch (\Exception $e) {
            logError("插入失败", [$e->getMessage()]);
            return json_fail("插入失败", null, 100);
        }
    }
}

