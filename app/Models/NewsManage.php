<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsManage extends Model
{
    protected $table = "news_manage";
    public $timestamps = true;
    protected $primaryKey = 'news_id';

}
