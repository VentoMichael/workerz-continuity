<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuotaExpired
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
        if (auth()->user()->plan_user_id === 1 && auth()->user()->announcements->count() >=2 || auth()->user()->plan_user_id === 2 && auth()->user()->announcements->count() >=5 || auth()->user()->plan_user_id === 3 && auth()->user()->announcements->count() >=15){
            Session::flash('quotaExpired','Votre quota d\'annonces est dépasser');
            return redirect(route('dashboard.ads'));
        }
        return $next($request);
    }
}
