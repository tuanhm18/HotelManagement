<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = "images";
    protected $primaryKey = "IMA_ID";
    public $timestamps = false;
}
