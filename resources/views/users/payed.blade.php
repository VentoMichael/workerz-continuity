@extends('layouts.app')
@section('content')
    @if (Session::has('success-users'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}"
                                                                  alt="{!! __('messages.good__answer')}}">
            <p>{!!session('success-users')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <section class="container-home margin">
        <div class="container-home_image container-home-create container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        {!! __('messages.payed.title')!!}
                    </h2>
                    <p>
                        {!! __('messages.payed.text')!!}
                    </p>
                </div>
            </div>
            <div class="container-svg">
                <img width="300" height="300" src="{{asset('svg/Card_Payment_Monochromatic.svg')}}"
                     alt="{!! __('messages.payed.alt__text__img')!!}">
            </div>
        </div>
    </section>
    <section class="container-home container-announcements container-create-ads">
        <div class="title-first-step-register">
            <h2 aria-level="2" class="hidden">{!! __('messages.payed.plan__selected__inscription')!!}</h2>
        </div>
        <div class="container-home container-home_image container-paied">
            <section>
                <div class="container-connexion container-plan-paied">
                    <h3 aria-level="3">{!! __('messages.payed.plan__selected')!!}</h3>
                    <form action="{{route('users.plans')}}" method="get">
                        @csrf
                        <input type="hidden" name="changePlan">
                        <button class="help changedplan">
                            {!! __('messages.payed.plan__changed')!!}
                        </button>
                    </form>
                    <div class="container-all-announcement show-content container-create-ads-infos container-plans">
                        <section
                            class="container-plan container-payed-plan @if($plan->id === 2) container-hot-plan @endif">
                            <div class="container-plan-price">
                                <h4 aria-level="4">
                                    {{ucfirst($plan->name)}}
                                </h4>
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
                                         alt="{!! __('messages.good__answer')!!}"> <span
                                        class="container-visibility-plans">
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
                        </section>
                    </div>
                </div>
            </section>
            <section class="container-price-paied">
                <div>
                    <h3 aria-level="3">{!! __('messages.payed.amount__title')!!}
                        {{number_format((float)$plan->price, 2, ',', '')}} € </h3>
                    <p>{!! __('messages.payed.credit_card_details')!!}</p>
                    <form class="form-login form-register show-content" enctype="multipart/form-data"
                          aria-label="{!! __('messages.payed.amount__register__acount')!!}" role="form" method="post"
                          id="payment-form"
                          action="{{ route('users.paied') }}">
                        @csrf
                        <div class="container-form-email">
                            <label class="hidden" for="payed-info"
                            >{!! __('messages.payed.info__payment')!!}</label>
                            <div id="card-element" class=" email-label">
                            </div>
                            <div id="card-errors" role="alert"></div>

                            @error('payed-info')
                            <div class="container-error">
                                    <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                        </div>
                        <div>
                            <input type="hidden" name="plan"
                                   @if(auth()->user()->sending_time_expire = 1 && auth()->user()) value="{{$plan->id}}"
                                   @else value="{{old('plan', $plan)}}" @endif>
                            <button
                                id="card-button"
                                class="button-cta"
                                type="submit" role="button" name="is_payed">
                                {!! __('messages.payed.btn__payed')!!}
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            let searchParams = new URLSearchParams(window.location.search);
            if (searchParams.has('session_id')) {
                const session_id = searchParams.get('session_id');
                document.getElementById('session-id').setAttribute('value', session_id);
            }
        });
    </script>
@endsection
