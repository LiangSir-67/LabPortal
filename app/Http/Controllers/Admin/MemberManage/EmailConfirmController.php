<?php

namespace App\Http\Controllers\Admin\MemberManage;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserInfo\EmailCheckRequest;
use App\Models\Application;
use App\Models\CheckInfo;
use App\Models\EmailCheck;
use App\Models\EmailSend;
use App\Models\Login;
use App\Models\UserInfo;
use http\Env;
use http\Env\Url;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class EmailConfirmController extends Controller //发送验证邮箱
{
    /**
     * 发送确认邮件
     * @param $abc
     * @return \Illuminate\Http\JsonResponse
     * @author yangsiqi<github.com/Double-R111>
     */
    public static function emailConfirm(Request $abc){

        $data = $abc['application_id'];
        for ($i = 0; $i < count($data); $i++) {
            if ($abc[$i]==null){
                return new HttpResponseException(json_fail(422, '参数错误!', 422));
            }
        }
        $isFlag = [];
        for ($i = 0; $i < count($data); $i++) {
            $passw = rand(100000000, 99999999999);
            $info['id'] = $data[$i];
            $info['password'] = $passw;
            $a = Application::ysq_select($info['id']);
            $type_desc="激活邮箱";
            $email = $a['email'];
            try {
                Mail::raw(
                    '您好!您正在更换邮箱，请点击下面的链接完成验证:' . '账号' . $info['id'] . '密码' . $info['id'],
                    function ($msg) use ($email, $type_desc) {
                        $msg->from('t1577099712@163.com');
                        $msg->subject($type_desc);
                        $msg->to($email);
                    }
                );
            } catch (\Exception $e) {
                logError('发送失败',[$e->getMessage()]);
                $isFlag[$data[$i]] = true;
            }
//            dd($isFlag[$i]);
            if(!$isFlag[$data[$i]]){
                Login::ysq_save($info);
            }
            $isFlag[$data[$i]]=false;
        }
        $data = $isFlag;
        if($data==null){
            return json_fail('邮件发送成功',null, 200);
        }
        return json_fail('发送失败',$data,100);

    }
}
