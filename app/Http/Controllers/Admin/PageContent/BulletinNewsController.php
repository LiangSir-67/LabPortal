<?php

namespace App\Http\Controllers\Admin\PageContent;

use App\Http\Controllers\Controller;
use App\Models\NewsBulletinManage;
use App\Http\Requests\Admin\PageContent\OperationRequest;
use App\Http\Requests\Admin\PageContent\SelectRequest;
use App\Http\Requests\Admin\PageContent\EditRequest;

class BulletinNewsController extends Controller
{

    /**
     * 公告展示
     * @auther ZhongChun <github.com/RobbEr929>
     * @return json
     */
    public static function show(){
        $res = NewsBulletinManage::zc_show();
        if($res){
            return json_success('展示成功!',$res,200);
        }
        else{
            return json_fail('展示失败!',null,100);
        }
    }

    /**
     * 启用禁用
     * @auther ZhongChun <github.com/RobbEr929>
     * @param OperationRequest $request
     * @return json
     */
    public static function operation(OperationRequest $request){
        $zc = $request;
        $res = NewsBulletinManage::zc_operation($zc);
        if($res){
            return json_success('操作成功!',null,200);
        }
        else{
            return json_fail('操作失败!',null,100);
        }
    }

    /**
     * 模糊查询
     * @auther ZhongChun <github.com/RobbEr929>
     * @param SelectRequest $request
     * @return json
     */
    public static function select(SelectRequest $request){
        $zc = $request;
        $res = NewsBulletinManage::zc_select($zc);
        if($res){
            return json_success('搜索成功',$res,200);
        }
        else{
            return json_fail('搜索失败!',null,100);
        }
    }

    /**
     * 编辑
     * @auther ZhongChun <github.com/RobbEr929>
     * @param EditRequest $request
     * @return json
     */
    public static function edit(EditRequest $request){
        $zc = $request;
        $res = NewsBulletinManage::zc_edit($zc);
        if($res){
            return json_success('搜索成功!', $res, 200);
        }else{
            return json_fail('搜索失败!',null,100);
        }
    }
}
