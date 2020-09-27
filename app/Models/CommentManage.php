<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentManage extends Model
{
    protected $table = "comment_manage";
    public $timestamps = true;
    protected $primaryKey = 'comment_id';
}
