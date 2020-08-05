<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = "positions";
    protected $primaryKey = "POS_ID";
    public $timestamps = false;
}
