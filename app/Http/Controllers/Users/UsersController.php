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

use App\Exceptions\UsuarioNoEncontradoException;
use App\Mail\NotificacionRegistro;
use App\Models\Users\User;
use App\Order;
use DB;
use Auth;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
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

    /**
     * Esta función verifica un usuario a través de una url formada por el $id del usuario y
     * el $token de verificación siguiendo una serie de comprobaciones y operaciones:
     * 0. Comprobar si el usuario obtenido a través de la $id existe
     * 1. Comprobar si el usuario obtenido a través de la $id ya ha sido verificado
     * 2. Comprobar que el $token coincida con el usuario obtenido a través de la $id sea correcto
     * 3. Verificar usuario. En la tabla users cambiar el valor de 'verificada' de 0 a 1
     * 4. Enviar notificación al correo electrónico correspondiente del usuario
     * @param $id identificador del usuario
     * @param $token de verificación contenido en la tabla 'confirm_email'
     * @return vista de confirmar_email con un mensaje para dar información al usuario del estado
     * del proceso de confirmación
     */
    public static function confirmarEmail($id, $token) {
        //Comprobar si el usuario existe
        $usuario = User::find($id);
        if ($usuario != null) {
            //Comprobar si el usuario ya está verificado
            if ($usuario->verified == 0) {
                //Comprobar si el token es correcto
                if ($usuario->userEmailToken->token == $token) {
                    //El usuario existe, no ha sido verificado y el token es correcto
                    //Verificar cuenta
                    $usuario->verified = '1';
                    $usuario->save();
                    //Enviar notificación
                    Mail::to($usuario->email)
                        ->send(new NotificacionRegistro($usuario));
                    return view('users.user.confirm_email', ['accion' => '3']);
                } else {
                    return view('users.user.confirm_email', ['accion' => '2']);
                }
            } else {
                return view('users.user.confirm_email', ['accion' => '1']);
            }
        } else {
            return view('users.user.confirm_email', ['accion' => '0']);
        }
    }

    /**
     * Esta función autentica a un usuario en el sistema a través del formulario /login siguiendo una serie
     * de operaciones y comprobaciones:
     * 0. Comprueba que el usuario introducido en el formulario exista en la base de datos
     * 1. Comprueba que el usuario haya sido verificado
     * 2. Comprueba que el email introducido coincida con la contraseña
     * 3. Autentica al usuario
     * 4. Redirige al usuario a la página principal
     * @param Request $request datos obtenidos a través del formulario de acceso
     * @return vista /login si ha ocurrido algún error | redirección a la página principal si se ha autenticado
     * con éxito
     */
    public function autenticar(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $usuario = User::where('email', $email)->first();
        //Comprobar si el usuario existe
        if ($usuario != null) {
            //Comprobar que el usuario esté verificado
            if ($usuario->verified == 1) {
                if (\Illuminate\Support\Facades\Auth::attempt(['email' => $email, 'password' => $password, 'verified' => 1])) {
                    //Autenticación correcta
                    return redirect('/'); //Redirigir a la página principal
                } else {
                    return redirect('/login')->with('error', 'La contraseña introducida es incorrecta');
                }
            } else {
                return redirect('/login')->with('error', 'Ésta cuenta todavía no ha sido confirmada, si eres el propietario revisa tu bandeja de correo electrónico para hacerlo');
            }
        } else {
            return redirect('/login')->with('error', 'El usuario asociado a esa dirección de correo electrónico no existe');
        }
    }
}