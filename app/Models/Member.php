<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Member extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'username', 'email', 'password', 'phone', 'user_type',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
