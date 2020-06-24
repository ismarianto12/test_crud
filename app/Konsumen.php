<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    protected $table = 'konsumen';
    protected $fillable = [
        'konsumen',
        'jkendaraan',
        'n_polisi',
        'tgl_lahir',
        'jk',
        'no_hp',

    ];

}
