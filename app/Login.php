<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Login extends Authenticatable
{

    use Notifiable;

    protected $table = 'login';
    protected $guarded = [];


    protected $hidden = [
        'password',
    ];

}
