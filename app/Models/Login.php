<?php

namespace App\Models;

use App\Models\UserInformation;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Exception;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Login extends \Illuminate\Foundation\Auth\User implements JWTSubject, Authenticatable
{
    protected $table = "login";
    public $timestamps = true;
    protected $primaryKey = 'login_id';
    protected $fillable = ['login_id', 'password', 'login_date'];
    protected $hidden = [
        'password',
    ];

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getJWTIdentifier()
    {
        return self::getKey();
    }

    /***
     * 更新用户登陆时间
     * @param $login_id
     */
    public static function updateDate($login_id)
    {
        try {
            $model = Login::find($login_id);
            $model->login_date = now();
            return $model->save();

        } catch (Exception $e) {
            logError("更新用户登陆时间出错！", $e->getMessage());
            return null;
        }
    }


    /**
     * 创建用户
     * @param array $array
     * @return |null
     * @throws \Exception
     */
    public static function createUser($array = [])
    {
        try {
            return self::create($array) ?
                true :
                false;
        } catch (\Exception $e) {
            //\App\Utils\Logs::logError('添加用户失败!', [$e->getMessage()]);
            die($e->getMessage());
            return false;
        }
    }


    /**
     * 根据传入的参数存入数据库
     * @param $login_id ,
     *        $password,
     *        $login_status
     * @return $res
     * @author Chenqiuxiang <github.com/Varsion>
     */
    public static function insertMember($login_id, $password, $login_status)
    {
        try {
            $res = self::create(
                [
                    'login_status' => $login_status,
                    'login_date' => now(),
                    'login_id' => $login_id,
                    'password' => $password,
                ]
            );
            return $res;
        } catch (\Exception $e) {
            logError("插入异常！", [$e->getMessage()]);
            return null;
        }
    }

    /**
     * 修改成员状态
     * @param login_id=>账号，login_status=>状态
     * @return $res
     * @author Chenqiuxiang <github.com/Varsion>
     */
    public static function modifyMember($login_id, $login_status)
    {
        try {
            if ($login_status == 1) {
                $res = self::where('login_id', $login_id)
                    ->update(['login_status' => 1, 'login_date' => now()]);
                return $res;
            } else if ($login_status == 0) {
                $res = self::where('login_id', $login_id)
                    ->update(['login_status' => 0, 'login_date' => now()]);
                return $res;
            }
        } catch (\Exception $e) {
            logError("插入失败", [$e->getMessage()]);
            return json_fail(100, "插入失败", null);
        }
    }
}
