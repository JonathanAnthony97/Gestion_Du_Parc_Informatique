<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ordinateur extends Model
{
    protected $table = 'ordinateurs';
    protected $primaryKey = 'id_ma';
    public $timestamps = false;
}
