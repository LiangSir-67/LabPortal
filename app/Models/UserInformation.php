<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Application;

class UserInformation extends Model
{
    protected $table = "user_information";
    public $timestamps = true;
    protected $primaryKey = 'information_id';
    protected $guarded=[];
//
//    public static function addMembersToUse(AddInquireMembersRequest $request)//通过新成员报名审核
//    {
//
//        try {
//            $ysq = $request;
//            $data = Application::addMembersFind($ysq);//获取Application表信息
//            return $data;
//        } catch (\Exception $e) {
//            logError('获取新成员信息失败', [$e->getMessage()]);
//        }
//    }
}
