<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Rol;
use App\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function show() {
        $usuarios = User::paginate(15);
        return view('backend.usuarios')->with(['usuarios' => $usuarios]);
    }

    public function update($id) {
        return redirect()->back();
    }

    public function mostrarEditarUsuario($id) {
        $usuario = User::find($id);
        $roles = Rol::all();
        return view('backend.editar_usuario')->with(['usuario' => $usuario, 'roles' => $roles]);
    }
}