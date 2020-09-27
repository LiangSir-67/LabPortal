<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Labor extends Model
{
    protected $table = "labor";
    public $timestamps = true;
    protected $primaryKey = 'labor_id';
}
