@extends('layouts.app')
@section('content')
    @if (Session::has('loveOk'))
        <div id="successMsg" role="alert" class="successMsg"><img width="50" height="50" src="{{asset('svg/good.svg')}}" alt="{!! __('messages.good__answer')!!}">
            <p>{!!session('loveOk')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('loveNotOk'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="{!! __('messages.good__answer')!!}">
            <p>{!!session('loveNotOk')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('not-permitted'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/cross.svg')}}" alt="{!! __('messages.bad__answer')!!}">
            <p>{!!session('not-permitted')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <section class="container-home margin hideForNewsletter" id="sectionWorkerz">
        <div class="container-home_image container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        {!! __('messages.workers__title')!!}
                    </h2>
                    <p>
                        {!! __('messages.workers__text')!!}
                    </p>
                    @guest
                        <div>
                            <a href="{{route('users.plans')}}" role="button" class="button-cta" type="submit">
                                    {!! __('messages.btn__add_company')!!}
                            </a>
                        </div>
                    @endguest
                </div>
            </div>
            <div class="container-svg">
                <img width="300" height="300" src="{{asset('svg/Online_research.svg')}}"
                     alt="{!! __('messages.home.text__img__title')!!}">
            </div>
        </div>
    </section>
    <livewire:users>

    </livewire:users>
@endsection
@section('scripts')
    @livewireScripts
    <script src="{{asset('js/newsletter.js')}}"></script>
@endsection
