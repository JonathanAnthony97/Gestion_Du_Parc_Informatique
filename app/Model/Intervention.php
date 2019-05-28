<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    protected $table = 'interventions';
    protected $primaryKey = 'id_inter';
    public $timestamps = false;
}
