<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $guarded = [];

    function konsumen()
    {
        return $this->belongsTo(Konsumen::class);
    }
}
