<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    protected $table = 'utilisateurs';
    protected $primaryKey = 'id_uti';
    public $timestamps = false;
}
