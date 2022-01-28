@extends('layouts.app')
@section('content')
    @if(Session::has('loveOk'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/good.svg')}}"
                                                                  alt="{!! __('messages.good__answer')!!}">
            <p>{!! session('loveOk') !!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if(Session::has('loveNotOk'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/good.svg')}}"
                                                                  alt="{!! __('messages.good__answer')!!}">
            <p>{!!session('loveNotOk')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <section class="container-home margin">
        <div class="container-home_image container-home-create container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        {!! __('messages.good__choice__word')!!}
                    </h2>
                    <p>{!! __('messages.ads.take__contact')!!} {{ucfirst($worker->name)}}, {!! __('messages.ads.choice__contact')!!} <a
                            href="mailto:{{$worker->email}}">{{strtolower(__('messages.auth.email__word'))}}</a> {!! __('messages.ads.choice__contact')!!}
                        <a
                            href="tel:{{$worker->phones()->first()->number}}">{!! __('messages.dashboard_workerz.phone__word')!!}</a>. {!! __('messages.take__contact')!!}
                    </p>
                </div>
            </div>
            <div class="container-svg">
                <img src="{{asset('svg/Great_idea_Monochromatic.svg')}}"
                     alt="{!! __('messages.about.img__alt__us')!!}">
            </div>
        </div>
    </section>
    <section class="container-categories-home margin" @if($randomUsers->count() < 1) style="margin-bottom:50px;" @endif>
        <div class="container-categories-text-home">
            @if($worker->catchPhrase)
                <h2 aria-level="2">
                    {{ $worker->catchPhrase }}
                </h2>
            @else
                <h2 aria-level="2">
                    {!! __('messages.company__word')!!}
                    @if(Session::get('applocale') === 'en')
                        {{$randomPhrasing->name_en}}
                    @elseif(Session::get('applocale') === 'nl')
                        {{$randomPhrasing->name_nl}}
                    @else
                        {{$randomPhrasing->name}}
                    @endif
                </h2>
            @endif
        </div>
        <section
            class="container-personnal-ads show-content container-worker @if(!$worker->website) container-adv @endif">
            <div class="container-love-show">
                @auth
                    <div
                        class="containerPrice container-show-love containerLove help-show like-workerz @guest notHoverHeart @endguest">
                        @if(!$worker->isLikedUBy($worker))
                            <form method="POST"
                                  title="{!! __('messages.ads.label__put__like__livewire')!!} {{$worker->name}}"
                                  aria-label="{!! __('messages.ads.label__put__like__livewire')!!} {{$worker->name}}"
                                  action="/workers/{{$worker->slug}}/like">
                                @csrf

                                <button type="submit" class="button-loves">
                                    <img class="heart" src="{{asset('svg/heart.svg')}}"
                                         alt="{!! __('messages.ads.label__empty__like__livewire')!!}">
                                    <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                         alt="{!! __('messages.ads.label__put__alreadylike__livewire')!!}">
                                    <span>
                                        {{$worker->likes ? : 0}}</span></button>
                            </form>
                        @else
                            <form method="POST"
                                  title="{!! __('messages.ads.label__remove__like__livewire')!!} {{$worker->name}}"
                                  aria-label="{!! __('messages.ads.label__remove__like__livewire')!!} {{$worker->name}}"
                                  action="/workers/{{$worker->slug}}/like">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button-loves">
                                    <img class="heartFul heartLiked" src="{{asset('svg/heartFul.svg')}}"
                                         alt="{!! __('messages.ads.label__remove__like__livewire')!!} {{$worker->name}}">
                                    <span>
                                        {{$worker->likes ? : 0}}</span></button>
                            </form>
                        @endif
                    </div>

                @else
                    <a href="{{route('login')}}"
                       title="{!! __('messages.ads.connexion__required__like')!!} {{$worker->name}}">
                        <div
                            class="containerPrice container-love-notAuth containerLove like-users hepling helping-like help-show">

                            <img class="heart" src="{{asset('svg/heart.svg')}}"
                                 alt="{!! __('messages.ads.label__empty__like__livewire')!!}">
                            <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                 alt="{!! __('messages.ads.label__put__alreadylike__livewire')!!}">
                            <p>
                                {{$worker->likes? : 0}}</p>
                            <span>{!! __('messages.connexion__required__like__company')!!}</span>
                        </div>
                    </a>
                @endauth
            </div>
            <div class="container-picture-ads">
                @if($worker->picture)
                    <div itemprop="logo">
                        <img src="{{ asset($worker->picture) }}"
                             alt="{!! __('messages.dashboard_workerz.profil__picture')!!} {!! __('messages.of__word')!!} {{ucfirst($worker->name)}}"/>
                    </div>
                @else
                    <div itemprop="logo">
                        <img class="undefindLogo" src="{{asset('svg/ad.svg')}}"
                             alt="{!! __('messages.ads.icone__ads__alt')!!}">
                    </div>
                @endif
                <div class="container-socials-media">
                    @if($worker->facebook)
                        <div class="social-media">
                            <a href="{{$worker->facebook}}" class="iconFacebook">
                                {!! __('messages.policy.links__title')!!} Facebook
                            </a>
                        </div>
                    @endif
                    @if($worker->instagram)
                        <div class="social-media">
                            <a href="{{$worker->instagram}}" class="iconInstagram">
                                {!! __('messages.policy.links__title')!!} Instagram
                            </a>
                        </div>
                    @endif
                    @if($worker->linkedin)
                        <div class="social-media">
                            <a href="{{$worker->linkedin}}" class="iconLinkedin">
                                {!! __('messages.policy.links__title')!!} Linkedin
                            </a>
                        </div>
                    @endif
                    @if($worker->twitter)
                        <div class="social-media">
                            <a href="{{$worker->twitter}}" class="iconTwitter">
                                {!! __('messages.policy.links__title')!!} Twitter
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="container-infos-perso-ads" itemscope
                 itemtype="https://schema.org/Person">
                <h3 aria-level="3" itemprop="givenName">
                    {{ucfirst($worker->name)}}
                </h3>
                <p>
                    {{ucfirst($worker->description)}}
                </p>
                <section class="container-perso-infos container-six-category-home container-show-boxes-ads">
                    <h4 aria-level="4" class="hidden">{!! __('messages.ads.contact__info')!!}</h4>
                    @foreach($worker->phones as $up)
                        @if($up->number !== null)
                            <div>
                                <img src="{{asset('svg/phone.svg')}}" alt="{!! __('messages.icon__phone')!!}">
                                <a itemprop="telephone"
                                   href="tel:{{$up->number}}">{{chunk_split($up->number, 4, ' ')}}</a>
                            </div>
                        @endif
                    @endforeach
                    @if($worker->possibility_job == 'yes')
                        <div>
                            <img src="{{asset('svg/question-signe-en-cercles.svg')}}"
                                 alt="{!! __('messages.question__mark')!!}">
                            <span>{{ucfirst($worker->name)}} {!! __('messages.possibility__job__company')!!}</span>
                        </div>
                    @endif
                    @if($worker->possibility_job == 'no')
                        <div>
                            <img src="{{asset('svg/question-signe-en-cercles.svg')}}"
                                 alt="icone de question pour la posibilité de job">
                            <span>{{ucfirst($worker->name)}} {!! __('messages.notPossibility__job__company')!!}</span>
                        </div>
                    @endif
                    <div>
                        <img src="{{asset('svg/envelope.svg')}}" alt="{!! __('messages.ads.icone__mail__livewire')!!}">
                        <a itemprop="email" href="mailto:{{$worker->email}}">{{$worker->email}}</a>
                    </div>


                    @if($worker->startDate->count())
                        <div>
                            <img src="{{asset('svg/calendar.svg')}}" alt="{!! __('messages.icon__calendar')!!}">
                            <span>
                            Ouvert le : @foreach($worker->startDate as $ws){{substr($ws->name, 0, 3)}}{{ ($loop->last ? '' : ', ') }}@endforeach
                        </span>
                        </div>
                    @endif
                    <div>
                        <img src="{{asset('svg/suitcase.svg')}}"
                             alt="{!! __('messages.ads.icone__wallet__livewire')!!}">
                        <span class="job-cat-ads">
                        <span>{{ucfirst($worker->job)}}</span>
                        @if($worker->categoryUser->count())
                                <span class="categoryJob" itemprop="jobTitle">
                                (@foreach($worker->categoryUser as $a)@if(Session::get('applocale') === 'en'){{$a->name_en}}{{ ($loop->last ? ')' : ', ') }}@elseif(Session::get('applocale') === 'nl'){{$a->name_nl}}{{ ($loop->last ? ')' : ', ') }}@else{{$a->name}}{{ ($loop->last ? ')' : ', ') }}@endif @endforeach
                            </span>
                            @endif
                        </span>
                    </div>
                    @if($worker->adresses->count())
                        @foreach($worker->adresses as $a)
                            @if($a->postal_adress !== null)
                                <div class="container-info-announcement container-infos-position">
                                    <img src="{{asset('svg/placeholder.svg')}}"
                                         alt="{!! __('messages.ads.icone__locality__livewire')!!}">
                                    <div class="container-location" itemprop="address">
                                        <span>{{ucfirst($a->postal_adress)}}</span>
                                        <span class="categoryJob">(@if(Session::get('applocale') === 'en'){{ucfirst($a->province->name_en)}}@elseif(Session::get('applocale') === 'nl'){{ucfirst($a->province->name_nl)}}@else{{ucfirst($a->province->name)}}@endif)</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    @if($worker->pricemax)
                        <div itemtype="https://schema.org/PriceSpecification" itemscope>
                            <img src="{{asset('svg/euro.svg')}}" alt="{!! __('messages.ads.icone__euro__livewire')!!}">
                            <span
                                itemprop="minPrice">{!! __('messages.minimum__word')!!} {{$worker->pricemax}}€/h</span>
                        </div>
                    @endif
                    @if(auth()->id() !== $worker->id)
                        @auth
                            <form action="{{route('messages.post',[$worker->slug])}}" method="POST"
                                  class="formsendmsg button-workerz">
                                @csrf
                                <input type="hidden" name="from_id" id="from_id" value="{{auth()->user()->id}}">
                                <input type="hidden" name="to_id" id="to_id" value="{{$worker->id}}">
                                <input type="hidden" name="slug" id="slug" value="{{$worker->slug}}">
                                <button type="submit" class="button-cta button-msg" name="talkTo">
                                    {!! __('messages.ads.talk__text__livewire')!!} {{$worker->name}}
                                </button>
                            </form>
                        @else
                            <form action="{{route('login')}}" class="formsendmsg">
                                <button name="registerRequired"
                                        title="{!! __('messages.ads.connexion__required__talk')!!} {{ucfirst($worker->name)}}"
                                        class="button-cta button-msg formsenmsg-show-view-Notauth show-view-msg send-msg-button">
                                    {!! __('messages.ads.connexion__required__talk')!!} {{$worker->name}}
                                </button>
                            </form>
                        @endauth
                    @endif
                </section>
            </div>
            @if($worker->website)
                <a class="container-website" href="{{$worker->website}}">
                    <div itemscope itemtype="https://schema.org/ServiceChannel">
                        <img src="{{asset('svg/globe.svg')}}" alt="{!! __('messages.icon__website')!!}">
                        <span itemprop="serviceUrl">{{ucfirst(__('messages.dashboard_workerz.website__word'))}}</span>
                    </div>
                </a>
            @endif

        </section>
    </section>
    @if($randomUsers->count() > 0)
        <section class="container-categories-home margin show-content container-adss-random">
            <div class="container-title-ads">
                <h2 aria-level="2">
                    {!! __('messages.ads.ads__text')!!}
                </h2>
            </div>
            <div class="container-ads-random">
                @foreach($randomUsers as $ra)
                    <section class="container-infos-perso-ads container-ad-random container-ads-randomm container-users"
                             itemscope
                             itemtype="https://schema.org/Person">
                        <div class="container_title__province">
                            <div class="container-love-show">
                                @auth
                                    <div
                                        class="containerPrice container-show-love like-ads containerLove help-show @guest notHoverHeart @endguest">
                                        @if(!$ra->isLikedUBy($ra))
                                            <form method="POST"
                                                  title="{!! __('messages.ads.label__put__like__livewire')!!} {{$worker->name}}"
                                                  aria-label="{!! __('messages.ads.label__put__like__livewire')!!} {{$worker->name}}"
                                                  action="/workers/{{$ra->slug}}/like">
                                                @csrf

                                                <button type="submit" class="button-loves">
                                                    <img class="heart" src="{{asset('svg/heart.svg')}}"
                                                         alt="{!! __('messages.ads.label__put__like__livewire')!!} {{$worker->name}}">
                                                    <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                                         alt="{!! __('messages.ads.label__put__alreadylike__livewire')!!} {{$worker->name}}">
                                                    <span>
                                        {{$ra->likes ? : 0}}</span></button>
                                            </form>
                                        @else

                                            <form method="POST"
                                                  title="{!! __('messages.ads.label__remove__like__livewire')!!} {{$worker->name}}"
                                                  aria-label="{!! __('messages.ads.label__remove__like__livewire')!!} {{$worker->name}}"
                                                  action="/workers/{{$ra->slug}}/like">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button-loves">
                                                    <img class="heartFul heartLiked" src="{{asset('svg/heartFul.svg')}}"
                                                         alt="{!! __('messages.ads.label__remove__like__livewire')!!} {{$worker->name}}">
                                                    <span>
                                        {{$ra->likes ? : 0}}</span></button>
                                            </form>
                                        @endif
                                    </div>

                                @else
                                    <a href="{{route('login')}}"
                                       title="{!! __('messages.ads.connexion__required__like')!!} {{$worker->name}}">
                                    <div
                                        class="containerPrice containerLove like-users like-ads hepling helping-like help-show">

                                        <img class="heart" src="{{asset('svg/heart.svg')}}"
                                             alt="{!! __('messages.ads.label__empty__like__livewire')!!}">
                                        <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                             alt="{!! __('messages.ads.label__fullheart__like__livewire')!!}">
                                        <p>
                                            {{$ra->likes? : 0}}</p>
                                        <span>{!! __('messages.ads.connexion__required__like')!!} {{$worker->name}}</span>
                                    </div>
                                    </a>
                                @endauth
                            </div>
                            <div class="container-picture-ads container-profil-img">
                                @if($ra->picture)
                                    <img src="{{ asset($ra->picture) }}"
                                         alt="{!! __('messages.dashboard_workerz.profil__picture')!!} {!! __('messages.of__word')!!} {{$ra->name}}"/>
                                @else
                                    <img src="{{ asset('svg/ad.svg') }}"
                                         alt="{!! __('messages.auth.registration__img__alt__prof')!!}">
                                @endif
                            </div>
                            <div itemprop="givenName">
                                <h3 aria-level="3">
                                    {{ucfirst($ra->name)}}
                                    {{ucfirst($ra->surname)}}
                                </h3>
                            </div>
                            <div class="container-infos-ads-randomm">
                                <p>
                                    {{ucfirst(substr($ra->description,0,100)).'...'}}
                                </p>
                                <div class="container-position-ads">
                                    <img width="40px" height="40px" src="{{asset('svg/suitcase.svg')}}"
                                         alt="{!! __('messages.ads.icone__wallet__livewire')!!}">
                                    <span class="job-cat-ads" itemprop="jobTitle">
                                    <p>{{ucfirst($ra->job)}}
                                        @if($ra->categoryUser->count())
                                            (@foreach($ra->categoryUser as $a)@if(Session::get('applocale') === 'en'){{$a->name_en}}{{ ($loop->last ? ')' : ', ') }}@elseif(Session::get('applocale') === 'nl'){{$a->name_nl}}{{ ($loop->last ? ')' : ', ') }}@else{{$a->name}}{{ ($loop->last ? ')' : ', ') }}@endif @endforeach
                                        </p>
                                        @endif
                                </span>
                                </div>
                                @if($ra->adresses->count())
                                    <div class="container-info-announcement">
                                        <img width="40px" height="40px" src="{{asset('svg/placeholder.svg')}}"
                                             alt="{!! __('messages.ads.icone__locality__livewire')!!}">
                                        <div class="container-location" itemprop="address">
                                            <p>{{ucfirst($ra->adresses->first()->postal_adress)}}</p>
                                            <p class="categoryJob">({{ucfirst($ra->adresses->first()->province->name)}})</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <a href="/workers/{{$ra->slug}}" class="btn-ads button-personnal-announcement">
                            {!! __('messages.ads.see__details__alt')!!} {{$ra->name}}
                        </a>
                    </section>
                @endforeach
            </div>
        </section>
    @endif
@endsection
