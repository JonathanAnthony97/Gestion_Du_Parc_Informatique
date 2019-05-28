<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Swich extends Model
{
   protected $table = 'switchs';
   protected $primaryKey = 'id_ma';
   public $timestamps = false;
}
