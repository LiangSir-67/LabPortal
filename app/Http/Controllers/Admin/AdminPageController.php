<?php

namespace App\Http\Controllers\Admin;


use App\Models\Article;
use App\Http\Controllers\Controller;

class AdminPageController extends Controller
{

    /**
     * 后台管理主页
     * @auther ZhongChun <github.com/RobbEr929>
     * @return json
     */
    public static function showAdmin(){
        $res1 = Article::zc_point();
        $res2 = Article::zc_comment();
        $res3 = Article::zc_web();
        $res4 = Article::zc_register();
        $res5 = Article::zc_total();
        $res6 = Article::zc_totalWord();
        $data=[
            "res1" => $res1,
            "res2" => $res2,
            "res3" => $res3,
            "res4" => $res4,
            "res5" => $res5,
            "res6" => $res6
        ];
        if($res1&&$res2&&$res3&&$res4&&$res5&&$res6){
            return json_success('操作成功!',$data,200);
        }else{
            return json_fail('操作失败!',null,100);
        }
    }
}
