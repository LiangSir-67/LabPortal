<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsBulletinManage extends Model
{
    protected $table = "news_bulletin_manage";
    public $timestamps = true;
    protected $primaryKey = 'nb_id';
}
