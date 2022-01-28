@extends('layouts.appDashboard')
@section('content')
    <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/question-signe-en-cercles.svg')}}" alt="{!! __('messages.question__mark')}}">
        <p>{!! __('messages.dashboard_workerz.details__notifications')}}</p>
        <span class="crossHide" id="crossHide">&times;</span>
    </div>
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-messages">
            <h2 aria-level="2">
                {!! __('messages.dashboard_workerz.my__notifications')}}
            </h2>
            <div class="container-form-ads container-messenger-form container-notification-form">
                <div class="container-search-ads containernotif container-notifications-show">
                    <div
                        class="container-announcments-dashboard"
                        wire:loading.class="load">
                        @forelse($notifications->sortByDesc('created_at')->sortBy('read_at') as $notification)
                            <div class="container-message-index">
                                <a class="{{ Request::is('dashboard/notifications/'.$notification->id) || Request::is('dashboard/notifications/'.$notification->id.'/*') ? "container-announcements-active" : "" }} container-announcements @if($notification->read_at !== null) notificationSeen @endif"
                                   href="{{route('dashboard.notificationsShow',[$notification->id])}}"
                                   aria-current="{{ Request::is('dashboard/notifications/*') ? "page" : "" }}">
                                    <section>
                                        @if($notification->type === 'App\Notifications\AdCreated')
                                            <img src="{{asset('svg/ad.svg')}}" alt="{!! __('messages.dashboard_workerz.icone__ads__alt')}}">

                                            <div>

                                                <h3 aria-level="3">
                                                    {!! __('messages.dashboard_workerz.new__ad__text')}} <i>{{$notification->data['announcement']['title']}}
</i>                                                </h3>
                                            </div>
                                        @else
                                            <img src="{{asset('svg/messenger.svg')}}" alt="{!! __('messages.dashboard_workerz.icone__msg')}}">

                                            <div>
                                                <h3 aria-level="3">
                                                    {!! __('messages.dashboard_workerz.new__msg__text')}}
                                                    de <i>{{$notification->data['message']['user']['name']}}</i>
                                                </h3>
                                            </div>
                                        @endif
                                    </section>
                                </a>
                            </div>
                        @empty
                            <div class="container-announcements" style="margin: 0;">
                                <section>
                                    <img src="{{asset('svg/notif.svg')}}" alt="{!! __('messages.dashboard_workerz.icon__notification')}}">
                                    <div>
                                        <h3 aria-level="3">
                                            {!! __('messages.dashboard_workerz.no__notif__found')}}
                                        </h3>
                                        <p>
                                            <a href="{{route('dashboard')}}" class="button-cta">{!! __('messages.dashboard_workerz.my__dashboard')}}</a></p>
                                    </div>
                                </section>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="container-notification-details">
                    @if($n->type === 'App\Notifications\AdCreated')
                        <div>
                            <div class="container-message container-notification">
                                <img src="{{asset('svg/ad.svg')}}" alt="{!! __('messages.dashboard_workerz.icon__notification')}}">
                                <div>
                                    <h4 aria-level="4">{{$n->data['announcement']['title']}}</h4>
                                    <p>{{$n->created_at->locale('en')->isoFormat('Do MMMM YYYY, H:mm')}}</p>
                                </div>
                            </div>
                            <div>
                                <p class="title-notification">{!! __('messages.dashboard_workerz.new__ad')}}</p>
                                <p>
                                    {!! __('messages.dashboard_workerz.youre__des')}} : {{$n->data['announcement']['description']}}</p>
                                <a class="button-cta"
                                   href="{{route('dashboard.ads.show',$n->data['announcement']['slug'])}}">{!! __('messages.dashboard_workerz.more__details__btn')}}</a>
                            </div>
                        </div>
                    @endif
                    @if($n->type === 'App\Notifications\MessageReceived')
                            <div>
                                <div class="container-message container-notification">
                                    <img src="{{asset('svg/user.svg')}}" alt="{!! __('messages.dashboard_workerz.icon__notification')}}">
                                    <div>
                                        <h4 aria-level="4">{{$n->data['message']['receiver']['name']}}</h4>
                                        <a href="{{$n->data['message']['user']['email']}}">{{$n->data['message']['user']['email']}}</a>
                                        <p>{{$n->created_at->locale('en')->isoFormat('Do MMMM YYYY, H:mm')}}</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="title-notification-msg">{!! __('messages.dashboard_workerz.new__msg__receive')}}</p>
                                    <p>{{$n->data['message']['content']}}</p>
                                    <a class="button-cta"
                                       href="{{route('dashboard.messagesShow',$n->data['message']['user']['slug'])}}">{!! __('messages.dashboard_workerz.reply__to')}}</a>
                                </div>
                            </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection

