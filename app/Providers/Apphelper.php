<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class Apphelper extends ServiceProvider
{
    public function register()
    {
       require_once app_path().'Helpers/App_helper.php';
    }

    public function boot()
    {
        //
    }
}
