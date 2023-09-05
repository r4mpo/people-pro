<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewResetPasswordNotification extends Notification
{
    use Queueable;
    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Redefinir senha de acesso ao PEOPLEPRO')
                    ->line('Este e-mail (com validade de 30min) tem o intuito de possibilitar a alteração da sua senha de acesso à plataforma.')
                    ->line('Se você não tiver feito a solicitação, basta ignorar esta mensagem. Caso o contrário, botão abaixo levará direto ao formulário de redefinição.')
                    ->action('REDEFINIR SENHA', url('reset-password', $this->token))
                    ->line('Prezamos pela qualidade no uso de nossos sistemas e, acima de tudo, pela sua segurança digital.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
