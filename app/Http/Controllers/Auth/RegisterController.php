<?php

namespace App\Http\Controllers\Auth;

use App\PrivacidadUsuario;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $usuario_creado = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'fecha_nacimiento' => $data["ano"].'-'.$data["mes"].'-'.$data["dia"],
            'password' => bcrypt($data['password']),
        ]);

        //Crear opciones de privacidad
        PrivacidadUsuario::create([
            'id_usuario' => User::orderby('id','DESC')->first()->id
        ]);

        return $usuario_creado;

    }
}
