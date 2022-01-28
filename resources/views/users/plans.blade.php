@extends('layouts.app')
@section('content')
    @if (Session::has('errors'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60"
                                                                  src="{{asset('svg/cross.svg')}}"
                                                                  alt="{!! __('messages.bad__answer')!!}}">
            <p>{!!session('errors')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <section class="container-home margin">
        <div class="container-home_image container-home-create container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        {!! __('messages.payed.intro__title')!!}
                    </h2>
                    <p>
                        {!! __('messages.payed.intro__text')!!}
                    </p>
                </div>
            </div>
            <div class="container-svg">
                <img width="300" height="300" src="{{asset('svg/Success_Monochromatic.svg')}}"
                     alt="{!! __('messages.payed.alt__text__img__success')!!}">
            </div>
        </div>
    </section>
    <section class="container-home container-announcements container-create-ads" id="plans">
        @if(auth()->user())
            <div class="container-link-to-back container-change-plan">
                <a class="link-back button-back button-cta button-draft" href="{{url()->previous()}}">
                    {!! __('messages.auth.register__btn__back')!!}
                </a>
            </div>
        @endif
        <div class="title-first-step-register">
            <h2 aria-level="2">{!! __('messages.payed.plan__sub__title')!!}</h2>
        </div>
        <div class="container-all-announcement show-content container-create-ads-infos container-plans">
            @foreach($plans as $plan)
                @if($plan->id !== 1 && auth()->user() || !auth()->user())
                    <section class="container-plan">
                        <div class="container-plan-price">
                            <h3 aria-level="3">
                                {{ucfirst($plan->name)}}
                            </h3>
                            <span class="planPrice">
                             {{number_format((float)$plan->price, 2, ',', '')}} €
                        </span>
                            @if($plan->id !== 1)
                                <span style="margin-top: -20px;margin-bottom:10px;">
                                    / {!! __('messages.ads.plans__month__text')!!}
                                </span>
                            @endif
                            @if($plan->oldprice)
                                <p class="reductionPrice">
                                    {{$plan->oldprice}} €
                                </p>
                            @endif
                        </div>
                        <ul>
                            @if($plan->id === 1)
                                <li>
                                    <img width="40" height="60" src="{{asset('svg/good.svg')}}"
                                         alt="{!! __('messages.good__answer')!!}">
                                    {!! __('messages.home.duration__word')!!} {{$plan->duration}} {!! __('messages.home.days__word')!!}
                                </li>
                            @endif
                                <li>
                                    <img width="40" height="60" src="{{asset('svg/good.svg')}}"
                                         alt="{!! __('messages.good__answer')!!}">
                                    @if($plan->id == 1) {!! __('messages.home.basic__support')!!} @elseif($plan->id == 2) {!! __('messages.home.intermediaire__support')!!} @elseif($plan->id == 3) {!! __('messages.home.priority__support')!!} @endif
                                </li>
                            <li class="container-visibility">
                                <img width="40" height="60" src="{{asset('svg/good.svg')}}"
                                     alt="{!! __('messages.good__answer')!!}">
                                <span class="container-visibility-plans">
                                <span>{!! __('messages.payed.integration__word')!!}
                                    @if($plan->id == 1)
                                        {!! __('messages.of__word')!!} {{$plan->possibilityAdCreated}} {!! __('messages.announcements__title__h1')!!}
                                    @elseif($plan->id == 2)
                                        {!! __('messages.of__word')!!} {{$plan->possibilityAdCreated}} {!! __('messages.announcements__title__h1')!!}
                                    @elseif($plan->id == 3)
                                        {!! __('messages.of__word')!!} {{$plan->possibilityAdCreated}} {!! __('messages.announcements__title__h1')!!}
                                    @endif
                                </span>
                            </span>
                            </li>
                            <li class="container-visibility">
                                <img width="40" height="60" src="{{asset('svg/good.svg')}}"
                                     alt="{!! __('messages.good__answer')!!}"> <span class="container-visibility-plans">
                                <span>
                             @if($plan->id == 1)
                                        {!! __('messages.home.little__visibility')!!}
                                    @endif
                                    @if($plan->id == 2)
                                        {!! __('messages.home.mid__visibility')!!}
                                    @endif
                                    @if($plan->id == 3)
                                        {!! __('messages.home.hight__visibility')!!}
                                    @endif *
                                </span>
                                <span class="helpPlans">{!! __('messages.payed.only__company')!!}</span>
                            </span>
                            </li>
                            <li class="container-visibility">
                                <img width="40" height="60" src="{{asset('svg/good.svg')}}"
                                     alt="{!! __('messages.good__answer')!!}">
                                <span class="container-visibility-plans">
                                <span>
                                @if($plan->id == 1)
                                        {!! __('messages.home.visibility__top__hundred')!!}
                                    @elseif($plan->id == 2)
                                        {!! __('messages.home.visibility__top__fiveteen')!!}
                                    @elseif($plan->id == 3)
                                        {!! __('messages.home.visibility__top__four')!!}
                                    @endif *
                                </span>
                                <span class="helpPlans">{!! __('messages.payed.only__company')!!}</span>
                            </span>
                            </li>
                        </ul>
                        @if(auth()->user() && auth()->user()->plan_user_id === $plan->id)
                            <div style="
                            text-align: center;
                            ">
                                <p>
                                    {!! __('messages.payed.already__have__plan')!!}
                                </p>
                            </div>
                        @else
                            <form aria-label="{!! __('messages.payed__choice__label')!!}"
                                  @auth action="{{route('users.payed')}}"
                                  @else action="{{route('users.type')}}" @endauth method="POST">
                                @method('get')
                                @csrf

                                <input id="priceId" name="priceId" type="hidden" value="{{$plan->id}}">
                                <input id="plan{{$plan->id}}" name="plan" type="hidden" value="{{$plan->id}}">
                                <button id="checkout-and-portal-button" class="buttonChanged"
                                    @if(auth()->user() && auth()->user()->plan_user_id !== null) name="changePlanCurrent" @endif>
                                    {!! __('messages.home.btn__create__ad')!!} {{ucfirst($plan->name)}}
                                </button>
                            </form>
                        @endif
                    </section>
                @endif
            @endforeach
        </div>
    </section>
@endsection
@if(auth()->user())
@section('scripts')
    @if(Session::get('applocale') === 'en')
        let btns=document.querySelectorAll(".buttonChanged");function confirmDelete(e){return!0===confirm("After this step, the new plan will be active and the remaining time will be lost.")||(e.preventDefault(),!1)}btns.forEach(function(e){e.addEventListener("click",confirmDelete)});
    @elseif(Session::get('applocale') === 'nl')
        let btns=document.querySelectorAll(".buttonChanged");function confirmDelete(e){return!0===confirm("Na deze stap zal het nieuwe plan actief zijn en zal de resterende tijd verloren gaan.")||(e.preventDefault(),!1)}btns.forEach(function(e){e.addEventListener("click",confirmDelete)});
    @else
        let btns=document.querySelectorAll(".buttonChanged");function confirmDelete(e){return!0===confirm("Après cette étape, le nouveau plan sera actif et le temps restant sera perdu.")||(e.preventDefault(),!1)}btns.forEach(function(e){e.addEventListener("click",confirmDelete)});
    @endif
@endsection
@endif
