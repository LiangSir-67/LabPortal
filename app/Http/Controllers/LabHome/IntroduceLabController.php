<?php

namespace App\Http\Controllers\LabHome;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\GoodMember;
use App\Models\Labor;
use App\Models\Link;
use App\Models\NewsBulletinManage;
use App\Models\Teacher;
use Illuminate\Http\Request;

class IntroduceLabController extends Controller
{
    /**
     *返回轮播图图片和id
     * @author tangbangyan <github.com/doublebean>
     * @return \Illuminate\Http\JsonResponse
     */
     public function getRotationPicture()
     {


         $date = Content::tby_getRotationPicture();
         if ($date!=null){
             return json_success('成功',$date,200);
         }
         return json_fail('失败',$date,100);

     }

    /**
     * 返回实验室介绍图片和内容
     * @author tangbangyan <github.com/doublebean>
     * @return json
     */
    public function getLabContent()
    {

        $date = Labor::tby_getLabContent();

        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }

    /**
     * 返回实验室环境图片和内容
     * @author tangbangyan <github.com/doublebean>
     * @return json
     */
        public function getLabEnvironment()
    {

        $date = Labor::tby_getLabEnvironment();

        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }
    /**
     * 返回实验室架构图片和内容
     * @author tangbangyan <github.com/doublebean>
     * @return json
     */
        public function getLabOrganization()
    {

        $date = Labor::tby_getLabOrganization();

        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }
    /**
     * 返回实验室方向图片和内容
     * @author tangbangyan <github.com/doublebean>
     * @return json
     */
        public function getLabDirection()
    {

        $date = Labor::tby_getLabDirection();

        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }

    /**
     * 返回老师图片和内容
     * @author tangbangyan <github.com/doublebean>
     * @return json
     */
    public function getTeacherContent()
    {

        $date = Teacher::tby_getTeacherContent();

        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }
    /**
     * 返回优秀学生图片和内容
     * @author tangbangyan <github.com/doublebean>
     * @return json
     */
    public function getExcellentContent()
    {

        $date = GoodMember::tby_getExcellentContent();

        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }
    /**
     * 返回友链图片和内容和博客
     * @author tangbangyan <github.com/doublebean>
     * @return json
     */
    public function getFriendContet()
    {

        $date = Link::tby_getFriendContet();

        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }

    /**
     * 返回首页标题和时间
     * @author tangbangyan <github.com/doublebean>
     * @return json
     */
    public function getLabTitle()
    {

        $date = Content::tby_getLabTitle();

        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }

    /**
     * 返回聚焦实验室图片和内容,时间
     * @author tangbangyan <github.com/doublebean>
     * @return json
     */

        public function getLabNewContent()
    {

        $date = Content::tby_getLabNewContent();

        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }

    /**
     * 根据传入的title返回对应内容
     * @param Request $request
     * @author tangbangyan <github.com/doublebean>
     * @return json
     */
    public function getLabNew(Request $request)
    {

        $date = Content::tby_getLabNew($request['title']);

        if ($date!=null){
            return json_success('成功',$date,200);
        }
        return json_fail('失败',$date,100);

    }

}
