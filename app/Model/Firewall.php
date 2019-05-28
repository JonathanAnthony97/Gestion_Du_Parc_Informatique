<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Firewall extends Model
{
    protected $table = 'firewalls';
    protected $primaryKey = 'id_ma';
    public $timestamps =false;
}
