<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = "Bills";
    protected $primaryKey = "BIL_ID";
    public $timestamps = false;
}
