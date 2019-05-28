<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
    protected $table = 'imprimantes';
    protected $primaryKey = 'id_ma';
    public $timestamps = false;
}
