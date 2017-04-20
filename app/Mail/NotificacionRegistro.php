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

class NotificacionRegistro extends Mailable
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
     * Construye un correo electrónico a través de la vista mail.notificacion_registro con los
     * datos del $usuario receptor.
     * El correo electrónico notifica al usuario que ha confirmado su cuenta correctamente
     * @return $this objeto de tipo Mailable
     */
    public function build()
    {
        return $this->from('no-reply@gamershub.es')
            ->view('mail.notificacion_registro')->with([
                'name' => $this->usuario->name,
            ]);
    }
}