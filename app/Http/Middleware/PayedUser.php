<?php

namespace App\Http\Middleware;

use App\Models\PlanUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PayedUser
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
        if ($request->user()->plan_user_id == null && $request->user()->is_payed != 1 && $request->user()->sending_time_expire == 1){
            if (Session::get('applocale') === 'en') {
                Session::flash('expire',
                'Your account has been suspended because no plan is associated with it, it will be operational after you choose your plan !');
            } elseif (Session::get('applocale') === 'nl') {
                Session::flash('expire',
                'Uw account is opgeschort omdat er geen plan aan gekoppeld is, het zal operationeel zijn zodra u uw plan gekozen heeft!');
            } else {
Session::flash('expire',
                'Votre compte a été suspendu car aucun plan ne lui est associé, il sera opérationnel qu\'après avoir choisis votre plan !');
            }

            return \redirect(route('dashboard'));
        }
        if ($request->user()->plan_user_id == 2 && $request->user()->is_payed != 1 && $request->user()->sending_time_expire == 0 || $request->user()->plan_user_id == 3 && $request->user()->is_payed != 1 && $request->user()->sending_time_expire == 0) {
            $plan = $request->user()->plan_user_id;
            return redirect(route('users.payed', compact('plan')));
        }
        return $next($request);
    }
}
