@extends('layouts.app')
@section('content')
    @if (Session::has('errors'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/cross.svg')}}" alt="{!! __('messages.bad__answer')}}">
            <p>{!!session('errors')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('success-inscription'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/cross.svg')}}" alt="{!! __('messages.bad__answer')}}">
            <p>{!!session('success-inscription')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <section class="container-home margin">
        <div class="container-home_image container-home-create container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        {!! __('messages.ads.plans__title')}}
                    </h2>
                    <p>
                        {!! __('messages.ads.plans__text')}}
                    </p>
                </div>
            </div>
            <div class="container-svg">
                <img width="300" height="300" src="{{asset('svg/Success_Monochromatic.svg')}}"
                     alt="{!! __('messages.ads.plans__alt__img')}}">
            </div>
        </div>
    </section>
    <section class="container-home container-announcements container-create-ads">
        <div class="title-first-step-register">
            <h2 aria-level="2">{!! __('messages.ads.plans__title__ads')}}</h2>
        </div>
        <div class="container-all-announcement show-content container-create-ads-infos container-plans">
            @foreach($plans as $plan)
                <section class="container-plan">
                    <div class="container-plan-price">
                        <h3 aria-level="3">
                            {{ucfirst($plan->name)}}
                        </h3>
                        <span class="planPrice">
                             {{number_format((float)$plan->price, 2, ',', '')}} €
                        </span>
                        @if($plan->price != 0)
                        <span class="planPrice monthCost">
                             ({{ 1 * ($plan->price/$plan->duration) * 30 }} € / {!! __('messages.ads.plans__month__text')}})
                        </span>
                        @endif
                        @if($plan->oldprice)
                            <p class="reductionPrice">
                                {{$plan->oldprice}} €
                            </p>
                        @endif
                    </div>
                    <ul>
                        <li>
                            <img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="{!! __('messages.good__answer')}}">{!! __('messages.ads.duration__word')}}{{$plan->duration}} {!! __('messages.ads.days__word')}}
                        </li>
                        <li>
                            <img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="{!! __('messages.good__answer')}}">
                            @if($plan->id == 1) {!! __('messages.ads.basic__support')}}@elseif($plan->id == 2) {!! __('messages.ads.intermediaire__support')}} @elseif($plan->id == 3) {!! __('messages.ads.priority__support')}} @endif
                        </li>
                        <li>
                            <img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="{!! __('messages.good__answer')}}">
                            @if($plan->id == 1)
                                {!! __('messages.ads.little__visibility')}}
                            @endif
                            @if($plan->id == 2)
                                {!! __('messages.ads.mid__visibility')}}
                            @endif
                            @if($plan->id == 3)
                                {!! __('messages.ads.hight__visibility')}}
                            @endif
                        </li>
                        <li>
                            <img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="{!! __('messages.good__answer')}}">@if($plan->id == 1)  {!! __('messages.ads.visibility__top__hundred')}} @elseif($plan->id == 2)  {!! __('messages.ads.visibility__top__fiveteen')}} @elseif($plan->id == 3)  {!! __('messages.ads.visibility__top__four')}} @endif
                        </li>
                    </ul>
                    <form aria-label="{!! __('messages.ads.label__form__create_ad')}}" action="{{route('announcements.create')}}" method="post">
                        @method('get')
                        @csrf
                        <input id="plan{{$plan->id}}" name="plan" type="hidden" value="{{$plan->id}}">
                        <button>
                            {!! __('messages.ads.btn__create__ad')}}{{ucfirst($plan->name)}}
                        </button>
                    </form>
                </section>
            @endforeach
        </div>
    </section>
@endsection
