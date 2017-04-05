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

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmacionRegistro extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var User usuario del sistema receptor del email
     */
    protected $usuario;

    /**
     * NotificacionRegistro constructor.
     * @param User $usuario usuario del sistema receptor del email
     */
    public function __construct(User $usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Construye un correo electrónico a través de la vista mail.confirmacion_registro con los
     * datos del $usuario receptor.
     * El correo electrónico notifica al usuario que ha creado su cuenta correctamente y debe confirmar
     * su dirección de correo electrónico mediante un enlace autogenerado con su $id y un $token de seguridad
     * @return $this objeto de tipo Mailable
     */
    public function build()
    {
        $token = $this->usuario->getConfirmEmail->token; //Obtener token de seguridad generado para el usuario
        return $this->from('no-reply@gamershub.es')
            ->view('mail.confirmacion_registro')->with([
                'id' => $this->usuario->id,
                'name' => $this->usuario->name,
                'token' => $token,
            ]);
    }
}