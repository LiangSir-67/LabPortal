<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodMember extends Model
{
    protected $table = "good_members";
    public $timestamps = true;
    protected $primaryKey = 'member_id';
}
