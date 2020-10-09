<?php

namespace App\Http\Controllers\Admin\commManage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Login;
use App\Models\UserInformation;
class OperateController extends Controller
{
    /**
     * 根据参数插入数据
     * @author Chenqiuxiang <github.com/Varsion>
     * @param user_id=>学号，user_password=>密码
     * @return $result,$res
     */
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

      /**
     * 展示成员
     * @author Chenqiuxiang <github.com/Varsion>
     * @return $data,json
     */
    public function showMember(){
        $data=UserInformation::showMember();
        // dd($data);
        if(count((array)$data)>0){

            return json_success("展示成员成功",$data,200);
        }else{
            return json_fail("展示成员失败",null,100);
        }

    }
      /**
     * 根据昵称或者账号查询成员
     * @author Chenqiuxiang <github.com/Varsion>
     * @param nichen=>昵称，user_id=>账号
     * @return json
     */
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
       /**
     * 修改成员的状态
     * @author Chenqiuxiang <github.com/Varsion>
     * @param user_id=>账号，user_status=>状态
     * @return json
     */
    public function modifyMember(request $request){
        $login_id=$request['user_id'];
        $login_status=$request['user_status'];
        $result=Login::modifyMember($login_id,$login_status);
        return $result?
        json_success("修改状态成功",$result,200):
        json_fail("修改状态失败",null,100);
    }
}
