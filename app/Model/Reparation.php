<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reparation extends Model
{
    protected $table = 'reparations';
    public $timestamps = false;
    protected $primaryKey = 'id_rp';

}
