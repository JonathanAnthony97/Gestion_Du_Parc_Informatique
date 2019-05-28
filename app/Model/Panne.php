<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Panne extends Model
{
    protected $table = 'pannes';
    public $timestamps = false;
      protected $primaryKey = 'id_pan';
}
