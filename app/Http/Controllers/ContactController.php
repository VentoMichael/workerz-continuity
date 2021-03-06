<?php

namespace App\Http\Controllers;

use App\Mail\ContactMe;
use App\Mail\ContactUser;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ContactController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        }else{
            $notificationsReaded = '';
        }
        return view('contact.index',compact('notificationsReaded'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
        if ($request->surname) {
            $surname = $request->surname;
        } else {
            $surname = null;
        }
        Contact::create([
            'name' => $data['name'],
            'surname' => $surname,
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],
        ]);
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->send(new ContactMe($data));
        Mail::to($data['email'])
            ->send(new ContactUser($data));
        if (Session::get('applocale') === 'en') {
            $msgSuccess = 'Your message has been sent successfully. We will contact you soon!';
        } elseif (Session::get('applocale') === 'nl') {
            $msgSuccess = 'Uw bericht is succesvol verzonden. Wij zullen spoedig contact met u opnemen!';
        } else {
            $msgSuccess = 'Votre message a ??t?? envoy?? avec succ??s. Nous vous contacterons bient??t&nbsp!';
        }
        return Redirect::to(URL::previous()."#createMsg")->with('success-send', $msgSuccess);
    }

}
