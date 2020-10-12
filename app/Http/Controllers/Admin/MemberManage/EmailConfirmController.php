<?php

namespace App\Http\Controllers\Admin\MemberManage;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserInfo\EmailCheckRequest;
use App\Models\CheckInfo;
use App\Models\EmailCheck;
use App\Models\EmailSend;
use App\Models\UserInfo;
use http\Env;
use http\Env\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class EmailConfirmController extends Controller //发送验证邮箱
{
    /**
     * 发送确认邮件
     * @param $abc
     * @return \Illuminate\Http\JsonResponse
     * @author yangsiqi<github.com/Double-R111>
     */
    public static function emailConfirm(Request $abc)
    {
        $id = $abc['application_id'];
        $email = $abc['email'];
        $type_desc = '发送邮件';
        try {
            Mail::raw(
                '您好!您正在更换邮箱，请点击下面的链接完成验证:' . '账号' . $id . '密码' . $id,
                function ($msg) use ($email, $type_desc) {
                    $msg->from('t1577099712@163.com');
                    $msg->subject($type_desc);
                    $msg->to($email);
                }
            );
            return json_fail('邮件发送成功', null, 200);
        } catch (\Exception $e) {
            return json_fail('邮件发送失败', null, 100);
        }
    }
}
