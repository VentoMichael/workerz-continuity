<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->route('worker') && $request->route('worker')->role_id == 3) {
            if (Session::get('applocale') === 'en') {
                Session::flash('not-permitted',
                'Oops! The person you are looking for is not a freelancer');
            } elseif (Session::get('applocale') === 'nl') {
Session::flash('not-permitted',
                'Oeps! De persoon die u zoekt is geen freelancer');
            } else {
                Session::flash('not-permitted',
                'Oops ! La personne que vous recherchez n\'est pas un indépendant');
            }
            return Redirect(route('workers'));
        }
        if ($request->route('worker') && $request->route('worker')->banned == 1 || $request->route('worker')->is_payed == 0 ) {
            if (Session::get('applocale') === 'en') {
                Session::flash('not-permitted',
                'Oops ! The person you are looking for is not available at the moment');
            } elseif (app()->getLocale() === 'nl') {
Session::flash('not-permitted',
                'Oeps ! De persoon die u zoekt is op dit moment niet beschikbaar');
            } else {
                Session::flash('not-permitted',
                'Oops ! La personne que vous recherchez n\'est pas disponible pour le moment');
            }
            return Redirect(route('workers'));
        }
        return $next($request);
    }
}
