<?php

namespace App\Http\Controllers\Admin\commManage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Login;
use App\Models\UserInformation;
class OperateController extends Controller
{
    //插入成员
    public function insertMember(request $request){
        $login_id=$request['user_id'];
        $password=$request['user_password'];
        $password=bcrypt($password);
        $result=Login::insertMember($login_id,$password);
        $res=UserInformation::insertInfromation($login_id);
        // if($result){
        //     return json_success("插入成员成功",null,200);
        // }else{
        //     return json_fail("插入成员失败",null,100);
        // }
        return $result;
        return $res;
    }

    //展示成员
    public function showMember(){
        $data=UserInformation::showMember();
        // dd($data);
        if(count((array)$data)>0){

            return json_success("展示成员成功",$data,200);
        }else{
            return json_fail("展示成员失败",null,100);
        }

    }
    //查询成员
    public function queryMember(request $request){
    $nichen=$request['nichen'];
    $information_id=$request['user_id'];
    $result=UserInformation::queryMember($nichen,$information_id);
    if(count((array)$result)>0){
        return json_success("查询数据成功",$result,200);
    }else{
        return json_fail("查询数据失败",null,100);
    }
  }
     //修改状态
    public function modifyMember(request $request){
        $login_id=$request['user_id'];
        $login_status=$request['user_status'];
        $result=Login::modifyMember($login_id,$login_status);
        return $result?
        json_success("修改状态成功",$result,200):
        json_fail("修改状态失败",null,100);
    }
}
