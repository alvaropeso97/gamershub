<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Pais;
use App\Rol;
use App\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function show() {
        $usuarios = User::paginate(15);
        return view('backend.usuarios')->with(['usuarios' => $usuarios]);
    }

    public function update($id, Request $request) {
        $usuario = User::find($id);
        $usuario->name = $request->get('name');
        $usuario->nombre = $request->get('nombre');
        $usuario->apellidos = $request->get('apellidos');
        $usuario->email = $request->get('email');
        $usuario->fecha_nacimiento = $request->get('fecha_nacimiento');
        $usuario->pais = $request->get('pais');
        $usuario->ciudad = $request->get('ciudad');
        $usuario->sexo = $request->get('sexo');
        $usuario->firma_personal = $request->get('firma_personal');
        if ($request->get('password') != "") {
            $usuario->password = bcrypt($request->get('password'));
        }
        $usuario->verificada = $request->get('verificada');
        $usuario->acceso = $request->get('rol');
        $usuario->save();
        return redirect('/backend/usuarios/'.$id)->with('mensaje', 'Usuario modificado correctamente');
    }

    public function mostrarEditarUsuario($id) {
        $usuario = User::find($id);
        $roles = Rol::all();
        $paises = Pais::all();
        return view('backend.editar_usuario')->with(['usuario' => $usuario, 'roles' => $roles, 'paises' => $paises]);
    }
}