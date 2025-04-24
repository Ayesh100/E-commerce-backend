<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends BaseVerifyEmail
{
    public function toMail($notifiable)
    {
        // Manually build the verification URL
        $verificationUrl = 'https://mylaravelecommerce-x59pn02e.b4a.run/api/email/verify/' 
            . $notifiable->id . '/' . sha1($notifiable->email);

        // Return the email message
        return (new MailMessage)
            ->subject('Verify Your Email Address')
            ->line('Please click the button below to verify your email address.')
            ->action('Verify Email', $verificationUrl)
            ->line('If you did not create an account, no further action is required.');
    }
}
