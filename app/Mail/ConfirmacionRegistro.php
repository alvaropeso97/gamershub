<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ConfirmacionRegistro extends Mailable
{
    use Queueable, SerializesModels;

    protected $usuario;

    public function __construct(User $usuario)
    {
        $this->usuario = $usuario;
    }

    public function build()
    {   $usuario_id = $this->usuario->id;
        $token = DB::select("select token from confirm_email where user_id = $usuario_id LIMIT 1");
        return $this->from('no-reply@gamershub.es')
            ->view('mail.confirmacion_registro')->with([
                'token' => $token,
            ]);
    }
}