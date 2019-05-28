<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reform extends Model
{
    protected $table = 'reforms';
    protected $primaryKey = 'id_rf';
    public $timestamps = false;
}
