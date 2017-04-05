<?php
/**
 *           ___                       _  _ _   _ ___
 *          / __|__ _ _ __  ___ _ _ __| || | | | | _ )
 *         | (_ / _` | '  \/ -_) '_(_-< __ | |_| | _ \
 *          \___\__,_|_|_|_\___|_| /__/_||_|\___/|___/
 *
 * TODOS LOS DERECHOS RESERVADOS, ÁLVARO PESO GARCÍA y GAMERSHUB
 *
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Pais;
use App\Rol;
use App\User;
use Illuminate\Http\Request;

/**
 * Esta clase contiene lo necesario para gestionar los usuarios registrados en el sistema desde el backend de la
 * aplicación
 * Class UsuariosController
 * @package App\Http\Controllers\Backend
 */
class UsuariosController extends Controller
{
    /**
     * Muestra un listado con todos los usuarios existentes en la base de datos
     * @return $this vista backend.usuarios con la información de todos los usuarios
     */
    public function show() {
        $usuarios = User::paginate(15);
        return view('backend.usuarios')->with(['usuarios' => $usuarios]);
    }

    /**
     * Recibe la información del formulario de modificación de usuarios y modifica a un usuario concreto de la
     * base de datos con los datos recibidos
     * @param $id usuario a eliminar
     * @param Request $request datos del formulario de modificacion
     * @return \Illuminate\Http\RedirectResponse página de usuarios del backend con un mensaje de confirmación
     */
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

    /**
     * Elimina a un usuario de la base de datos con la información recibida a través de un formulario
     * @param Request $request formulario que contiene la información del usuario a eliminar
     * @return \Illuminate\Http\RedirectResponse página de usuarios del backend con un mensaje de confirmación
     */
    public function destroy(Request $request) {
        $id = $request->get('id');
        $usuario = User::find($id);
        $usuario->delete();
        return redirect('/backend/usuarios')->with('mensaje', 'Usuario eliminado correctamente');
    }

    /**
     * Muestra la vista de confirmación de eliminación de usuario
     * @param $id usuario a eliminar
     * @return vista backend.eliminar_usuarios con información del usuario a eliminar
     */
    public function mostrarEliminarUsuario($id) {
        $usuario = User::find($id);
        return view('backend.eliminar_usuario')->with(['usuario' => $usuario]);
    }

    /**
     * Muestra la vista que contiene un formulario para modificar a un usuario en concreto
     * @param $id usuario a modificar
     * @return página de modificación de usuario con el formulario rellenado
     */
    public function mostrarEditarUsuario($id) {
        $usuario = User::find($id);
        $roles = Rol::all();
        $paises = Pais::all();
        return view('backend.editar_usuario')->with(['usuario' => $usuario, 'roles' => $roles, 'paises' => $paises]);
    }
}