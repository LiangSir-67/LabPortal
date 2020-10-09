<?php

namespace App\Http\Controllers\Admin\PageContent;

use App\Http\Controllers\Controller;
use App\Models\Labor;
use App\Models\WebInformation;
use App\Http\Requests\Admin\PageContent\AddToSqlRequest;


class LabController extends Controller
{

    /**
     * 修改实验室信息
     * @auther ZhongChun <github.com/RobbEr929>
     * @param AddToSqlRequest $request
     * @return json
     */
    public static function addToSql(AddToSqlRequest $request)
    {
        $zc = $request;
        $res1 = Labor::zc_update($zc);
        $res2 = WebInformation::zc_update($zc);
        if ($res1 == true && $res2 == true) {
            return json_success('实验室介绍修改成功!', null, 200);
        } else {
            return json_fail('实验室介绍修改失败!', null, 100);
        }
    }
}

