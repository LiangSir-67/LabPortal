<?php

namespace app\Http\Controllers\Admin\PageContent;

use App\Http\Controllers\Controller;
use App\Models\NewsBulletinManage;
use App\Models\Content;
use App\Http\Requests\Admin\PageContent\AddContentToSqlRequest;

class PageContentController extends Controller
{

    /**
     * 将获取到的内容插入数据库的Content表
     * @auther ZhongChun <github.com/RobbEr929>
     * @param AddContentToSqlRequest $request
     * @return json
     */
    public function addContentToSql(AddContentToSqlRequest $request)
    {
        $zc = $request;
        $res1 = Content::zc_insert($zc);
        $res2 = NewsBulletinManage::zc_insert($zc);
        if ($res1 == true && $res2 == true) {
            return json_success('内容发布成功!', null, 200);
        } else {
            if (!$res1) {
                NewsBulletinManage::zc_delete(Content::zc_getid());
            }
            if (!$res2) {
                Content::zc_delete(NewsBulletinManage::zc_getid());
            }
            return json_fail('内容发布失败!', null, 100);
        }
    }
}
