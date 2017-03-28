<?php

namespace App\Http\Controllers\Auth;

use App\ConfirmEmail;
use App\Mail\ConfirmacionRegistro;
use App\PrivacidadUsuario;
use App\User;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * @var dirección donde los usuarios van a ser redirigidos después de registrarse
     */
    protected $redirectTo = '/';

    /**
     * RegisterController constructor.
     * Se hace uso de el middleware 'guest' que solo permite acceder al controlador a
     * los usuarios que no están logeados en el sistema
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Valida los campos del formulario de registro
     * @param array $data datos obtenidos en el formulario de registro
     * @return mixed estado de la validación
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:50|unique:users',
            'email' => 'required|email|max:255|unique:users|confirmed',
            'ano' => 'required', 'mes' => 'required', 'dia' => 'required',
            'password' => 'required|min:6|confirmed',
            'condiciones' => 'required',
        ]);
    }

    /**
     * Esta función es llamada cuando la validación del registro se ha completado correctamente
     * y realiza las siguientes operaciones:
     * 0. Crea un nuevo usuario en la base de datos con los valores obtenidos del formulario de registro
     * 1. Crea las opciones de privacidad para el usuario por defecto en la base de datos
     * 2. Genera el token de confirmación de correo electrónico
     * 3. Envía un correo electrónico al usuario con información para confirmar su cuenta
     * @param array $data datos obtenidos del formulario de registro
     * @return static estado del registro tras completar las operaciones
     */
    protected function create(array $data)
    {
        $usuario_creado = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'fecha_nacimiento' => $data["ano"].'-'.$data["mes"].'-'.$data["dia"],
            'password' => bcrypt($data['password']),
        ]);

        $user = User::orderby('id','DESC')->first();

        //Crear opciones de privacidad
        PrivacidadUsuario::create([
            'id_usuario' => $user->id
        ]);

        //Generar token de confirmación de email
        $token = self::generarToken($data['name']);
        ConfirmEmail::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        //Enviar email de confirmación
        Mail::to($data['email'])
            ->send(new ConfirmacionRegistro($user));

        return $usuario_creado;
    }

    /**
     * Genera un token de seguridad a partir de una cadena
     * @param $name nombre del usuario
     * @return string token de seguridad generado
     */
    public static function generarToken($name) {
        return md5(uniqid($name, true));
    }
}
