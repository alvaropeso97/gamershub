<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Imagen;
use Illuminate\Http\Request;

class ImagenesController extends Controller
{
    public function show() {
        $imagenes = Imagen::all();
        return view('backend.imagenes')->with(['imagenes' => $imagenes]);
    }
}