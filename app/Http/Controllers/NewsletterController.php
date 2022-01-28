<?php

namespace App\Http\Controllers;

use App\Mail\ContactMe;
use App\Mail\NewNewsletterUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        Validator::make(\request()->all(), [
            'newsletter' => 'required|email',
        ])->validate();
        if ($request->newsletter) {
            $request->session()->put('newsletter', '1');
            if (!Newsletter::hasMember($request->newsletter)) {
                Newsletter::subscribe($request->newsletter);
                if (Session::get('applocale') === 'en') {
                    $msgSuccess = 'Your subscription to our newsletter has been taken into account&nbsp!';
                } elseif (Session::get('applocale') === 'nl') {
                    $msgSuccess = 'Uw inschrijving op onze nieuwsbrief is in aanmerking genomen&nbsp!';
                } else {
                    $msgSuccess = 'Votre inscription à notre newsletter a bien été prise en compte&nbsp!';
                }
                return back()->with('successNew', $msgSuccess);
            } else {
                if (Session::get('applocale') === 'en') {
                    $msgSuccess = 'Oops&nbsp! You are already registered&nbsp!';
                } elseif (Session::get('applocale') === 'nl') {
                    $msgSuccess = 'Oeps&nbsp! U bent al geregistreerd&nbsp!';
                } else {
                    $msgSuccess = 'Oops&nbsp! Vous êtes déjà inscris&nbsp!';
                }
                return back()->with('failureNew', $msgSuccess);
            }
        }
    }
}
