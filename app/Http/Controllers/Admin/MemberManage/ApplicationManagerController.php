<?php

namespace App\Http\Controllers\Admin\MemberManage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApplicationManage;
use App\Http\Controllers\Admin\MemberManage\EmailConfirmController;
use App\Models\Application;
use App\Http\Requests\Admin\MemberManage\AddInquireMembersRequest;

class ApplicationManagerController extends Controller //报名成员信息管理
{
    /**
     * 成员报名信息管理
     * @author yangsiqi<github.com/Double-R111>
     * @return \Illuminate\Http\JsonResponse
     */
    public function showMembers()//成员信息展示
    {
        $ans = Application::getMembersInformation();
        return $ans ?
            json_success('已报名成员信息展示成功', $ans, 200) :
            json_fail('无已报名成员信息', null, 100);
    }

    /**
     * 通过学号姓名查找并插入user_information表
     * @author yangsiqi<github.com/Double-R111>
     * @param AddInquireMembersRequest $request
     * @return \Illuminate\Http\JsonResponse\
     */
    public function inquireMembers(AddInquireMembersRequest $request)
    {
        $ysq = $request;
        $ans = Application::inquireMember($ysq);
        return $ans ?
            json_success('找到该成员', $ans, '200') :
            json_fail('该成员不存在', null, 100);
    }

    /**
     * 添加为新成员
     * @author yangsiqi<github.com/Double-R111>
     * @param AddInquireMembersRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addMembers(AddInquireMembersRequest $request)//添加为新成员
    {
        $ysq = $request;
        $ans = Application::addMembersFindInsert($ysq);
        EmailConfirmController::emailConfirm($ans);
        return $ans ?
            json_success('该成员审核通过', $ans, '200') :
            json_fail('该成员审核未通过', null, 100);
    }
}
