<?php

namespace App\Http\Controllers\Admin\MemberManage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MemberManage\SetStatusRequest;
use Illuminate\Http\Request;
use App\Models\ApplicationSetting;

class ApplicationStatusController extends Controller //报名系统状态控制
{
    /**
     * 获取当前报名系统状态
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author yangsiqi<github.com/Double-R111>
     */
    public function registStatus()
    {
        $res = ApplicationSetting::ysq_getStatus();
        return $res ?
            json_success('当前状态获取成功', $res, 200) :
            json_fail('当前状态获取失败', null, 100);
    }

    /**
     * 改变当前报名系统状态
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     * @author yangsiqi<github.com/Double-R111>
     */
    public function setStatus(SetStatusRequest $request)
    {
        $status = $request['setting_status'];
        $res = ApplicationSetting::ysq_changeStatus($status);
        return $res ?
            json_success('状态改变成功', null, 200) :
            json_fail('状态改变失败', null, 100);
    }
}

