<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
{
    App::setLocale(Session::get('applocale', Config::get('app.locale')));
}

    protected function convertLocale($locale)
    {
        $locales = [
            'en' => 'en_US.UTF-8',
            'es' => 'es_ES.UTF-8',
            'lv' => 'lv_LV.UTF-8',
        ];

        return $locales[$locale] ?? 'en_US.UTF-8';
    }
}
