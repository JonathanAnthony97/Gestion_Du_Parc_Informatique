<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $table = 'serveurs';
    protected $primaryKey = 'id_ma';
    public $timestamps = false;
}
