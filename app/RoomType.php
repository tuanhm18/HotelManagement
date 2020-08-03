<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $table = "roomtype";
    protected $primaryKey = "RTYP_ID";
    public $timestamps = false;
}
