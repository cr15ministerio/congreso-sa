<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route(
            'password.reset',
            [
                'token' => $this->token,
                'email' => $notifiable->email,
            ],
            false
        ));

        return (new MailMessage)
            ->subject('Recuperación de contraseña')
            ->greeting('Hola')
            ->line('Recibimos una solicitud para restablecer la contraseña de tu cuenta.')
            ->action('Restablecer contraseña', $url)
            ->line('Si no solicitaste este cambio, podés ignorar este mensaje.')
            ->line('Este enlace expirará en 60 minutos.')
            ->salutation('Equipo de Congreso Secundaria Aprende');
    }
}