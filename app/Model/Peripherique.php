<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Peripherique extends Model
{
    protected $table = 'peripheriques';
    protected $primaryKey = 'id_ma';
    public $timestamps = false;
    
}
