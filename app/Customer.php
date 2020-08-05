<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";
    protected $primaryKey = "CUS_ID";
    protected $fillable = ['CUS_ID'];
    public $timestamps = false;
}
