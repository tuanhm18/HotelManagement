<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingRoom extends Model
{
    protected $table = "bookingroom";
    protected $primaryKey = "BROO_ID";
    public $timestamps = false;
}
