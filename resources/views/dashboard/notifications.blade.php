@extends('layouts.appDashboard')
@section('content')
    @if($notifications->count() >0)
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/question-signe-en-cercles.svg')}}" alt="{!! __('messages.question__mark')}}">
            <p>{!! __('messages.dashboard_workerz.details__notifications')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
        @endif
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-ads">
            <h2 aria-level="2">
                {!! __('messages.dashboard_workerz.notifications__title')}}
            </h2>
            <div class="container-form-ads container-messenger-form">
                <div class="container-search-ads container-notification-search">
                    <div
                        class="container-announcments-dashboard container-notifs-dashboard"
                        wire:loading.class="load">
                        @forelse($notifications as $notification)
                            <div class="container-message-index">
                                <a class="{{ Request::is('dashboard/messages/'.$notification->id) || Request::is('dashboard/messages/'.$notification->id.'/*') ? "container-announcements-active" : "" }} container-announcements @if($notification->read_at !== null) notificationSeen @endif"
                                   href="{{route('dashboard.notificationsShow',[$notification->id])}}"
                                   aria-current="{{ Request::is('dashboard/messages/*') ? "page" : "" }}">
                                    <section>
                                        @if($notification->type === 'App\Notifications\AdCreated')
                                            <img src="{{asset('svg/ad.svg')}}" alt="{!! __('messages.ads.icone__ads__alt')}}">
                                            <div>
                                            <h3 aria-level="3">
                                                {!! __('messages.dashboard_workerz.new__ad')}} <i>{{$notification->data['announcement']['title']}}</i>
                                            </h3>
                                            </div>
                                            @endif

                                            @if($notification->type == 'App\Notifications\MessageReceived' && array_key_exists('user', $notification['data']['message']))
                                            <div class="container-notifications-dashboard">
                                                <img itemprop="image" src="{{asset('svg/messenger.svg')}}"
                                                     alt="{!! __('messages.dashboard_workerz.icone__msg')}}">
                                                <h3 aria-level="3">
                                                    {!! __('messages.dashboard_workerz.new__msg')}} <i>{{$notification['data']['message']['user']['name']}}</i>
                                                </h3>
                                            </div>
                                    @endif
                                    </section>
                                </a>
                            </div>
                        @empty
                            <div class="container-announcements" style="margin: 0;">
                                <section>
                                    <img src="{{asset('svg/market.svg')}}" alt="{!! __('messages.dashboard_workerz.actif__on')}}">

                                    <div>
                                        <h3 aria-level="3">
                                            {!! __('messages.dashboard_workerz.no__notifications')}}
                                        </h3>
                                    </div>
                                </section>
                            </div>
                        @endforelse
                    </div>
                </div>
                <section class="container-profil-dashboard container-ads-dashboard">
                    <div class="container-picture-title-dashboard-ads">
                        <div class="container-picture-dashboard">
                            <h4 aria-level="4">
                                {!! __('messages.dashboard_workerz.select_details__notification')}}
                            </h4>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
@endsection
