<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmacionRegistro;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra la vista de página de Inicio
     */
    public function index()
    {
        return view('layouts.paginas.index');
    }

}
