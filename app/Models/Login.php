<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Exception;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Login extends \Illuminate\Foundation\Auth\User implements JWTSubject,Authenticatable
{
    protected $table = "login";
    public $timestamps = true;
    protected $primaryKey = 'login_id';
    protected $fillable = ['login_id', 'password','login_date'];
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
     * 跟新用户登陆时间
     * @param $login_id
     */
    public static function updateDate($login_id){
     try{
         $model = Login::find($login_id);
         $model ->login_date =    now();
         return $model ->save();

     }catch (Exception $e){
         logError("更新用户登陆时间出错！",$e->getMessage());
         return null;
     }
    }


    /**
     * 创建用户
     *
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
}
