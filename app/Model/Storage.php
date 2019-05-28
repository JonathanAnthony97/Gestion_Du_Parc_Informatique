<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $table = 'storages';
    protected $primaryKey = 'id_ma';
    public $timestamps = false;
}
