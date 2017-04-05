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
use App\Permiso;
use App\Rol;
use App\RolPermiso;
use Illuminate\Http\Request;

/**
 * Esta clase contiene lo necesario para gestionar los roles dentro de la aplicación
 * Class RolesController
 * @package App\Http\Controllers\Backend
 */
class RolesController extends Controller
{
    /**
     * Muestra una vista con una lista que contiene la información de todos los roles almacenados en la
     * base de datos
     * @return vista backend.roles con información de todos los roles existentes en el sistema
     */
    public function show() {
        $roles = Rol::all();
        $permisos = Permiso::all();
        return view('backend.roles')->with(['roles' => $roles, 'permisos' => $permisos]);
    }

    /**
     * Recibe los datos del formulario de creación de roles y los almacena en la base de datos
     * @param Request $request información del formulario [AJAX]
     */
    public function storeRol(Request $request) {
        $response = array(
            'status' => 'success',
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'json' => $request->json,
        );

        $rol = new Rol();
        $rol->nombre = $response['nombre'];
        $rol->descripcion = $response['descripcion'];
        $rol->save();

        $permisos = json_decode($response['json']);
        foreach ($permisos as $permiso) {
            $rolPermiso = new RolPermiso();
            $rolPermiso->rol_id = $rol->id;
            $rolPermiso->permiso_id = $permiso;
            $rolPermiso->save();
        }
    }

    /**
     * Elimina un rol determinado del sistema
     * @param Request $request rol a eliminar [AJAX]
     */
    public function destroyRol(Request $request) {
        $response = array(
            'status' => 'success',
            'id' => $request->id,
        );
        $rol = Rol::find($response['id']);
        $rol->delete();
    }

    /**
     * Recibe los datos del formulario de creación de permisos y los almacena en la base de datos
     * @param Request $request información del formulario [AJAX]
     */
    public function storePermiso(Request $request) {
        $response = array(
            'status' => 'success',
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        );

        $permiso = new Permiso();
        $permiso->nombre = $response['nombre'];
        $permiso->descripcion = $response['descripcion'];
        $permiso->save();
    }

    /**
     * Elimina un permiso determinado del sistema
     * @param Request $request permiso a eliminar [AJAX]
     */
    public function destroyPermiso(Request $request) {
        $response = array(
            'status' => 'success',
            'id' => $request->id,
        );
        $permiso = Permiso::find($response['id']);
        $permiso->delete();
    }
}