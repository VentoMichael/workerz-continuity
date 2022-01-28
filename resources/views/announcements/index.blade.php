@extends('layouts.app')
@section('content')
    @if (Session::has('loveOk'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="{!! __('messages.good__answer')!!}">
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
    <section class="container-home margin hideForNewsletter">
        <div class="container-home_image container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                         {!! __('messages.ads.title__index')!!}
                    </h2>
                    <p>
                         {!! __('messages.ads.text__index')!!}
                    </p>
                    @include('partials.newAd')
                </div>
            </div>
            <div class="container-svg">
                <img width="300" height="300" src="{{asset('svg/Information carousel_Monochromatic.svg')}}"
                     alt=" {!! __('messages.ads.alt__index')!!}">
            </div>
        </div>
    </section>
    <livewire:ads>

    </livewire:ads>
@endsection
