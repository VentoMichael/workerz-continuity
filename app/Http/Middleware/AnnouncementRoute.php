<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AnnouncementRoute
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
        if($request->route('announcement') && $request->route('announcement')->is_draft == 1 && $request->route('announcement')->banned == 1  ) {
            if (Session::get('applocale') === 'en') {
                Session::flash('not-permitted',
                'Oops ! The ad you are looking for is not available');
            } elseif (Session::get('applocale') === 'nl') {
                Session::flash('not-permitted',
                'Oeps ! De advertentie die u zoekt is niet beschikbaar');
            } else {
               Session::flash('not-permitted',
                'Oops ! L\'annonce que vous recherchez n\'est pas disponible');
            }
            return Redirect(route('announcements'));
        }
        return $next($request);
    }
}
