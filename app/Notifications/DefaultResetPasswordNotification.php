<?php

namespace CodeFlix\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class DefaultResetPasswordNotification extends ResetPassword
{
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject("Redefinição de Senha")
                    ->line('Você está recebendo este e-mail porque uma redefinição de senha foi requisitada.')
                    ->action('Redefinir Senha', url('pasword.reset', $this->token))
                    ->line('Se você não requisitou isto, por favor desconsidere.');
    }
}
