<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Censor extends Model
{
    protected $table = "censor";
    public $timestamps = true;
    protected $primaryKey = 'censor_id';
}
