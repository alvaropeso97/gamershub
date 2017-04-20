<?php

namespace TCG\Voyager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Traits\Translatable;

class Articulo extends Model
{
    use Translatable;

    protected $translatable = ['titulo', 'descripcion', 'cont', 'body', 'img', 'tipo', 'meta_keywords'];

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->id_autor && Auth::user()) {
            $this->id_autor = Auth::user()->id;
        }

        parent::save();
    }

    public function idAutor()
    {
        return $this->belongsTo('App\User', 'id_autor');
    }
}
