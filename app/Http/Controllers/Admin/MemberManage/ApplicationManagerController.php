<?php

namespace App\Http\Controllers\Admin\MemberManage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MemberManage\InquireMembersRequest;
use Illuminate\Http\Request;
use App\Models\ApplicationManage;
use App\Http\Controllers\Admin\MemberManage\EmailConfirmController;
use App\Models\Application;
use App\Http\Requests\Admin\MemberManage\AddInquireMembersRequest;

class ApplicationManagerController extends Controller //报名成员信息管理
{
    /**
     * 成员报名信息管理
     * @return \Illuminate\Http\JsonResponse
     * @author yangsiqi<github.com/Double-R111>
     */
    public function showMembers()//成员信息展示
    {
        $ans = Application::ysq_getMembersInformation();
        return $ans ?
            json_success('已报名成员信息展示成功', $ans, 200) :
            json_fail('无已报名成员信息', null, 100);
    }

    /**
     * 通过学号姓名查找并插入user_information表
     * @param AddInquireMembersRequest $request
     * @return \Illuminate\Http\JsonResponse\
     * @author yangsiqi<github.com/Double-R111>
     */
    public function inquireMembers(InquireMembersRequest $request)
    {
        $value = $request['value'];
        $ans = Application::ysq_inquireMember($value);
        return $ans != null?
            json_success('找到该成员', $ans, '200') :
            json_fail('该成员不存在', null, 100);
    }

    /**
     * 添加为新成员
     * @param AddInquireMembersRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author yangsiqi<github.com/Double-R111>
     */
    public function addMembers(AddInquireMembersRequest $request)//添加为新成员
    {
        $ysq = $request;
        $ans = Application::ysq_addMembersFindInsert($ysq);
        EmailConfirmController::emailConfirm($ans);
        return $ans ?
            json_success('该成员审核通过', $ans, '200') :
            json_fail('该成员审核未通过', null, 100);
    }
    /*
     * 详情页展示
     * @return \Illuminate\Http\JsonResponse\
     * @author yangsiqi<github.com/Double-R111>
     */
    public function showDetails(Request $request)//详情页展示
    {
        $application_id = $request['application_id'];
        //$data = Application::ysq_getDetils($application_id);
        //return $data;
        $data = Application::ysq_getDetails($application_id);
        return $data ?
            json_success('详情页展示成功', $data, 200) :
            json_fail('详情页展示失败', null, 100);
    }
}
