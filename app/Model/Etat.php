<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Etat extends Model
{
    protected $table = 'etats';
    protected $primaryKey = 'id_eta';
    public $timestamps = false;

}
