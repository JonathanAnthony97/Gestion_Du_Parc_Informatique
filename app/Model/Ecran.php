<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ecran extends Model
{
    protected $table = 'ecrans';
    protected $primaryKey = 'id_ma';
    public $timestamps = false;
}
