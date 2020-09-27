<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attention extends Model
{
    protected $table = "attention";
    public $timestamps = true;
    protected $primaryKey = 'attention_id';
}
