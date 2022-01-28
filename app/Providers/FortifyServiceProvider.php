<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Category;
use App\Models\Province;
use App\Models\StartDate;
use App\Models\StartDateUser;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Symfony\Component\Console\Input\Input;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::loginView(function () {
            if (\request()->has('registerRequired')) {
                if (Session::get('applocale') === 'en') {
                    $msgSucess = 'The connection is required!';
                } elseif (Session::get('applocale') === 'nl') {
                    $msgSucess = 'Inloggen is vereist!';
                } else {
                    $msgSucess = 'La connexion est requise&nbsp!';
                }
            } else {
                if (Session::get('applocale') === 'en') {
                    $msgSucess = 'Successful connection&nbsp!';
                } elseif (Session::get('applocale') === 'nl') {
                    $msgSucess = 'Succesvolle verbinding&nbsp!';
                } else {
                    $msgSucess = 'Connexion réussie&nbsp!';
                }
            }
            Session::flash('success-inscription', $msgSucess);
            return view('auth.login');
        });
        Fortify::registerView(function (Request $request) {
            $disponibilities = StartDate::all()->sortBy('id');
            $regions = Province::all()->sortBy('name');
            $categories = Category::all()->sortBy('name');
            $plan = Session::get('plan');
            $planName = Session::get('planName');
            $type = $request->type;
            Session::put('type', $type);
            $type = Session::get('type');
            if ($request->old('type') == null && $request->type == null) {
                if (Session::get('applocale') === 'en') {
                    $msgSucess = 'Oops, there was a glitch, please try again in a few moments.';
                } elseif (Session::get('applocale') === 'nl') {
                    $msgSucess = 'Oeps, er was een probleem, probeer het over een paar minuten nog eens.';
                } else {
                    $msgSucess = 'Oops, il y a eu un souci, veuillez réessayer dans quelques instants.';
                }
                return redirect(route('users.plans'))->with(
                    'errors',
                    $msgSucess
                );
            }
            return view(
                'auth.register',
                compact('plan', 'planName', 'type', 'disponibilities', 'regions', 'categories', 'request')
            );
        });
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });
        Fortify::resetPasswordView(function () {
            return view('auth.reset-password');
        });
        Fortify::verifyEmailView(function () {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
            return view('auth.verify-email', compact('notificationsReaded'));
        });
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        RateLimiter::for("login", function () {
            Limit::perMinute(5);
        });
    }
}
