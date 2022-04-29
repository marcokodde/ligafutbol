<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail(){

        $details = [
            'title' =>'Correo desde Galveston Cup',
            'body'  =>'Mensaje del cuerpo del correo',
            'name'  =>'ahavamarketing'
        ];
        Mail::to('ffcastaneda@gmail.com')->send(new ConfirmationMail($details));
        return 'Correo electrónico enviado';
    }
}
