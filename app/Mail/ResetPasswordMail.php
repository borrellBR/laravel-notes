<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function build()
    {
        return $this->subject('Recuperación de contraseña')
                    ->html("
                        <p>Hola,</p>
                        <p>Hemos recibido una solicitud para restablecer tu contraseña.</p>
                        <p>Este es tu token de recuperación:</p>
                        <h2>{$this->token}</h2>
                        <p>Si tú no hiciste esta solicitud, ignora este mensaje.</p>
                    ");
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Reset Password Mail',
        );
    }
}
