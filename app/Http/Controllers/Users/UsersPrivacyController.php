<?php
/**
 *  ____  _             _     _ _
 * |  _ \| | __ _ _   _| |__ (_) |_   ___  ___
 * | |_) | |/ _` | | | | '_ \| | __| / _ \/ __|
 * |  __/| | (_| | |_| | |_) | | |_ |  __/\__ \
 * |_|   |_|\__,_|\__, |_.__/|_|\__(_)___||___/
 *                |___/
 *
 * TODOS LOS DERECHOS RESERVADOS ÁLVARO PESO GARCÍA
 * WWW.PLAYBIT.ES
 * CONTACTO@PLAYBIT.ES
 * ALVARO.PESO@PLAYBIT.ES
 * @PlaybitES
 * 2017
 *
 */

namespace App\Http\Controllers\Users;

use App\UserPrivacy;
use DB;
use Request;

class UsersPrivacyController extends Controller
{
    public function actualizar(\Illuminate\Http\Request $request)
    {
        //Obtener usuario
        $usuario = User::find($request->get('id'));

        //Actualizar la base de datos
        UserPrivacy::where('id_usuario', $request->get('id'))
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
        return UserPrivacy::where('id_usuario',$id)->first();
    }
}
