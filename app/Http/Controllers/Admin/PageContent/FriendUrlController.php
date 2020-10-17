<?php

namespace App\Http\Controllers\Admin\PageContent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageContent\ReShowUrlRequest;
use App\Models\Link;
use App\Http\Requests\Admin\PageContent\AddFriendUrlRequest;
use App\Http\Requests\Admin\PageContent\DeleteFriendUrlRequest;
use App\Http\Requests\Admin\PageContent\UpdateFriendUrlRequest;

class FriendUrlController extends Controller
{

    /**
     * 展示友链
     * @auther ZhongChun <github.com/RobbEr929>
     * @return json
     */
    public static function showFriendUrl()
    {
        $res = Link::zc_show();
        if ($res) {
            return json_success('展示成功!', $res, 200);
        } else {
            return json_fail('展示失败!', null, 100);
        }
    }

    /**
     * 删除友链
     * @auther ZhongChun <github.com/RobbEr929>
     * @param DeleteFriendUrlRequest $request
     * @return json
     */
    public static function deleteFriendUrl(DeleteFriendUrlRequest $request)
    {
        $zc = $request;
        $res = Link::zc_delete($zc);
        if ($res) {
            return json_success('友链删除成功!', null, 200);
        } else {
            return json_fail('友链删除失败!', null, 100);
        }
    }

    /**
     * 修改友链
     * @auther ZhongChun <github.com/RobbEr929>
     * @param UpdateFriendUrlRequest $request
     * @return json
     */
    public static function updateFriendUrl(UpdateFriendUrlRequest $request)
    {
        $zc = $request;
        $res = Link::zc_update($zc);
        if ($res) {
            return json_success('友链修改成功!', null, 200);
        } else {
            return json_fail('友链修改失败!', null, 100);
        }
    }

    /**
     * 新增友链
     * @auther ZhongChun <github.com/RobbEr929>
     * @param AddFriendUrlRequest $request
     * @return json
     */
    public static function addFriendUrl(AddFriendUrlRequest $request)
    {
        $zc = $request;
        $res = Link::zc_insert($zc);
        if ($res) {
            return json_success('添加友链成功!', null, 200);
        } else {
            return json_fail('添加友链失败!', null, 100);
        }
    }

    /**
     * 回显友链
     * @auther ZhongChun <github.com/RobbEr929>
     * @param ReShowUrlRequest $request
     * @return json
     */
    public static function reShowFriendUrl(ReShowUrlRequest $request)
    {
        $zc = $request;
        $res = Link::zc_reShow($zc);
        if ($res) {
            return json_success('回显友链成功!', $res, 200);
        } else {
            return json_fail('回显友链失败!', null, 100);
        }
    }

}

