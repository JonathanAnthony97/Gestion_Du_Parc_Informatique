<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $table = 'ventes';
    public $timestamps = false;
    protected $primaryKey = 'id_v';
}
