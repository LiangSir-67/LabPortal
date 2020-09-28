<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchList extends Model
{
    protected $table = "search_list";
    public $timestamps = true;
    protected $primaryKey = 's_id';
}
