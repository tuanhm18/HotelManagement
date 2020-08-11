<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceBill extends Model
{
    protected $table = "ServiceBill";
    protected $primaryKey = "SBIL_ID";
    public $timestamps = false;
}
