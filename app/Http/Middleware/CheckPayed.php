<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckPayed
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
        if (!auth()) {
            if ($request->user()->is_payed == 1) {
                if (Session::get('applocale') === 'en') {
                    Session::flash('errors',
                        'Oops, you can\'t access it.');
                } elseif (Session::get('applocale') === 'nl') {
                    Session::flash('errors',
                        'Oeps, je kunt er niet bij.');
                } else {
                    Session::flash('errors',
                        'Oops, vous ne pouvez pas y accédez.');
                }
                return redirect(route('dashboard'));
            }
        }
        return $next($request);
    }
}
