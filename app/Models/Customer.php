<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\VerifyEmail;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;


class Customer extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function getAuthIdentifierName()
    {
        return 'id'; // Ensure Laravel knows the primary key
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail()); // Use your custom notification
    }

}
