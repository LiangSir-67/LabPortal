<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    protected $table = "fans";
    public $timestamps = true;
    protected $primaryKey = 'fans_id';
}
