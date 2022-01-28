<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class UserLikeController extends Controller
{
    public function store(User $worker)
    {
        $worker->likeU(auth()->id());
        if (Session::get('applocale') === 'en') {
            $msgSuccess = ' was liked, thank you!';
        } elseif (Session::get('applocale') === 'nl') {
            $msgSuccess = ' was leuk, dank je!';
        } else {
            $msgSuccess = ' a été aimé, merci&nbsp!';
        }
        return Redirect::to(URL::previous() . "#search")->with('loveOk', ucfirst($worker->name) . $msgSuccess);
    }

    public function delete(User $worker)
    {
        $worker->dislikeU(auth()->id());
        if (Session::get('applocale') === 'en') {
            $msgSuccess = 'The like has been well removed, thank you&nbsp!';
        } elseif (Session::get('applocale') === 'nl') {
            $msgSuccess = 'De like is goed verwijderd, dank u&nbsp!';
        } else {
            $msgSuccess = 'Le j\'aime a bien été retiré, merci&nbsp!';
        }
        return Redirect::to(URL::previous() . "#search")->with('loveNotOk', $msgSuccess);
    }
}
