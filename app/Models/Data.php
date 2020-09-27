<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = "data";
    public $timestamps = true;
    protected $primaryKey = 'data_id';
}
