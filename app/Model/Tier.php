<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
    protected $table = 'tiers';
    protected $primaryKey = 'id_tier';
    public $timestamps = false;
}
