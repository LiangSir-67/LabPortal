<?php

namespace App\Models;
use App\Models\UserInformation;
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


    public static function selectAll(){
        return Login::all();
    }


    public static function insertMember($login_id,$password){
    try{
        $res=self::insert(
            [
                'login_id'=>$login_id,
                'password'=>$password,
                   'login_date'=>now(),
            ]
            );
     return json_success(200,"插入成功",null);
    }
    catch(\Exception $e){
       logError("插入失败",[$e -> getMessage()]);
        return json_fail(100,"插入失败",null);
    }
}


    public static function modifyMember($login_id,$login_status){
        try{
           if($login_status==1){
               $res=self::where('login_id',$login_id)
                      ->update(['login_status'=>0,'login_date'=>now()]);

           }
           else{
               $res=self::where('login_id',$login_id)
                     ->update(['login_status'=>1,'login_date'=>now()])
                     ->get();
           }
         return $res;
        }
        catch(\Exception $e){
           logError("插入失败",[$e -> getMessage()]);
            return json_fail(100,"插入失败",null);
        }
}

}
