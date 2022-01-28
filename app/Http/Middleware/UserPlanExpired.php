<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserPlanExpired
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->end_plan === null) {
            if(Session::get('applocale') === 'en') {
                Session::flash('success-update-not','A plan is required, please select one');
            }elseif(Session::get('applocale') === 'nl') {
                Session::flash('success-update-not','Een plan is vereist, kies er een');
            }else{
                Session::flash('success-update-not','Un plan est requis, veuillez en sélectionnez un');
            }
            return redirect(route('dashboard.profil'));
        }
        return $next($request);
    }
}
