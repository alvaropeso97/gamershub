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

namespace App\Http\Controllers;

use App\PrivacidadUsuario;
use DB;
use Request;

class Privacidad_usuariosController extends Controller
{
    public function actualizar(\Illuminate\Http\Request $request)
    {
        //Obtener usuario
        $usuario = User::find($request->get('id'));

        //Actualizar la base de datos
        PrivacidadUsuario::where('id_usuario', $request->get('id'))
            ->update(['mostrar_perfil' => $request->get('mostrar_perfil'),
                'mostrar_ciudad' => $request->get('mostrar_ciudad'),
                'mostrar_edad' => $request->get('mostrar_edad'),
                'mostrar_sexo' => $request->get('mostrar_sexo'),
                'mostrar_cuentas_jue' => $request->get('mostrar_cuentas_jue'),
                'mostrar_cuentas_con' => $request->get('mostrar_cuentas_con')
            ]);

        //Redirigir a la página de perfil e informar del cambio
        return redirect("/usuario/$usuario->name/editar")->with('mensaje', 'Has modificado las opciones de privacidad correctamente');
    }

    public static function devolverOpcionesPrivacidad($id) {
        return PrivacidadUsuario::where('id_usuario',$id)->first();
    }
}
