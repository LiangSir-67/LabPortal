<?php

namespace App\Http\Controllers\Admin\MemberManage;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\MemberManage\ApplicationRequest;

class SelfInformationController extends Controller //报名申请页面
{
    /**
     * 提交个人信息
     * @param ApplicationRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author yangsiqi<github.com/Double-R111>
     */
    public function selfInformation(ApplicationRequest $request)//个人信息提交
    {
        $re = [
            'application_id' => $request['application_id'],
            'name' => $request['name'],
            'sex' => $request['sex'],
            'class' => $request['class'],
            'email' => $request['email'],
            'self_introduce' => $request['self_introduce'],
            'batch_num' => date('Y-m')
        ];
        $ans = Application::ysq_get_information($re);
        return $ans ?
            json_success('报名信息提交成功！', null, '200') :
            json_fail('报名信息提交失败！', null, '100');

    }
}
