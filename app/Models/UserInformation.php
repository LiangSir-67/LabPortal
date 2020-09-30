<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $table = "user_information";
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = ['information_id'];

    public static function showMember(){
        $data =  self::join('login','information_id','login_id')
            ->select('information_id','nichen','name','sex','login_date','login_status')
            ->get();
        
         return $data;

    }
    public static function queryMember($nichen,$information_id){
        // dd($information_id);
        // dd($nichen);
        if($nichen!=null){
        $data=self::join('login','information_id','login_id')
            ->select('information_id','nichen','name','sex','login_date')
            ->where('nichen',$nichen)
            ->get();
            return $data;
        }
        else
        {
            $data=self::join('login','information_id','login_id')
            ->select('information_id','nichen','name','sex','login_date')
            ->where('information_id',$information_id)
            ->get();
            return $data;
        }
      
    }
    public static function insertInfromation($login_id)
    {
        try{
            $res=self::insert(
                [
                     'information_id'=>$login_id,
                ]
                );
         return json_success(200,"插入成功",null);
        }
        catch(\Exception $e){
           logError("插入失败",[$e -> getMessage()]);
            return json_fail(100,"插入失败",null);
        }
    }
}

