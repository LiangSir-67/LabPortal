<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsBulletinClassfy extends Model
{
    protected $table = "news_bulletin_classfy";
    public $timestamps = true;
    protected $primaryKey = 'class_id';
}
