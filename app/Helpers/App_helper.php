<?php

namespace App\Helpers;
class App_helper
{
    public static function appname()
    {
        return str_replace('_',' ',env('nama_aplikasi'));
    }
}
