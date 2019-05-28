<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    protected $table = 'materiels';
    protected $primaryKey = 'id_ma';
    public $timestamps = false;

}
