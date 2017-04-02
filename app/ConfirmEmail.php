<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfirmEmail extends Model
{
    protected $table = 'confirm_email';
    protected $fillable = ['user_id','token'];
    public $timestamps = false;

    public function getUsuario() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
