<?php

namespace App\Http\Controllers;

use App\Mail\NewUser;
use App\Mail\NewUserAdmin;
use App\Models\CatchPhraseUser;
use App\Models\PlanUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Cashier\Billable;

class UserController extends Controller
{
    public function plans()
    {
        //$planName = PlanUser::where('id',\request()->plan)->first();
        if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        } else {
            $notificationsReaded = '';
        }
        if (\request()->has('changePlan')) {
            $newPlan = \request('plan');
            $user = \auth()->user();
            $user->plan_user_id = $newPlan;
            $user->update();
        }
        $this->forgetNewsletter();
        $plans = PlanUser::all();
        $plan = request('plan');
        return view('users.plans', compact('plans', 'plan', 'notificationsReaded'));
    }

    public function registration_type()
    {

        if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        } else {
            $notificationsReaded = '';
        }
        $this->forgetNewsletter();
        $plan = request('plan');
        Session::put('plan', $plan);
        $type = \request('type');
        return view('auth.registration_type', compact('plan', 'type', 'notificationsReaded'));
    }

    public function index(Request $request)
    {
        if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        } else {
            $notificationsReaded = '';
        }
        return view('workers.index', compact('notificationsReaded'));
    }

    public function show(User $worker)
    {
        $this->forgetNewsletter();
        if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        } else {
            $notificationsReaded = '';
        }
        $worker = User::withLikes()->where('id', '=', $worker->id)->first();
        $randomUsers = User::Independent()->Payed()->NoBan()->orderBy('role_id',
            'DESC')->withLikes()->limit(2)->inRandomOrder()->where('slug', '!=', $worker->slug)->get();
        $randomPhrasing = CatchPhraseUser::all()->random();
        return view('workers.show', compact('worker', 'notificationsReaded', 'randomPhrasing', 'randomUsers'));
    }

    public function plansAlreadyUser()
    {
        $this->forgetNewsletter();
        $plans = PlanUser::all();
        if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        } else {
            $notificationsReaded = '';
        }
        return view('users.plans', compact('plans', 'notificationsReaded'));
    }

    public function payed(Request $request, User $user)
    {
        if ($request->has('changePlanCurrent')) {
            $user = \auth()->user();
            $user->end_plan = null;
            $user->plan_user_id = null;
            $user->is_payed = 0;
            $user->update();
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
            $plan = PlanUser::where('id', '=', $request->plan)->first();
            $planChoose = PlanUser::where('id', $request->plan)->first();
            \Stripe\Stripe::setApiKey('sk_test_51IsQzZInyQIkM7VRTENb5kOpiemA7LlBZ3iO4pAokXaydf9ZHjL9UycPh675MI1MO8tfRRm1RuyPaLy59xJ58m53002oJzC7SL');
            $priceId = $planChoose->idPlanStripe;

            header('Content-Type: application/json');

            $YOUR_DOMAIN = env('APP_URL');

            try {
                $prices = \Stripe\Price::all([
                    'lookup_keys' => [$planChoose->name],
                    'expand' => ['data.product']
                ]);
                $checkout_session = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [[
                        'price' => $priceId,
                        'quantity' => 1,
                    ]],
                    'mode' => 'subscription',
                    'success_url' => $YOUR_DOMAIN . '/dashboard',
                    'cancel_url' => url()->previous(),
                ]);
                header("HTTP/1.1 303 See Other");
                header("Location: " . $checkout_session->url);
            } catch (Error $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
            }
        } else {
            if (!$request->plan) {
                if (Session::get('applocale') === 'en') {
                    Session::flash('errors', 'There was a problem, please try again');
                } elseif (Session::get('applocale') === 'nl') {
                    Session::flash('errors', 'Er was een probleem, probeer het opnieuw.');
                } else {
                    Session::flash('errors', 'Il y a eu un souci, veuillez réessayez');
                }
                return redirect(route('users.plans'));
            }
            $planChoose = PlanUser::where('id', $request->plan)->first();
            \Stripe\Stripe::setApiKey('sk_test_51IsQzZInyQIkM7VRTENb5kOpiemA7LlBZ3iO4pAokXaydf9ZHjL9UycPh675MI1MO8tfRRm1RuyPaLy59xJ58m53002oJzC7SL');
            $priceId = $planChoose->idPlanStripe;

            header('Content-Type: application/json');

            $YOUR_DOMAIN = env('APP_URL');

            try {
                $prices = \Stripe\Price::all([
                    'lookup_keys' => [$planChoose->name],
                    'expand' => ['data.product']
                ]);
                $checkout_session = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [[
                        'price' => $priceId,
                        'quantity' => 1,
                    ]],
                    'mode' => 'subscription',
                    'success_url' => $YOUR_DOMAIN . '/dashboard',
                    'cancel_url' => url()->previous(),
                ]);
                header("HTTP/1.1 303 See Other");
                header("Location: " . $checkout_session->url);
            } catch (Error $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
            }

            if (auth()->user()) {
                $notificationsReaded = auth()->user()->notifications->where('read_at', null);
            } else {
                $notificationsReaded = '';
            }
            if (\request()->has('plan')) {
                if (auth()->user()) {
                    $notificationsReaded = auth()->user()->notifications->where('read_at', null);
                } else {
                    $notificationsReaded = '';
                }
                $this->forgetNewsletter();
                $user = Auth::user();
                $user->is_payed = 1;
                $user->update();
                $days = 1;
                $trial = Carbon::now()->addMonth($days)->subHours(2);
                $user->end_plan = $trial;
                $user->plan_user_id = $request->plan;
                if (Session::get('applocale') === 'en') {
                    Session::flash('success-inscription',
                        'Your account is now operational, thank you for your trust!');
                } elseif (Session::get('applocale') === 'nl') {
                    Session::flash('success-inscription',
                        'Uw account is nu operationeel, dank u voor uw vertrouwen!');
                } else {
                    Session::flash('success-inscription',
                        'Votre compte est désormais opérationnel, merci de votre confiance&nbsp;!');
                }
                $user->update();
                Session::forget('plan');
                Session::forget('user');
                Mail::to(env('MAIL_FROM_ADDRESS'))
                    ->send(new NewUserAdmin($user));
                Mail::to(\auth()->user()->email)
                    ->send(new NewUser($user));
            }
            $this->forgetNewsletter();
            if (\auth()) {
                if ($request->plan == 1) {
                    $user = \auth()->user();
                    $trial = Carbon::now()->addDays(7)->subHours(2);
                    $user->end_plan = $trial;
                    $user->is_payed = 1;
                    $user->sending_time_expire = 0;
                    $user->plan_user_id = $request->plan;
                    Session::forget('plan');
                    Session::forget('user');
                    $user->save();
                    return \redirect(route('dashboard.profil'));
                }
                $plan = PlanUser::where('id', '=', $request->plan)->first();
            } else {
                $plan = PlanUser::where('id', '=', $request->user()->plan_user_id)->first();

            }
        }
        if (Session::get('applocale') === 'en') {
            Session::flash('success-users',
            'Your account is almost finalized, it will be operational only after receiving your payment!');
        } elseif (Session::get('applocale') === 'nl') {
            Session::flash('success-users',
            'Uw account is bijna klaar, het zal operationeel zijn na ontvangst van uw betaling!');
        } else {
            Session::flash('success-users',
            'Votre compte est presque finalisé, il sera opérationnel qu\'après reçu de votre payement&nbsp;!');
        }

        return view('users.payed', compact('plan', 'notificationsReaded'));
    }

    public function payedUser(Request $request, User $user)
    {
        if (auth()->user()) {
            $notificationsReaded = auth()->user()->notifications->where('read_at', null);
        } else {
            $notificationsReaded = '';
        }
        $this->forgetNewsletter();
        $user = Auth::user();
        $user->is_payed = 1;
        $user->update();
        $days = 1;
        $trial = Carbon::now()->addMonth($days)->subHours(2);
        $user->end_plan = $trial;
        $user->plan_user_id = $request->plan;
        if (Session::get('applocale') === 'en') {
             Session::flash('success-inscription',
            'Your account is now operational, thank you for your trust!');
        } elseif (Session::get('applocale') === 'nl') {
             Session::flash('success-inscription',
            'Uw account is nu operationeel, dank u voor uw vertrouwen!');
        } else {
             Session::flash('success-inscription',
            'Votre compte est désormais opérationnel, merci de votre confiance&nbsp;!');
        }

        $user->update();
        Session::forget('plan');
        Session::forget('user');
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->send(new NewUserAdmin($user));
        Mail::to(\auth()->user()->email)
            ->send(new NewUser($user));
        return \redirect(route('dashboard.profil', compact('notificationsReaded')));
    }

    protected function forgetNewsletter()
    {
        \request()->session()->forget('newsletter');
    }
}
