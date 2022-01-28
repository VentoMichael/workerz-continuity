<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class AnnouncementLikeController extends Controller
{
    public function store(Announcement $announcement){
        $announcement->like(auth()->id());
        if (Session::get('applocale') === 'en') {
            $msgSuccess = ' was loved, thank you!';
        } elseif (Session::get('applocale') === 'nl') {
            $msgSuccess = ' was geliefd, dank je!';
        } else {
            $msgSuccess = ' a été aimé, merci&nbsp;!';
        }
        return Redirect::to(URL::previous() . "#search")->with('loveOk', ucfirst($announcement->title) . $msgSuccess);
    }
    public function delete(Announcement $announcement){
        $announcement->dislike(auth()->id());
        if (Session::get('applocale') === 'en') {
            $msgSuccess = 'The like has been removed, thank you!';
        } elseif (Session::get('applocale') === 'nl') {
            $msgSuccess = 'De like is verwijderd, dank je!';
        } else {
            $msgSuccess = 'Le j\'aime a bien été retiré, merci&nbsp;!';
        }
        return Redirect::to(URL::previous() . "#search")->with('loveNotOk', $msgSuccess);
    }
}
