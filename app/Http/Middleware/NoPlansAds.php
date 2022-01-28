<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NoPlansAds
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
        if (request('plan') != 1 && request('plan') != 2 && request('plan') != 3 ) {
            if (Session::get('applocale') === 'en') {
                Session::flash('errors',
                    'Oops, there was a problem, please try again in a few moments.');
            } elseif (app()->getLocale() === 'nl') {
                Session::flash('errors',
                    'Oeps, er was een probleem, probeer het over een paar minuten nog eens.');
            } else {
                Session::flash('errors',
                    'Oops, il y a eu un souci, veuillez réessayer dans quelques instants.');
            }
            return redirect(route('announcements.plans').'#plans');
        }
        return $next($request);
    }
}
