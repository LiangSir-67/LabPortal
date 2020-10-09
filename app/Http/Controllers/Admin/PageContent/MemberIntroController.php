<?php

namespace App\Http\Controllers\Admin\PageContent;

use App\Http\Controllers\Controller;
use App\Models\GoodMember;
use App\Models\Teacher;
use App\Http\Requests\Admin\PageContent\DeleteTeacherRequest;
use App\Http\Requests\Admin\PageContent\UpdateTeacherRequest;
use App\Http\Requests\Admin\PageContent\AddTeacherRequest;
use App\Http\Requests\Admin\PageContent\DeleteGoodMemRequest;
use App\Http\Requests\Admin\PageContent\UpdateGoodMemRequest;
use App\Http\Requests\Admin\PageContent\AddGoodMemRequest;

class MemberIntroController extends Controller
{
    /**
     * 展示指导老师信息
     * @auther ZhongChun <github.com/RobbEr929>
     * @return json
     */
    public static function showTeacher()
    {
        $res = Teacher::zc_show();
        if ($res) {
            return json_success('老师展示成功!', $res, 200);
        } else {
            return json_fail('老师展示失败!', null, 100);
        }
    }

    /**
     * 删除指导老师信息
     * @auther ZhongChun <github.com/RobbEr929>
     * @param DeleteTeacherRequest $request
     * @return json
     */
    public static function deleteTeacher(DeleteTeacherRequest $request)
    {
        $zc = $request;
        $res = Teacher::zc_delete($zc);
        if ($res) {
            return json_success('老师删除成功!', null, 200);
        } else {
            return json_fail('老师删除失败!', null, 100);
        }
    }

    /**
     * 修改指导老师信息
     * @auther ZhongChun <github.com/RobbEr929>
     * @param UpdateTeacherRequest $request
     * @return json
     */
    public static function updateTeacher(UpdateTeacherRequest $request)
    {
        $zc = $request;
        $res = Teacher::zc_update($zc);
        if ($res) {
            return json_success('老师修改成功!', null, 200);
        } else {
            return json_fail('老师修改失败!', null, 100);
        }
    }

    /**
     * 增加指导老师信息
     * @auther ZhongChun <github.com/RobbEr929>
     * @param AddTeacherRequest $request
     * @return json
     */
    public static function addTeacher(AddTeacherRequest $request)
    {
        $zc = $request;
        $res = Teacher::zc_insert($zc);
        if ($res) {
            return json_success('增加老师成功!', null, 200);
        } else {
            return json_fail('增加老师失败!', null, 100);
        }
    }

    /**
     * 展示优秀成员信息
     * @auther ZhongChun <github.com/RobbEr929>
     * @return json
     */
    public static function showGoodMem()
    {
        $res = GoodMember::zc_show();
        if ($res) {
            return json_success('优秀成员展示成功!', $res, 200);
        } else {
            return json_fail('优秀成员展示失败!', null, 100);
        }
    }

    /**
     * 删除优秀成员信息
     * @auther ZhongChun <github.com/RobbEr929>
     * @param DeleteGoodMemRequest $request
     * @return json
     */
    public static function deleteGoodMem(DeleteGoodMemRequest $request)
    {
        $zc = $request;
        $res = GoodMember::zc_delete($zc);
        if ($res) {
            return json_success('删除优秀成员成功!', null, 200);
        } else {
            return json_fail('删除优秀成员失败!', null, 100);
        }
    }

    /**
     * 修改优秀成员信息
     * @auther ZhongChun <github.com/RobbEr929>
     * @param UpdateGoodMemRequest $request
     * @return json
     */
    public static function updateGoodMem(UpdateGoodMemRequest $request)
    {
        $zc = $request;
        $res = GoodMember::zc_update($zc);
        if ($res) {
            return json_success('修改优秀成员成功!', null, 200);
        } else {
            return json_fail('修改优秀成员失败!', null, 100);
        }
    }

    /**
     * 增加优秀成员信息
     * @auther ZhongChun <github.com/RobbEr929>
     * @param AddGoodMemRequest $request
     * @return json
     */
    public static function addGoodMem(AddGoodMemRequest $request)
    {
        $zc = $request;
        $res = GoodMember::zc_insert($zc);
        if ($res) {
            return json_success('添加优秀成员成功!', null, 200);
        } else {
            return json_fail('添加优秀成员失败!', null, 100);
        }
    }
}

