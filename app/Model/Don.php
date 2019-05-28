<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Don extends Model
{
    protected $table = 'dons';
    public $timestamps = false;
    protected $primaryKey = 'id_d';
}
