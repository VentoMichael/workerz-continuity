@extends('layouts.app')
@section('content')
    <section class="container-home margin" itemtype="https://schema.org/Organization" itemscope>
        <div class="container-home_image container-home-page">
            <div class="container-about-text">
                <div class="container-home-text">
                    <h2 aria-level="2">
                        {!! __('messages.about.title')!!}
                    </h2>
                    <p>
                        <span itemprop="legalName">{{env('APP_NAME')}}</span>
                        {!! __('messages.about.founder__create')!!}
                        <a itemprop="founder" href="https://ventomichael.com/">Vento Michael </a>{!! __('messages.about.founder__text') !!}
                    </p>
                </div>
                @guest
                    @include('partials.btnInscription')
                @endguest
                @auth
                    @include('partials.newAd')
                @endauth
            </div>
            <div class="container-svg">
                <img width="300" height="300" src="{{asset('svg/us.svg')}}"
                     alt="{!! __('messages.about.img__alt__us')!!}">
            </div>
        </div>
    </section>
    <section class="container-categories-home margin">
        <div class="container-categories-text-home">
            <h2 aria-level="2">
                {!! __('messages.about.title__us')!!}
            </h2>
        </div>
        <div class="container-six-category-home show-content container-about-sections">
            <section class="box-category box-about">
                <img width="300" height="300" src="{{asset('svg/Video_tutorial_Monochromatic.svg')}}"
                     alt="{!! __('messages.about.img__alt__about')!!}">
                <div>
                    <h3 aria-level="3" itemprop="makesOffer">{!! __('messages.about.dev__about__title')!!}</h3>
                    <p>{!! __('messages.about.dev__about__text')!!}</p>
                </div>
            </section>
            <section class="box-category box-about">
                <img width="300" height="300" src="{{asset('svg/Data_analytics_Monochromatic.svg')}}" alt="{!! __('messages.about.dev__about__data__img__alt')!!}">
                <div>
                    <h3 aria-level="3" itemprop="makesOffer">{!! __('messages.about.deploy__about__title')!!}</h3>
                    <p>{!! __('messages.about.deploy__about__text')!!}</p>
                </div>
            </section>
            <section class="box-category box-about">
                <img width="300" height="300" src="{{asset('svg/payment.svg')}}" alt="{!! __('messages.about.bank__about__img__alt')!!}">
                <div>
                    <h3 aria-level="3">{!! __('messages.about.bank__about__title')!!}</h3>
                    <p>{!! __('messages.about.bank__about__text')!!}
                    </p>
                    <p>{!! __('messages.about.bank__about__text__second')!!}</p>
                </div>
            </section>
        </div>
    </section>
    <section class="container-home margin container-about-why show-content">
        <div class="container-home_image container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        {!! __('messages.about.title__aim')!!}
                    </h2>
                    <p itemprop="knowsAbout">
                        {!! __('messages.about.text__aim')!!}
                    </p>
                </div>
                @guest
                    @include('partials.btnInscription')
                @endguest
                @auth
                    @include('partials.newAd')
                @endauth
            </div>
        </div>
    </section>
@endsection
