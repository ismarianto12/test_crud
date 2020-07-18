<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    protected $table = 'tmharga';
    protected $guarded = [];

    function Login()
    {
        $this->belongsTo(Login::class);
    }
}
