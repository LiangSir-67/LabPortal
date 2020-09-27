<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationSetting extends Model
{
    protected $table = "application_setting";
    public $timestamps = true;
    protected $primaryKey = 'setting_id';
}
