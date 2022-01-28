@extends('layouts.appDashboard')
@section('content')
    @if (Session::has('success-update-not'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60"
                                                                  src="{{asset('svg/cross.svg')}}"
                                                                  alt="{!! __('messages.bad__answer')}}">
            <p>{!!session('success-update-not')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('success-update'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}"
                                                                  alt="{!! __('messages.good__answer')}}">
            <p>{!!session('success-update')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('success-inscription'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}"
                                                                  alt="{!! __('messages.good__answer')}}">
            <p>{!!session('success-inscription')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('success-delete'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}"
                                                                  alt="{!! __('messages.good__answer')}}">
            <p>{!!session('success-delete')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('quotaExpired'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/cross.svg')}}"
                                                                  alt="{!! __('messages.bad__answer')}}">
            <p>{!!session('quotaExpired')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-ads">
            <h2 aria-level="2">
                {!! __('messages.dashboard_workerz.ads__title')}}
            </h2>
            <div>
                <div class="container-profil-dashboard container-ads-dashboard">
                    <div class="container-draftads">
                        @if(auth()->user()->announcements()->Draft()->count())
                            <section>
                                <h3 aria-level="3" class="hidden">
                                    {!! __('messages.dashboard_workerz.title__draft')}}
                                </h3>
                                <img width="150" height="150" src="{{asset('svg/draft.svg')}}"
                                     alt="{!! __('messages.dashboard_workerz.alt__icon__draft')}}">
                                <a class="button-cta button-edition" href="ads/draft/{{$firstAdDraft->slug}}">
                                    {!! __('messages.dashboard_workerz.title__draft')}}
                                </a>
                            </section>
                        @endif
                        @if(auth()->user()->announcements()->NotDraft()->count())
                            <section>
                                <h3 aria-level="3" class="hidden">
                                    {!! __('messages.dashboard_workerz.my__ads__title')}}
                                </h3>
                                <img width="150" height="150" src="{{asset('svg/ad.svg')}}" alt="{!! __('messages.dashboard_workerz.icone__ads__alt')}}">
                                <a class="button-cta button-edition" href="ads/{{$firstAd->slug}}">
                                    {!! __('messages.dashboard_workerz.my__ads__title')}}
                                </a>
                            </section>
                        @endif
                    </div>
                    <section class="container-ads-give">

                        @if(auth()->user()->plan_user_id === 1 && auth()->user()->announcements->count() >= 2 || auth()->user()->plan_user_id === 2 && auth()->user()->announcements->count() >= 5)
                            <h3>
                                {!! __('messages.dashboard_workerz.quota__expired__title')}}
                            </h3>
                            <p>{!! __('messages.dashboard_workerz.think__word')}}</p>
                            <a class="button-cta button-edition" href="{{route('users.plans')}}">
                                {!! __('messages.dashboard_workerz.pass__sup__plan')}}
                            </a>
                        @elseif(auth()->user()->plan_user_id === 3 && auth()->user()->announcements->count() > 16)
                            <p>
                                {!! __('messages.dashboard_workerz.quota__expired__text')}}
                            </p>
                        @else
                            <h3>
                                {!! __('messages.dashboard_workerz.ads__benefits__title')}}
                            </h3>
                            <p>{!! __('messages.dashboard_workerz.ads__benefits__title__text')}}</p>
                            <a class="button-cta button-edition" href="{{route('announcements.create')}}">
                                {!! __('messages.dashboard_workerz.ads__benefits__link')}}
                            </a>
                        @endif
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection
