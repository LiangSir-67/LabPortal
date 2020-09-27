<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserManage extends Model
{
    protected $table = "user_manage";
    public $timestamps = true;
    protected $primaryKey = 'manage_id';
}
