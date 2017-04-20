<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desarrollador extends Model
{
    protected $table = 'desarrolladores';
    protected $fillable = ['id','nombre'];
    public $timestamps = false;
}
