@extends('layouts.app')
@section('content')
    <section class="container-home margin">
        <div class="container-home_image container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        {!! __('messages.home.home__title')!!}
                    </h2>
                    <p>
                        {!! __('messages.home.text__title')!!}
                    </p>
                </div>
                <livewire:search-users>
                </livewire:search-users>
            </div>
            <div class="container-svg">
                <img width="300" height="300" src="{{asset('svg/Profiling_Monochromatic.svg')}}"
                     alt="{!! __('messages.home.text__img__title')!!}">
            </div>
        </div>
    </section>
    <section class="container-categories-home margin">
        <div class="container-categories-text-home">
            <h2 aria-level="2">
                {!! __('messages.home.title__categories')!!}
            </h2>
            <p class="text-categories-home">
                {!! __('messages.home.text__categories')!!}
            </p>
        </div>
        <div class="container-six-category-home show-content">
            @foreach($categories as $categorie)
                <section>
                    <a class="box-category"
                       href="{{route('workers').'?categoryUser%5B%5D='.$categorie->id.'#workerzLink'}}">
                        <img width="300" height="300" src="{{asset('svg/'.$categorie->profil)}}"
                             alt="@if(Session::get('applocale') === 'en') {{$categorie->alt_en}} @elseif(Session::get('applocale') === 'nl') {{$categorie->alt_nl}} @else {{$categorie->alt}} @endif">
                        <div itemscope itemtype="https://schema.org/Person">
                            <h3 itemprop="jobTitle" aria-level="3">@if(Session::get('applocale') === 'en') {{ucfirst($categorie->name_en)}} @elseif(Session::get('applocale') === 'nl') {{ucfirst($categorie->name_nl)}} @else {{ucfirst($categorie->name)}} @endif</h3>
                            <p>{{$categorie->users->count()}} @if($categorie->users->count() <= 1) {!! __('messages.home.word_professional')!!} @else {!! __('messages.home.word_professionals')!!} @endif</p>
                        </div>
                    </a>
                </section>
            @endforeach
            <section>
                <a class="last-box-category box-category" href="{{route('workers')}}">
                    <h3 aria-level="3">
                        {!! __('messages.home.all__categories')!!}
                    </h3>
                </a>
            </section>
        </div>
    </section>
    <section class="container-home-why show-content">
        <div class="container-title-why">
            <h2 aria-level="2">
                {!! __('messages.home.presentation')!!}
            </h2>
            <p>
                {!! __('messages.home.presentation__text')!!}
            </p>
        </div>
        <section class="container-why">
            <div>
                <img width="400" height="350" src="{{asset('svg/Thinking_Monochromatic.svg')}}"
                     alt="{!! __('messages.home.img__alt__text__why')!!}">
            </div>
            <div class="container-why-text-first">
                <h3 aria-level="3">
                    {!! __('messages.home.presentation__why__title')!!}
                </h3>
                <p class="text-why">
                    {!! __('messages.home.presentation__why__text')!!}
                </p>
                <p>
                    {!! __('messages.home.presentation__why__text__second')!!}
                </p>
                @guest
                    @include('partials.btnInscription')
                @endguest
            </div>
        </section>
        <section class="container-why">
            <div class="container-why-text-second">
                <h3 aria-level="3">
                    {!! __('messages.home.presentation__choice__title')!!}
                </h3>
                <p class="text-why">
                    {!! __('messages.home.presentation__choice__text')!!}
                </p>
                <a href="{{route('workers')}}" class="button-cta">
                    {!! __('messages.home.presentation__choice__text__second')!!}
                </a>
            </div>
            <div>
                <img width="400" height="350" src="{{asset('svg/Information carousel_Monochromatic.svg')}}"
                     alt="{!! __('messages.home.presentation__img__carousel')!!}">
            </div>
        </section>
        <section class="container-why">
            <div>
                <img width="400" height="350" src="{{asset('svg/Marketing_Monochromaticc.svg')}}"
                     alt="{!! __('messages.home.presentation__sell__img__alt')!!}">
            </div>
            <div class="container-why-text-first">
                <h3 aria-level="3">
                    {!! __('messages.home.presentation__sell__title')!!}
                </h3>
                <p class="text-why">
                    {!! __('messages.home.presentation__sell__text')!!}
                </p>
                <a href="{{route('announcements.create')}}" class="button-cta">
                    {!! __('messages.home.presentation__sell__text__second')!!}
                </a>
            </div>
        </section>
    </section>
@endsection
@section('scripts')
    @livewireScripts
@endsection
