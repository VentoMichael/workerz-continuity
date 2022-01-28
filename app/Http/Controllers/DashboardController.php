<?php

namespace App\Http\Controllers;

use App\Mail\AdsEarlyExpire;
use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\Category;
use App\Models\CategoryUser;
use App\Models\Message;
use App\Models\Phone;
use App\Models\PhysicalAdress;
use App\Models\Province;
use App\Models\ProvinceUser;
use App\Models\StartDate;
use App\Models\StartMonth;
use App\Models\User;
use App\Models\Website;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class DashboardController extends Controller
{
    public function index()
    {

        $noReadMsgs = count(auth()->user()->talkedTo->where('is_read', 0)->where('content', '!==', null));
        $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        $this->sendExpireNotificationAccount();
        $messages = Message::where('to_id', '=', \auth()->user()->id)->with('user')->orderByDesc('created_at',
            'ASC')->take(3)->get();
        $lastAnnouncements = Announcement::where('user_id', '=',
            \auth()->user()->id)->WithLikes()->NoBan()->Published()->orderBy('view_count',
            'DESC')->orderBy('created_at', 'DESC')->take(3)->get();
        $notifications = tap(\auth()->user()->unreadNotifications)->markAsRead()->take(3);

        return view('dashboard.index', compact('notifications', 'notificationsReaded', 'lastAnnouncements', 'messages', 'noReadMsgs'));
    }

    public function profil()
    {
        $stripe = new \Stripe\StripeClient(
            'sk_test_51IsQzZInyQIkM7VRTENb5kOpiemA7LlBZ3iO4pAokXaydf9ZHjL9UycPh675MI1MO8tfRRm1RuyPaLy59xJ58m53002oJzC7SL'
        );
        $customers = $stripe->customers->all()['data'];
        $subscriptions = $stripe->subscriptions->all()['data'];
        foreach ($customers as $customer) {
            $cusId = $customer->id;
        }

        foreach ($subscriptions as $subscription) {
            $subscriptionId = $subscription->id;
        }
        if ($subscription->customer === $cusId) {
            $realSub = $stripe->subscriptions->retrieve(
                $subscriptionId,
                []
            );
        }
        $noReadMsgs = count(auth()->user()->talkedTo->where('is_read', 0)->where('content', '!==', null));
        $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        $this->sendExpireNotificationAccount();
        $disponibilities = auth()->user()->startDate;
        $regions = auth()->user()->provinces;
        $categories = auth()->user()->categoryUser;
        $this->sendExpireNotificationAccount();
        $planId = auth()->user()->plan_user_id;
        $plan = \App\Models\PlanUser::where('id', '=', $planId)->first();
        return view('dashboard.profil', compact('plan', 'realSub', 'notificationsReaded', 'disponibilities', 'categories', 'regions', 'noReadMsgs'));
    }

    public function updateUser(Request $request)
    {
        $plan = \auth()->user()->plan_user_id;
        $this->sendExpireNotificationAccount();
        $user = \auth()->user();
        $request->validate([
            'name' => 'sometimes|string|max:255', Rule::unique('users')->ignore(\auth()->id()),
            'surname' => 'sometimes|string|max:255',
            'number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:14',
            'email' => 'sometimes|required|string|max:255', Rule::unique('users')->ignore($user->id),
            'picture' => 'sometimes|image|mimes:jpg,png,jpeg|max:2048',
        ]);
        if ($request->password && $request->password != $user->getOriginal('password')) {
            $request->validate([
                'password' => [
                    'min:8',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                ],
            ]);
            $user->password = Hash::make($request->password);
        }
        if ($request->picture && $request->picture != $user->getOriginal('picture')) {
            Storage::makeDirectory('users');
            $filename = request('picture')->hashName();
            $pic = Image::make(\request()->file('picture'))->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path('users/' . $filename));
            $user->picture = 'users/' . $filename;
        }

        if ($user->plan_user_id !== 1) {
            Validator::make(\request()->all(), [
                'adress' => 'sometimes|required',
                'pricemax' => 'sometimes|max:999999',
                'website' => 'sometimes|nullable', 'url',
                'websitetwo' => 'sometimes|nullable', 'url',
                'websitethree' => 'sometimes|nullable', 'url',
                'description' => 'sometimes|required', 'max:256',
                'job' => 'sometimes|required',
                'location' => 'sometimes|required',
                'locationtwo' => 'sometimes|not_in:0',
                'facebook' => 'sometimes|nullable', 'url',
                'twitter' => 'sometimes|nullable', 'url',
                'instagram' => 'sometimes|nullable', 'url',
                'linkedin' => 'sometimes|nullable', 'url',
                'locationthree' => 'sometimes|not_in:0',
                'categoryUser' => 'sometimes|required|array|max:' . $user->plan_user_id,
                'disponibilites' => [
                    'sometimes|array|max:7',
                ],
            ])->validate();
        }
        $user->surname = $request->surname;
        $user->catchPhrase = $request->catchPhrase;
        $user->possibility_job = $request->possibility_job;
        $user->job = $request->job;
        $user->pricemax = $request->pricemax;
        $user->description = $request->description;
        $ct = new CategoryUser();
        $ct->category_id = \request('categoryUser');
        $user->categoryUser()->detach();
        $user->categoryUser()->attach($ct->category_id);
        $user->website = $request->website;
        $di = new startDate();
        $di->start_date_id = \request('disponibilities');
        $user->startDate()->detach();
        $user->startDate()->attach($di->start_date_id);
        $pro = new ProvinceUser();
        $pro->province_id = \request('location');
        $user->provinces()->detach();
        $user->provinces()->attach($pro->province_id);
        $user->websites()->delete();
        $user->websites()->saveMany([
            new Website(['link' => $request->websitetwo]),
            new Website(['link' => $request->websitethree]),
        ]);
        $user->adresses()->delete();
        $user->adresses()->saveMany([
            new PhysicalAdress(['postal_adress' => $request->adress, 'province_id' => $request->location]),
            new PhysicalAdress(['postal_adress' => $request->adresstwo, 'province_id' => $request->locationtwo]),
            new PhysicalAdress(['postal_adress' => $request->adressthree, 'province_id' => $request->locationthree]),
        ]);
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->instagram = $request->instagram;
        $user->linkedin = $request->linkedin;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->slug = Str::slug($request->name);

        $user->phones()->delete();
        $user->phones()->saveMany([
            new Phone(['number' => $request->number]),
            new Phone(['number' => $request->phonetwo]),
            new Phone(['number' => $request->phonethree]),
        ]);
        $user->save();
        if ($user->wasChanged()) {
            if (Session::get('applocale') === 'en') {
                Session::flash('success-update', 'Your profile has been updated!');
            } elseif (Session::get('applocale') === 'nl') {
                Session::flash('success-update', 'Je profiel is bijgewerkt!');
            } else {
                Session::flash('success-update', 'Votre profil a bien été mis a jour&nbsp;!');
            }
        }
        return redirect(route('dashboard.profil', compact('plan')));

    }

    public function settings()
    {
        $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        $noReadMsgs = count(auth()->user()->talkedTo->where('is_read', 0)->where('content', '!==', null));
        $this->sendExpireNotificationAccount();
        $user_categories = auth()->user()->categoryUser;
        $user_disponibilities = auth()->user()->startDate;
        $disponibilities = StartDate::orderBy('id')->get();
        $regions = Province::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $plan = \auth()->user()->plan_user_id;
        return view('dashboard.edit',
            compact('disponibilities', 'notificationsReaded', 'plan', 'categories', 'regions', 'user_categories', 'user_disponibilities', 'noReadMsgs'));
    }

    public function show(Announcement $announcement)
    {
        $noReadMsgs = count(auth()->user()->talkedTo->where('is_read', 0)->where('content', '!==', null));
        $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        $this->sendExpireNotificationAds();
        $this->sendExpireNotificationAccount();
        $firstAd = Auth::user()->announcements()->NotDraft()->firstOrFail();
        $user = User::where('id', '=', \auth()->user()->id)->with('announcements')->firstOrFail();
        $announcement = Announcement::withLikes()->where('id', '=', $announcement->id)->firstOrFail();
        return view('dashboard.show', compact('announcement', 'notificationsReaded', 'noReadMsgs', 'user', 'firstAd'));
    }

    public function showDraft(Announcement $announcement)
    {
        $noReadMsgs = count(auth()->user()->talkedTo->where('is_read', 0)->where('content', '!==', null));
        $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        $firstAdDraft = Auth::user()->announcements()->Draft()->firstOrFail();
        $user = User::where('id', '=', \auth()->user()->id)->with('announcements')->firstOrFail();
        $announcement = Announcement::withLikes()->where('id', '=', $announcement->id)->firstOrFail();
        return view('dashboard.draftAd', compact('announcement', 'notificationsReaded', 'noReadMsgs', 'user', 'firstAdDraft'));
    }

    public function editAdsDraft(Announcement $announcement)
    {
        $noReadMsgs = count(auth()->user()->talkedTo->where('is_read', 0)->where('content', '!==', null));
        $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        $plan = $announcement->plan_announcement_id;
        $categories = Category::all();
        $regions = Province::all();
        $disponibilities = StartMonth::all();
        $announcement_categories = $announcement->categoryAds;
        $announcement_disponibilities = $announcement->startMonth;
        return view('dashboard.updateAdsDraft',
            compact('announcement', 'categories', 'notificationsReaded', 'regions', 'plan', 'disponibilities',
                'announcement_categories', 'noReadMsgs', 'announcement_disponibilities'));
    }

    public function editAds(Announcement $announcement)
    {
        $noReadMsgs = count(auth()->user()->talkedTo->where('is_read', 0)->where('content', '!==', null));
        $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        $this->sendExpireNotificationAds();
        $this->sendExpireNotificationAccount();
        $plan = $announcement->plan_announcement_id;
        $categories = Category::all();
        $regions = Province::all();
        $disponibilities = StartMonth::all();
        $announcement_categories = $announcement->categoryAds;
        $announcement_disponibilities = $announcement->startMonth;
        return view('dashboard.updateAds', compact('announcement', 'categories', 'regions', 'plan', 'disponibilities',
            'announcement_categories', 'noReadMsgs', 'notificationsReaded', 'announcement_disponibilities'));
    }

    public function updateAds(Announcement $announcement, Request $request)
    {
        $request->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|max:256|required',
            'job' => 'sometimes|max:256|required',
            'location' => 'sometimes|not_in:0|required',
            'pricemax' => 'numeric|max:999999|nullable|sometimes',
            'startmonth' => 'sometimes|required',
            'categoryAds' => 'sometimes|array|required|max:' . $announcement->plan_announcement_id
        ]);

        if ($request->has('publish')) {
            if ($announcement->plan_announcement_id == 2 || $announcement->plan_announcement_id == 3) {
                $publish = true;
                $ad = $announcement->slug;
                $planAd = $announcement->plan_announcement_id;
                $announcement = Announcement::where('slug', '=', $ad)->first();
                return \redirect(route('announcements.payed', compact('publish', 'announcement', 'planAd')));
            } else {
                $announcement->is_draft = 0;
                $announcement->is_payed = 1;
                $announcement->end_plan = Carbon::now()->addDays(7)->addHours(2);
                $announcement->update();
                if (Session::get('applocale') === 'en') {
                    Session::flash('success-update', 'Your ad has been published!');
                } elseif (Session::get('applocale') === 'nl') {
                    Session::flash('success-update', 'Uw advertentie is gepubliceerd!');
                } else {
                    Session::flash('success-update', 'Votre annonce a bien été publié&nbsp;!');
                }
                return \redirect(route('dashboard.ads'));
            }
        }


        $announcement = Announcement::withLikes()->where('slug', '=', $announcement->slug)->first();
        $announcement->title = $request->title;
        $announcement->catchPhrase = $request->catchPhrase;
        $announcement->slug = Str::slug($request->title);
        $announcement->description = $request->description;
        $announcement->job = $request->job;
        $announcement->province_id = $request->location;
        $announcement->pricemax = $request->pricemax;
        $announcement->start_month_id = $request->startmonth;
        $ct = new AnnouncementCategory();
        $ct->category_id = \request('categoryAds');
        $announcement->categoryAds()->detach();
        $announcement->categoryAds()->attach($ct->category_id);
        if ($request->picture && $request->picture != $announcement->getOriginal('picture')) {
            Storage::makeDirectory('ads');
            $filename = request('picture')->hashName();
            $img = Image::make($request->file('picture'))->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path('ads/' . $filename));
            $announcement->picture = 'ads/' . $filename;
        }
        $announcement->plan_announcement_id = $announcement->getOriginal('plan_announcement_id');
        $announcement->update();
        if ($announcement->wasChanged()) {

            if (Session::get('applocale') === 'en') {
                Session::flash('success-update', 'Your ad has been updated!');
            } elseif (Session::get('applocale') === 'nl') {
                Session::flash('success-update', 'Uw advertentie is bijgewerkt!');
            } else {
                Session::flash('success-update', 'Votre annonce a bien été mis a jour&nbsp;!');
            }

        } else {

            if (Session::get('applocale') === 'en') {
                Session::flash('success-update-not', 'Nothing has been changed!');
            } elseif (Session::get('applocale') === 'nl') {
                Session::flash('success-update-not', 'Er is niets veranderd!');
            } else {
                Session::flash('success-update-not', 'Rien n\'a été changé&nbsp;!');
            }

        }
        if ($announcement->is_draft === 1) {
            return redirect('dashboard/ads/draft/' . $announcement->slug);
        } else {
            return redirect('dashboard/ads/' . $announcement->slug);
        }
    }

    public function deleteAds(Announcement $announcement)
    {
        Announcement::where('id', '=', $announcement->id)->delete();
        if (Session::get('applocale') === 'en') {
            $msgSuccess = 'Deleted ad&nbsp!';
        } elseif (Session::get('applocale') === 'nl') {
            $msgSuccess = 'Advertentie verwijderd&nbsp!';
        } else {
            $msgSuccess = 'Annonce supprimée&nbsp!';
        }
        return Redirect::route('dashboard.ads')->with('success-delete', $msgSuccess);
    }

    public function ads(Announcement $announcement)
    {
        $noReadMsgs = count(auth()->user()->talkedTo->where('is_read', 0)->where('content', '!==', null));
        $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        $this->sendExpireNotificationAccount();
        $firstAd = Auth::user()->announcements()->NotDraft()->first();
        $firstAdDraft = Auth::user()->announcements()->Draft()->first();
        return view('dashboard.ads', compact('firstAd', 'notificationsReaded', 'noReadMsgs', 'firstAdDraft'));
    }

    protected function sendExpireNotificationAccount()
    {
        if (auth()->user()->end_plan < Carbon::now()->addHours(2)->subDays(1) && auth()->user()->sending_time_expire == 1) {
            if (auth()->user()->sending_time_expire == 0) {
                auth()->user()->sending_time_expire = 1;
                auth()->user()->end_plan = null;
                auth()->user()->plan_user_id = null;
                auth()->user()->save();
                Mail::to(env('MAIL_FROM_ADDRESS'))
                    ->send(new AdsEarlyExpire(auth()->user()));

                if (Session::get('applocale') === 'en') {
                    Session::flash('expire', 'Attention, your account will expire in one day!');
                } elseif (Session::get('applocale') === 'nl') {
                    Session::flash('expire', 'Attentie, uw account vervalt over één dag!');
                } else {
                    Session::flash('expire', 'Attention, votre compte va expirer dans un jour&nbsp;!');
                }

            }
        }
        if (auth()->user()->end_plan <= Carbon::now()) {
            auth()->user()->is_payed = 0;
            auth()->user()->end_plan = null;
            auth()->user()->plan_user_id = null;
            auth()->user()->update();
        }
    }

    protected function sendExpireNotificationAds()
    {
        foreach (auth()->user()->announcements as $adsExpire) {
            if ($adsExpire->end_plan < Carbon::now()->subDay(1)->addHours(2) && $adsExpire->sending_time_expire == 1) {
                if ($adsExpire->sending_time_expire == 0) {
                    $adsExpire->sending_time_expire = 1;
                    $adsExpire->update();
                    Mail::to(auth()->user()->email)
                        ->send(new AdsEarlyExpire($adsExpire));

                    if (Session::get('applocale') === 'en') {
                        Session::flash('expire', 'Attention, one of your ads will expire in one day!');
                    } elseif (Session::get('applocale') === 'nl') {
                        Session::flash('expire', 'Attentie, één van uw advertenties vervalt over één dag!');
                    } else {
                        Session::flash('expire', 'Attention, une de vos annonce va expirer dans un jour&nbsp;!');
                    }

                }
            }
            if ($adsExpire->end_plan <= Carbon::now()->addHours(2)) {
                $adsExpire->is_payed = 0;
                $adsExpire->end_plan = null;
                $adsExpire->plan_announcement_id = null;
                $adsExpire->update();
            }
        }
    }

    public function activateSubscription()
    {
        $stripe = new \Stripe\StripeClient(
            'sk_test_51IsQzZInyQIkM7VRTENb5kOpiemA7LlBZ3iO4pAokXaydf9ZHjL9UycPh675MI1MO8tfRRm1RuyPaLy59xJ58m53002oJzC7SL'
        );
        $customers = $stripe->customers->all()['data'];
        $subscriptions = $stripe->subscriptions->all()['data'];
        foreach ($customers as $customer) {
            $cusId = $customer->id;
        }

        foreach ($subscriptions as $subscription) {
            $subscriptionId = $subscription->id;
        }
        if ($subscription->customer === $cusId) {
            $realSub = $stripe->subscriptions->retrieve(
                $subscriptionId,
                []
            );
        }
        $value = $subscription->current_period_end;

        $date = Carbon::parse($value)->locale('en')->addHours(4)->isoFormat('Do MMMM YYYY, H:mm');

        \Stripe\Stripe::setApiKey('sk_test_51IsQzZInyQIkM7VRTENb5kOpiemA7LlBZ3iO4pAokXaydf9ZHjL9UycPh675MI1MO8tfRRm1RuyPaLy59xJ58m53002oJzC7SL');
        \Stripe\Subscription::update(
            $realSub->id,
            [
                'cancel_at_period_end' => false,
            ]
        );
        if (Session::get('applocale') === 'en') {
            Session::flash('success-update', 'Your subscription has been reactivated and will be renewed on');
        } elseif (Session::get('applocale') === 'nl') {
            Session::flash('success-update', 'Uw abonnement is opnieuw geactiveerd en zal worden vernieuwd op');
        } else {
            Session::flash('success-update', 'Votre abonnement a bien été réactiver et se renouvelera le ' . $date);
        }
        return \redirect(route('dashboard.profil'));
    }

    public function cancelSubscription()
    {
        $stripe = new \Stripe\StripeClient(
            'sk_test_51IsQzZInyQIkM7VRTENb5kOpiemA7LlBZ3iO4pAokXaydf9ZHjL9UycPh675MI1MO8tfRRm1RuyPaLy59xJ58m53002oJzC7SL'
        );
        $customers = $stripe->customers->all()['data'];
        $subscriptions = $stripe->subscriptions->all()['data'];
        foreach ($customers as $customer) {
            $cusId = $customer->id;
        }

        foreach ($subscriptions as $subscription) {
            $subscriptionId = $subscription->id;
        }
        if ($subscription->customer === $cusId) {
            $realSub = $stripe->subscriptions->retrieve(
                $subscriptionId,
                []
            );
        }
        $value = $subscription->current_period_end;
        $date = Carbon::parse($value)->locale('en')->addHours(4)->isoFormat('Do MMMM YYYY, H:mm');
        \Stripe\Stripe::setApiKey('sk_test_51IsQzZInyQIkM7VRTENb5kOpiemA7LlBZ3iO4pAokXaydf9ZHjL9UycPh675MI1MO8tfRRm1RuyPaLy59xJ58m53002oJzC7SL');
        \Stripe\Subscription::update(
            $realSub->id,
            [
                'cancel_at_period_end' => true,
            ]
        );
        if (Session::get('applocale') === 'en') {
            Session::flash('success-update', 'Your subscription has been cancelled and will end on');
        } elseif (Session::get('applocale') === 'nl') {
            Session::flash('success-update', 'Uw abonnement is geannuleerd en zal eindigen op');
        } else {
            Session::flash('success-update', 'Votre abonnement a bien été résilier il prendra fin le ' . $date);
        }
        return \redirect(route('dashboard.profil'));
    }
}
