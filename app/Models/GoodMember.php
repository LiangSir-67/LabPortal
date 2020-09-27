<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodMember extends Model
{
    protected $table = "good_memebers";
    public $timestamps = true;
    protected $primaryKey = 'memeber_id';
}
