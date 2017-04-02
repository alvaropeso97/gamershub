<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Permiso;
use App\Rol;
use App\RolPermiso;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function show() {
        $roles = Rol::all();
        $permisos = Permiso::all();
        return view('backend.roles')->with(['roles' => $roles, 'permisos' => $permisos]);
    }

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

    public function destroyRol(Request $request) {
        $response = array(
            'status' => 'success',
            'id' => $request->id,
        );
        $rol = Rol::find($response['id']);
        $rol->delete();
    }

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

    public function destroyPermiso(Request $request) {
        $response = array(
            'status' => 'success',
            'id' => $request->id,
        );
        $permiso = Permiso::find($response['id']);
        $permiso->delete();
    }
}