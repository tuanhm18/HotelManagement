<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomBill extends Model
{
    protected $table = "RoomBill";
    protected $primaryKey = "RBIL_ID";
    public $timestamps = false;
}
