<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = Session::get('applocale', config('app.locale'));
        App::setLocale($locale);

        \Log::info('Application locale set to: ' . $locale);

        return $next($request);
    }

    /**
     * Convert Laravel locale to system locale format.
     *
     * @param string $locale
     * @return string
     */
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
