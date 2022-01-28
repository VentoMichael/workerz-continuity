@extends('layouts.appDashboard')
@section('content')
@if (Session::has('success-update-not'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/cross.svg')}}" alt="{!! __('messages.bad__answer')!!}">
            <p>{!!session('success-update-not')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('success-update'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="{!! __('messages.good__answer')!!}">
            <p>{!!session('success-update')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-ads">
            <h2 aria-level="2">
                @if(auth()->user()->announcements()->NotDraft()->count() > 1)
                    {!! __('messages.ads__nav__menu')!!}
                @else
                    {!! __('messages.ad__nav__menu')!!}
                @endif
                {!! __('messages.put__online')!!}
            </h2>
            <div class="container-form-ads">
                <livewire:ads-dashboard>
                </livewire:ads-dashboard>
                <section class="container-profil-dashboard container-ads-dashboard">
                    <div class="container-buttons-delete-back container-button-delete-ad">
                        <a class="link-back" href="{{route('dashboard.ads')}}">
                            <button class="button-back button-cta button-draft">
                                {!! __('messages.auth.register__btn__back')!!}
                            </button>
                        </a>
                        <form action="/dashboard/ads/delete/{{$announcement->slug}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="deleteButton" class="button-cta button-delete" name="delete">
                                {!! __('messages.dashboard_workerz.label__form__publish__draft')!!} <i>{{ucfirst($announcement->title)}}</i>
                            </button>
                        </form>
                    </div>
                    @include('partials.profil-ads')
                    <div class="container-buttons-delete-back container-draft-publish-dashboard">
                        <a class="button-back button-cta button-draft button-ad-publish" href="{{route('announcements.show',$announcement->slug)}}">
                                {!! __('messages.dashboard_workerz.see__ad__online')!!}
                        </a>
                        <a href="{{route('update.ads.dashboard',$announcement->slug)}}" class="button-cta">
                            {!! __('messages.dashboard_workerz.edit__ad')!!}<i>{{ucfirst($announcement->title)}}</i>
                        </a>
                    </div>

                </section>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    @if(Session::get('applocale') === 'en')
        <script src="{{asset('js/en/confirmDelete.js')}}"></script>
    @elseif(Session::get('applocale') === 'nl')
        <script src="{{asset('js/nl/confirmDelete.js')}}"></script>
    @else
        <script src="{{asset('js/confirmDelete.js')}}"></script>
    @endif
    @livewireScripts
@endsection
