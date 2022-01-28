<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NoPlansUser
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
        $planUser = Session::get('plan');
        if (auth()->user()) {
            if (auth()->user()->end_plan) {
                if(Session::get('applocale') === 'en') {
                    Session::flash('errors',
                    'Oops, there was a problem, please try again in a few moments.');
                }elseif(Session::get('applocale') === 'nl') {
                    Session::flash('errors',
                    'Oeps, er was een probleem, probeer het over een paar minuten nog eens.');
                }else{
                    Session::flash('errors',
                    'Oops, il y a eu un souci, veuillez réessayer dans quelques instants.');
                }
                return redirect(route('users.plans') . '#plans');

            }
        }
        return $next($request);
    }
}
