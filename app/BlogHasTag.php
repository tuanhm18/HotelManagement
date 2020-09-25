<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogHasTag extends Model
{
    protected $table = "bloghastags";
    public $timestamps  = false;
    protected $primaryKey = "BTAG_ID";
}
