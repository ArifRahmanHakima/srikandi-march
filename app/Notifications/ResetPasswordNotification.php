<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    public $token;

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
        // Kirim link ke halaman reset password Livewire
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset Password Akun Anda')
            ->greeting('Halo ' . $notifiable->name . ',')
            ->line('Kami menerima permintaan untuk mengatur ulang kata sandi Anda.')
            ->action('Reset Password', $url)
            ->line('Jika Anda tidak meminta reset, abaikan email ini.');
    }
}
