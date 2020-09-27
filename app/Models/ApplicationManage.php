<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationManage extends Model
{
    protected $table = "application_manage";
    public $timestamps = true;
    protected $primaryKey = 'manage_id';
}
