<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Session;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (Session::get('applocale') === 'en') {
                Session::flash('forbidden',
                'Registration is required!');
            } elseif (Session::get('applocale') === 'nl') {
                Session::flash('forbidden',
                'Registratie is verplicht!');
            } else {
                Session::flash('forbidden',
                'L\'inscription est requise!');
            }

            return route('login');
        }
    }
}
