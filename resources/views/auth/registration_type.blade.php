@extends('layouts.app')
@section('content')
    <div class="container-home">
        <section class="container-home_image">
            <div class="container-connexion">

                <h2 aria-level="2">{!! __('messages.auth.registration__title')!!}</h2>
                <p>{!! __('messages.auth.registration__text')!!}</p>
                <div>
                    <a href="{{ route('login') }}">
                        <button role="button" class="button-cta" type="submit">
                            {!! __('messages.auth.register__already__account')!!}
                        </button>
                    </a>
                </div>
            </div>
            <div class="container-svg">
                <img width="300" height="300" class="svg-icon" src="{{asset('svg/Information_carousel_Isometric.svg')}}"
                     alt="{!! __('messages.auth.alt__registration_img')!!}">
            </div>
        </section>
    </div>
    <section class="container-form-register container-home form-choice show-content">
        <section class="container-role">
            <div class="container-img-register container-picto-register">
                <img width="150" height="150" src="{{asset('svg/user.svg')}}" alt="{!! __('messages.alt__profil__img__default')!!}"></div>
            <h3 aria-level="3">
                {!! __('messages.auth.registration__profession__title')!!}
            </h3>
            <section class="container-advantages">
                <h4 aria-level="4">
                    {!! __('messages.auth.registration__profession__advantages')!!}
                </h4>
                <ul class="list-advantages">
                    <li><span>&bull;</span> {!! __('messages.auth.registration__profession__advantage__one')!!}</li>
                    <li><span>&bull;</span> {!! __('messages.auth.registration__profession__advantage__two')!!}</li>
                    <li><span>&bull;</span> {!! __('messages.auth.registration__profession__advantage__three')!!}</li>
                    <li><span>&bull;</span> {!! __('messages.auth.registration__profession__advantage__four')!!}</li>
                </ul>
            </section>
            <div class="container-button-register">
                <form aria-label="{!! __('messages.auth.registration__label__user__form')!!}" method="post"
                      action="{{ route('register') }}">
                    @method('get')
                    @csrf
                    <input type="hidden" name="type" value="user">
                    <input id="plan{{$plan}}" name="plan" type="hidden" value="{{$plan}}">
                    <button class="button-cta" title="{!! __('messages.registration__btn__user__title')!!}"
                            name="user">
                        {!! __('messages.auth.registration__btn__user')!!}
                    </button>
                </form>
            </div>
        </section>
        <section class="container-role">
            <div class="container-img-register">
                <img width="150" height="150" src="{{asset('svg/suitcase.svg')}}" alt="{!! __('messages.auth.registration__img__alt__prof')!!}">
            </div>
            <h3 aria-level="3">
                {!! __('messages.auth.registration__title__prof')!!}
            </h3>
            <section class="container-advantages">
                <h4 aria-level="4">
                    {!! __('messages.auth.registration__advantages__prof')!!}
                </h4>
                <ul class="list-advantages">
                    <li><span>&bull;</span> {!! __('messages.auth.registration__advantage__prof__one')!!}</li>
                    <li><span>&bull;</span> {!! __('messages.auth.registration__advantage__prof__two')!!}</li>
                    <li><span>&bull;</span> {!! __('messages.auth.registration__advantage__prof__three')!!}</li>
                    <li><span>&bull;</span> {!! __('messages.auth.registration__advantage__prof__four')!!}</li>
                </ul>
            </section>
            <div class="container-button-register">
                <form aria-label="{!! __('messages.auth.registration__label__form__prof')!!}" method="post"
                      action="{{ route('register') }}">
                    @csrf
                    <input id="companyplan{{$plan}}" name="plan" type="hidden" value="{{request('plan')}}">
                    <input type="hidden" name="type" value="company">
                    <button class="button-cta" title="{!! __('messages.auth.registration__btn__title__prof')!!}"
                            name="company">
                        {!! __('messages.auth.registration__btn__text')!!}
                    </button>
                </form>
            </div>
        </section>
    </section>
@endsection
