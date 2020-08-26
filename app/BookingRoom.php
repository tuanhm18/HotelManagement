<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingRoom extends Model
{
    protected $table = "BookingRoom";
    protected $primaryKey = "BROO_ID";
    public $timestamps = false;
}
