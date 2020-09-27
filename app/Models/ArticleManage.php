<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleManage extends Model
{
    protected $table = "article_manage";
    public $timestamps = true;
    protected $primaryKey = 'article_id';
}
