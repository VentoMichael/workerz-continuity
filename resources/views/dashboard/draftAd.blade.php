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
    @if (Session::has('draft'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="{!! __('messages.good__answer')!!}">
            <p>{!!session('draft')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-ads">
            <h2 aria-level="2">
                @if(auth()->user()->announcements()->Draft()->count() > 1)
                    {!! __('messages.dashboard_workerz.ads__words')!!}
                @else
                    {!! __('messages.dashboard_workerz.ads__word')!!}
                @endif
                {!! __('messages.dashboard_workerz.ads__draft')!!}
            </h2>
            <div class="container-form-ads">
                <livewire:ads-draft-dashboard>
                </livewire:ads-draft-dashboard>
                <section class="container-profil-dashboard container-ads-dashboard">
                    <div class="container-buttons-delete-back container-button-delete-ad">
                        <a class="link-back" href="{{route('dashboard.ads')}}">
                            <button class="button-back button-cta button-draft button-back-ads">
                                {!! __('messages.auth.register__btn__back')!!}
                            </button>
                        </a>
                        <form action="/dashboard/ads/draft/delete/{{$announcement->slug}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="deleteButton" class="button-cta button-delete" name="delete">
                                {!! __('messages.dashboard_workerz.delete__btn')!!}<i>{{ucfirst($announcement->title)}}</i>
                            </button>
                        </form>
                    </div>
                    @include('partials.profil-ads')
                    <div class="container-draft-publish-dashboard container-btn-draft">
                        <form class="form-login form-register" enctype="multipart/form-data"
                              aria-label="{!! __('messages.dashboard_workerz.label__form__publish__draft')!!}" role="form" method="POST"
                              action="/dashboard/ads/draft/{{$announcement->slug}}">
                            @csrf
                            @method("PUT")
                            <div class="link-back">
                                <button class="button-back button-cta button-draft" name="publish">
                                    {!! __('messages.dashboard_workerz.publish__btn')!!}<i>{{ucfirst($announcement->title)}}</i>
                                </button>
                            </div>
                        </form>
                        <a href="{{route('dashboard.ads.showDraftEdit',$announcement->slug)}}" class="button-cta">
                            {!! __('messages.dashboard_workerz.edit__btn')!!}<i>{{ucfirst($announcement->title)}}</i>
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
