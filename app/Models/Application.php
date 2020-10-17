<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Http\Requests\Admin\MemberManage\AddMembersRequest;
use App\Models\UserInformation;
use mysql_xdevapi\Exception;
use phpDocumentor\Reflection\Types\Mixed_;

class Application extends Model//报名系统界面
{
    /**
     * 得到新成员信息
     * @author yangsiqi<github.com/Double-R111>
     * @param  $ysq
     * @var string
     * @return boolean
     */
    protected $table = "application";
    public $timestamps = true;
    protected $guarded=[];
    public static function ysq_get_information($ysq)
    {
        try {
            $result = self::insert([
                'application_id' => $ysq['application_id'],
                'name' => $ysq['name'],
                'sex' => $ysq['sex'],
                'email' => $ysq['email'],
                'class' => $ysq['class'],
                'self_introduce' => $ysq['self_introduce'],
                'batch_num' => $ysq['batch_num']
            ]);
            return $result;
        } catch (\Exception $e) {
            logError('报名信息插入错误', [$e->getMessage()]);
            return false;
        }
    }
    /**
     * 从表单数据中查找成员信息
     * @author yangsiqi<github.com/Double-R111>
     * @var string
     * @return boolean
     */
    public static function ysq_getMembersInformation()//成员信息获取
    {
        try {
            $data = self::select('*')
                ->orderby('batch_num', 'asc')
                ->get();
            return $data;
        } catch (\Exception $e) {
            logError('无成员信息', [$e->getMessage()]);
            return false;
        }
    }
    /**
     * 通过学号或姓名查找需要审核的新成员信息
     * @author yangsiqi<github.com/Double-R111>
     * @param  $ysq
     * @var string
     * @return boolean
     */
    public static function ysq_inquireMember($value)
    {
        try {
            //dd($ysq);
            $data = self::where('application_id','like', '%'.$value.'%')
                ->orWhere('name','like', '%'. $value.'%')
                ->get();
            return $data;
        } catch (\Exception $e) {
            logError('新成员查找失败', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 添加为新成员即通过审核
     * * @author yangsiqi<github.com/Double-R111>
     * @param $ysq
     * @return false
     */
    public static function ysq_addMembersFindInsert($ysq)
    {
        try {
            $date = self::where('application_id', $ysq['application_id'])
                ->first();
            if ($date!=null){
                UserInformation::insert([
                    'information_id' => $date['application_id'],
                    'name' => $date['name'],
                    'sex' => $date['sex'],
                    'email' => $date['email'],
                    'class'=>$date['class'],
                    'produce' => $date['self_introduce']
                ]);
            }
            return $date;
        } catch (\Exception $e) {
            logError('成员添加不成功', [$e->getMessage()]);
            return false;
        }
    }
    public static function ysq_select($id){
        try{
            $date=Application::where('application_id',$id)
                ->select('email')
                ->first();
            return $date;
        }catch (Exception $e){
            logError("查找失败",[$e->getMessage()]);
            return null;
        }
    }
    public static function ysq_getDetails($id)
    {
        try {
            $res = self::select('*')
                ->where('application_id', $id)
                ->get();
            return $res;
        } catch (\Exception $err) {
            logError('用户详情页展示错误', [$err->getMessage()]);
            return null;
        }
    }
}
