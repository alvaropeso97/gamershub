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

use App\Exceptions\UsuarioNoEncontradoException;
use App\User;
use App\Order;
use DB;
use Auth;
use Validator;

class UsuariosController extends Controller
{

    /**
     * El usuario introduce en la barra de direcciones .../usuario/nickname y ésta función
     * se encarga de buscar al usuario correspondiente en la base de datos para mostrarlo.
     * @param $nombre Nombre del usuario
     * @return Vista del perfil del usuario
     * @throws UsuarioNoEncontradoException si no encuentra el usuario asociado al nombre
     */
    public function mostrarUsuario($nombre) {
        $usuario = User::where('name', $nombre)->first();
        if (!$usuario) {
            throw new UsuarioNoEncontradoException;
        } else {
            return view('layouts.paginas.perfil.perfil', ['id' => User::findOrFail($usuario->id)]);
        }
    }

    /**
     * Muestra la página de edición del perfil personal, el usuario debe estar logeado en la misma
     * cuenta la cual quiere editar.
     * @param $nombre
     * @return mixed
     */
    public function mostrarEditarPerfilUsuario($nombre) {
        $usuario = DB::table('users')->where('name', $nombre)->first();
        if ($usuario->id == Auth::user()->id) {
            return view('layouts.paginas.perfil.editar_perfil', ['id' => User::findOrFail($usuario->id)]);
        } else {
            //Redirigir al perfil del usuario que intenta editar
            return redirect("/usuario/$nombre");
        }
    }

    public function eliminarUsuario($id) {
        //Comprobar si es admin
        $usuario =  DB::table('users')->where('id', $id)->first();
        if ($usuario->acceso == 3 || Auth::user()->acceso < 3) {
            return redirect('/panel/usuarios')->with('error', 'No tienes los permisos para eliminar a este usuario.');
        } else {
            DB::table('users')->where('id', $id)->delete();
            return redirect('/panel/usuarios')->with('mensaje', 'El usuario ha sido eliminado correctamente de la base de datos.');
        }
    }

    public function mostrarEditarUsuario($id) {
        return view('layouts.paginas.administracion.edit_usr', ['id' => User::findOrFail($id)]);
    }

    public function modificarUsuario($id, \Illuminate\Http\Request $request) {
        //Validar formulario

        //Actualizar la información del usuario genérica
        User::where('id', $id)
            ->update(['name' => $request->get('name')],['email' => $request->get('email'),'fecha_nacimiento' => $request->get('fecha_nacimiento'),
                'password' => bcrypt($request->get('password'))]);

        return redirect('/panel/usuarios')->with('mensaje', 'Has modificado el usuario correctamente.');
    }

    public function actualizarInfo(\Illuminate\Http\Request $request) {
        //Obtener el usuario a modificar
        $usuario = User::find($request->get('id'));

        /*
         * Plataformas del usuario
         */
        //Eliminar las plataformas
        DB::table('usuarios_plataformas')->where('id_usuario', $usuario->id)->delete();
        //Volver a crear las plataformas
        if (count($request->get('plataformas')) > 0) {
        foreach ($request->get('plataformas') as $plataforma) {
            DB::table('usuarios_plataformas')->insert([
                ['id_usuario' => $usuario->id, 'id_plataforma' => $plataforma]
            ]);
        }
        }

        /*
         * Información y contacto
         */
        User::where('id', $request->get('id'))
            ->update(['genero_preferido' => $request->get('genero_preferido'),
                'pais' => $request->get('pais'), 'ciudad' => $request->get('ciudad'),
                'sexo' => $request->get('sexo'), 'firma_personal' => $request->get('firma_personal'),
                'xbox_gamertag' => $request->get('xbox_gamertag'),
                'ps_id' => $request->get('ps_id'), 'nintendo_network' => $request->get('nintendo_network'),
                'codigo_amigo_wii' => $request->get('codigo_amigo_wii'),
                'codigo_amigo_3ds' => $request->get('codigo_amigo_3ds'),
                'codigo_amigo_ds' => $request->get('codigo_amigo_ds'),
                'microsoft_gamertag' => $request->get('microsoft_gamertag'),
                'steam_id' => $request->get('steam_id'), 'twitter' => $request->get('twitter'),
                'facebook' => $request->get('facebook'), 'google' => $request->get('google'),
                'web_blog' => $request->get('web_blog')
            ]);

        //Redirigir a la página de perfil e informar del cambio
        return redirect("/usuario/$usuario->name/editar")->with('mensaje', 'Has modificado tu perfil correctamente');
    }

    public static function devolverInfo($usuario) {
        return DB::table('users')->where('id', $usuario)->first();
    }

    public static function devolverPlataformasUsuario($usuario) {
        return DB::select("select id_plataforma from usuarios_plataformas where id_usuario=".$usuario);
    }

    /*
     * ADMINISTRACIÓN
     */
    /**
     * Muestra un listado de todos los usuarios existentes en la base de datos con opciones para eliminar o modificar
     * @return vista de paginas.administracion.usuarios
     */
    public function mostrarUsuarios() {
        $usuarios = User::orderBy('id', 'desc')->get();
        return view('layouts.paginas.administracion.usuarios', ['usuarios' => $usuarios]);
    }
}