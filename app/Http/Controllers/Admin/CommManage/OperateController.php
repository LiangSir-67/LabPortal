<?php

namespace App\Http\Controllers\Admin\commManage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommManage\InsertMemberRequest;
use App\Http\Requests\Admin\CommManage\ModifyMemberRequest;
use App\Http\Requests\Admin\CommManage\QueryMemberRequest;
use Illuminate\Http\Request;
use DB;
use App\Models\Login;
use App\Models\UserInformation;

class OperateController extends Controller
{
    /**
     * 根据参数插入数据
     * @author Chenqiuxiang <github.com/Varsion>
     * @param user_id=>学号,
     *        user_password=>密码,
     *        login_status=>用户状态
     * @return json
     */
    public function insertMember(InsertMemberRequest $request){
        $login_id=$request['user_id'];
        $password=$request['user_password'];
        $password=bcrypt($password);
        $result=Login::insertMember($login_id,$password);
        $res=UserInformation::insertInformation($login_id);
        if($res)
        {
            return $result == null?
                json_fail("操作失败",null,100):
                json_success("成功",null,200);
        }
        else{
            return $result == null?
                json_fail("操作失败",null,100):
                json_success("成功",null,200);
        }
    }

    /**
     * 展示成员
     * @return $data,json
     * @author Chenqiuxiang <github.com/Varsion>
     */
    public function showMember()
    {
        $data = UserInformation::showMember();
        if (count((array)$data) > 0) {

            return json_success("展示成员成功", $data, 200);
        } else {
            return json_fail("展示成员失败", null, 100);
        }

    }

    /**
     * 根据昵称或者账号查询成员
     * @param nichen=>昵称，user_id=>账号
     * @return json
     * @author Chenqiuxiang <github.com/Varsion>
     */
    public function queryMember(QueryMemberRequest $request)
    {
        $data = $request['data'];
        $result = UserInformation::queryMember($data);

        if (count((array)$result) > 0) {
            return json_success("查询数据成功", $result, 200);
        } else {
            return json_fail("查询数据失败", null, 100);
        }
    }

    /**
     * 修改成员的状态
     * @param user_id=>账号，user_status=>状态
     * @return json
     * @author Chenqiuxiang <github.com/Varsion>
     */
    public function modifyMember(ModifyMemberRequest $request)
    {
        $login_id = $request['user_id'];
        $login_status = $request['user_status'];
        $result = Login::modifyMember($login_id, $login_status);
        return $result ?
            json_success("修改状态成功", null, 200) :
            json_fail("修改状态失败", null, 100);
    }
}
