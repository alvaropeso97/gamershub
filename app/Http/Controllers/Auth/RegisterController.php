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

namespace App\Http\Controllers\Auth;

use App\Models\Users\UserEmailToken;
use App\Mail\ConfirmacionRegistro;
use App\Models\Users\UserPrivacy;
use App\Models\Users\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
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
            'nickname' => 'required|max:25|unique:users',
            'name' => 'required|max:50',
            'email' => 'required|email|max:255|unique:users|confirmed',
            'country' => 'required',
            'city' => 'required|max:25',
            'ano' => 'required', 'mes' => 'required', 'dia' => 'required',
            'password' => 'required|min:6|confirmed',
            'g-recaptcha-response' => 'required|recaptcha',
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
            'nickname' => $data['nickname'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            'country_id' => $data['country'],
            'city' => $data['city'],
            'email' => $data['email'],
            'birthdate' => $data["ano"].'-'.$data["mes"].'-'.$data["dia"],
            'password' => bcrypt($data['password']),
        ]);

        $user = User::orderby('id','DESC')->first();

        //Crear opciones de privacidad
        UserPrivacy::create([
            'user_id' => $user->id
        ]);

        //Generar token de confirmación de email
        $token = self::generarToken($data['name']);
        UserEmailToken::create([
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
