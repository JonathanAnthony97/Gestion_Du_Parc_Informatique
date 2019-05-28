<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AffUtilisateur extends Model
{
    protected $table = 'materielutilisateurs'; 
    protected $primaryKey = 'id_matUti';
    public $timestamps = false;

}
