<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = "Booking";
    protected $primaryKey = "BOO_ID";
    public $timestamps = false;
}
