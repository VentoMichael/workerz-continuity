@extends('layouts.appDashboard')
@section('content')
    @if (Session::has('expire'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/caution.svg')}}" alt="{!! __('messages.good__answer')!!}">
            <p>{!!session('expire')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('success-inscription'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/good.svg')}}" alt="{!! __('messages.good__answer')!!}">
            <p>{!!session('success-inscription')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('errors'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/cross.svg')}}" alt="{!! __('messages.bad__answer')!!}">
            <p>{!!session('errors')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard">
            <h2 aria-level="2">
                 {!! __('messages.dashboard_workerz.title__index')!!}
            </h2>
            <div class="container-sections-dashboard container-dashboards">
                <section class="container-dashboard-notif">
                    <h3 aria-level="3">
                         {!! __('messages.dashboard_workerz.title__index__last__notifications')!!}
                    </h3>
                    <div class="container-picto-dashboard">
                        <div class="container-messages">
                            @forelse($notifications->sortByDesc('created_at') as $notification)
                                <div class="messages-container">
                                    <div class="container-horary-notification-dashboard">
                                        @if($notification->created_at->isToday())
                                            <p>
                                                 {!! __('messages.dashboard_workerz.today__word')!!} {{$notification->created_at->locale('en')->isoFormat('Do MMMM, HH:ss')}}
                                            </p>
                                        @else
                                            <p>
                                                {{$notification->created_at->locale('en')->isoFormat('Do MMMM YYYY, H:mm')}}
                                            </p>
                                        @endif
                                    </div>
                                    @if($notification->type === 'App\Notifications\AdCreated')
                                        <div class="container-notifications-dashboard">
                                            <img itemprop="image" src="{{asset('svg/ad.svg')}}"
                                                 alt="{!! __('messages.ads.icone__ads__alt')!!}">
                                            <h4 aria-level="4">
                                                 {!! __('messages.dashboard_workerz.you__re__ad')!!}<i>{{$notification->data['announcement']['title'] }}</i>  {!! __('messages.dashboard_workerz.id__online__tet')!!}
                                            </h4>
                                        </div>
                                    @endif
                                    @if($notification->type === 'App\Notifications\MessageReceived')
                                        <div class="container-notifications-dashboard">
                                            <img itemprop="image" src="{{asset('svg/messenger.svg')}}"
                                                 alt="{!! __('messages.dashboard_workerz.icone__msg')!!}">
                                            <h4 aria-level="4">
                                                 {!! __('messages.dashboard_workerz.notif__reeived__msg')!!}<i>{{$notification->data['message']['user']['name'] }}</i>
                                            </h4>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="messages-container">
                                    <h4 aria-level="4">
                                         {!! __('messages.dashboard_workerz.no__notifications')!!}
                                    </h4>
                                </div>
                            @endforelse
                        </div>
@if($notifications->count() >0)
                        <div class="button-dashboard-notifications">
                            <a class="button-cta button-edition" href="{{route('dashboard.notifications')}}">
                                 {!! __('messages.dashboard_workerz.all__notifications')!!}
                            </a>
                        </div>
    @endif
                    </div>
                </section>
                <section class="container-dashboard-notif container-dashboard-messenger">
                    <h3>
                         {!! __('messages.dashboard_workerz.last__three__msg')!!}
                    </h3>
                    <div class="container-picto-dashboard">
                        @forelse($messages as $message)
                            <section class="messages-container">
                                <div class="container-horary-notification-dashboard container-index-dashboard">
                                    <div class="container-horary-notification-dashboard">
                                        <p>
                                             {!! __('messages.dashboard_workerz.msg__received')!!}{{$message->created_at->locale('en')->isoFormat('Do MMMM, HH:ss')}}
                                        </p>
                                    </div>
                                    <div>
                                        <h4 aria-level="4">
                                             {!! __('messages.dashboard_workerz.new__msg__of')!!}<i>
                                            {{ucfirst($message->user->name)}} {{ucfirst($message->user->surname)}}</i>
                                        </h4>
                                    </div>
                                </div>
                            </section>
                        @empty
                            <section class="messages-container">
                                <h4 aria-level="4">
                                     {!! __('messages.dashboard_workerz.no__msg__found')!!}
                                </h4>
                                <div class="button-dashboard-notifications">
                                    <a class="button-cta button-edition button-personnal-dashboard"
                                       href="{{route('announcements')}}">
                                         {!! __('messages.dashboard_workerz.see__all__ads')!!}
                                    </a>
                                </div>
                            </section>
                        @endforelse
                        @if($messages->count() >0)
                        <div class="button-dashboard-notifications">
                            <a class="button-cta button-edition button-msg-dash button-msg-dashboard" href="{{route('dashboard.messages')}}">
                                 {!! __('messages.dashboard_workerz.all__msg')!!}
                            </a>
                        </div>
                            @endif
                    </div>
                </section>
                <section class="container-dashboard-notif container-dashboard-ads">
                    <h3 aria-level="3">
                         {!! __('messages.dashboard_workerz.last__ads__success')!!}
                    </h3>
                    <div class="container-picto-dashboard">
                        <div class="container-messages container-ads-index">
                            @forelse($lastAnnouncements as $ad)
                                <section class="messages-container">
                                    <div class="container-horary-notification-dashboard container-index-dashboard">
                                        <div style="align-self: center;">
                                            @if($ad->picture)
                                                <img itemprop="image" src="{{ asset($ad->picture) }}"
                                                     alt=" {!! __('messages.ads.label__picture')!!} {{ucfirst($ad->title)}}"/>
                                            @else
                                                <img itemprop="image" src="{{asset('svg/ad.svg')}}"
                                                     alt=" {!! __('messages.ads.icone__ads__alt')!!}">
                                            @endif
                                        </div>

                                        <h4 aria-level="4">
                                            <i>{{ucfirst($ad->title)}}</i>
                                        </h4>
                                    </div>
                                    <div>
                                        <p class="dateAds">
                                             {!! __('messages.dashboard_workerz.actif__on')!!}{{$ad->created_at->locale('en')->isoFormat('Do MMMM, YYYY')}}
                                        </p>
                                    </div>
                                    <div class="container-counter-view">
                                        <p class="view-counter view-counter-dashboard" @if($ad->view_count) title="{{ $ad->view_count }}" @endif>@if($ad->view_count > 999) +1K @else {{ $ad->view_count }} @endif @if($ad->view_count >1 )
                                                 {!! __('messages.dashboard_workerz.vues__word')!!} @else  {!! __('messages.dashboard_workerz.vue__word')!!} @endif</p>
                                        <p class="view-like view-counter-dashboard" @if($ad->likes) title="{{$ad->likes}}" @endif>@if($ad->likes > 999) +1K @else{{$ad->likes ? : 0}} @endif @if($ad->likes == null || $ad->likes <= 1)
                                                 {!! __('messages.dashboard_workerz.love__word')!!} @else  {!! __('messages.dashboard_workerz.loves__word')!!} @endif</p>
                                    </div>
                                    <div class="button-dashboard-notifications">
                                        <a class="button-cta button-edition button-personnal-dashboard"
                                           href="dashboard/ads/{{$ad->slug}}">
                                             {!! __('messages.dashboard_workerz.see__word')!!} <i>{{ucfirst($ad->title)}}</i>
                                        </a>
                                    </div>
                                </section>
                            @empty
                                <section class="messages-container">
                                    <h4 aria-level="4">
                                         {!! __('messages.dashboard_workerz.no__ads__found')!!}
                                    </h4>
                                    <div class="button-dashboard-notifications">
                                        @if(auth()->user()->plan_user_id === 1 && auth()->user()->announcements->count() >= 2 || auth()->user()->plan_user_id === 2 && auth()->user()->announcements->count() >= 5)
                                            <p>
                                                 {!! __('messages.dashboard_workerz.quota__expired__title')!!}
                                            </p>
                                            <p> {!! __('messages.dashboard_workerz.think__word')!!}</p>
                                            <a class="button-cta button-edition button-personnal-dashboard" href="{{route('users.plans')}}">
                                                 {!! __('messages.dashboard_workerz.pass__sup__plan')!!}
                                            </a>
                                        @elseif(auth()->user()->plan_user_id === 3 && auth()->user()->announcements->count() > 16)
                                            <p>
                                                 {!! __('messages.dashboard_workerz.quota__expired__text')!!}
                                            </p>
                                        @else
                                            <a class="button-cta button-edition button-personnal-dashboard" href="{{route('announcements.create')}}">
                                                 {!! __('messages.dashboard_workerz.ads__words')!!}
                                            </a>
                                        @endif
                                    </div>
                                </section>
                            @endforelse
                            @if($lastAnnouncements->count() >0)
                            <div class="button-dashboard-notifications">
                                <a class="button-cta button-edition" href="{{route('dashboard.ads')}}">
                                     {!! __('messages.dashboard_workerz.all__my__ads')!!}
                                </a>
                            </div>
                                @endif
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
@endsection
