<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = 'maintenances';
    public $timestamps = false;

     protected $primaryKey = 'id_main';
}
