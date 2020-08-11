<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "Employees";
    protected $primaryKey = "EMP_ID";
    public $timestamps = false;
}
