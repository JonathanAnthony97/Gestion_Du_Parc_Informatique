<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AffDepartemnt extends Model
{
    protected $table = 'histoaffectations';
    protected $primaryKey = 'id_histo';
    public $timestamps = false;

}
