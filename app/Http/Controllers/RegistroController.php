<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class RegistroController extends Controller
{
    public static function emailConfirmacion() {
        Mail::send('emails.confirmacion_registro', ['key' => 'value'], function($message)
        {
            $message->to('alvaro.peso.97@gmail.com', 'Nombre')->subject('GamersHUB');
        });
    }
}