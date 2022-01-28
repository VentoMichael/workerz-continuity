@extends('layouts.app')
@section('content')
    @if (Session::has('loveOk'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}"
                                                                  alt="{!! __('messages.good__answer')!!}">
            <p>{!!session('loveOk')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('loveNotOk'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}"
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
                        {!! __('messages.ads.help__text')!!} {{ucfirst($announcement->user->name)}} {{ucfirst($announcement->user->surname)}}
                    </h2>
                    <p>{!! __('messages.ads.take__contact')!!} {{ucfirst($announcement->user->name)}} {{ucfirst($announcement->user->surname)}}
                        , {!! __('messages.ads.choice__contact')!!}
                        <a
                            href="mailto:{{$announcement->user->email}}">{{strtolower(__('messages.auth.email__word'))}}</a> {!! __('messages.ads.choice__contact')!!}
                        <a
                            href="tel:{{$announcement->user->phones->first()->number}}">{!! __('messages.dashboard_workerz.phone__word')!!}</a>. {!! __('messages.ads.peopel__happy')!!}
                    </p>
                </div>
            </div>
            <div class="container-svg">
                <img width="300" height="300" src="{{asset('svg/Great_idea_Monochromatic.svg')}}"
                     alt="{!! __('messages.about.img__alt__us')!!}">
            </div>
        </div>
    </section>
    <section class="container-categories-home margin" @if($randomAds->count() < 1)style="margin-bottom:50px;" @endif>
        <div class="container-categories-text-home">
            @if($announcement->catchPhrase)
                <h2 aria-level="2">
                    {{ $announcement->catchPhrase }}
                </h2>
            @else
                <h2 aria-level="2">
                    {!! __('messages.home.ad__word')!!}
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
        <section class="container-personnal-ads show-content container-worker container-adv" itemtype="https://schema.org/Thing"
                 itemscope>
            <div class="container-love-show">
                @auth
                    <div
                        class="containerPrice container-show-love containerLove help-show @guest notHoverHeart @endguest">
                        @if(!$announcement->isLikedBy($user))
                            <form method="POST"
                                  title="{!! __('messages.ads.label__put__like__livewire')!!} {{$announcement->title}}"
                                  aria-label="{!! __('messages.ads.label__put__like__livewire')!!} {{$announcement->title}}"
                                  action="/announcements/{{$announcement->slug}}/like">
                                @csrf

                                <button type="submit" class="button-loves">
                                    <img width="60" height="60" class="heart" src="{{asset('svg/heart.svg')}}"
                                         alt="{!! __('messages.ads.label__empty__like__livewire')!!} {{$announcement->title}}">
                                    <img width="60" height="60" class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                         alt="{!! __('messages.ads.label__put__alreadylike__livewire')!!} {{$announcement->title}}">
                                    <span>
                                        {{$announcement->likes ? : 0}}</span></button>
                            </form>
                        @else

                            <form method="POST"
                                  title="{!! __('messages.ads.label__remove__like__livewire')!!} {{$announcement->title}}"
                                  aria-label="{!! __('messages.ads.label__remove__like__livewire')!!} {{$announcement->title}}"
                                  action="/announcements/{{$announcement->slug}}/like">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button-loves">
                                    <img width="60" height="60" class="heartFul heartLiked"
                                         src="{{asset('svg/heartFul.svg')}}"
                                         alt="{!! __('messages.ads.label__remove__like__livewire')!!} {{$announcement->title}}">
                                    <span>
                                        {{$announcement->likes ? : 0}}</span></button>
                            </form>
                        @endif
                    </div>

                @else
                <a href="{{route('login')}}"
                       title="{!! __('messages.ads.connexion__required__like')!!} {{$announcement->name}}">
                        <div
                            class="containerPrice container-love-notAuth containerLove like-users hepling helping-like help-show">

                            <img class="heart" src="{{asset('svg/heart.svg')}}"
                                 alt="{!! __('messages.ads.label__empty__like__livewire')!!}">
                            <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                 alt="{!! __('messages.ads.label__put__alreadylike__livewire')!!}">
                            <p>
                                {{$announcement->likes? : 0}}</p>
                            <span>{!! __('messages.connexion__required__like__company')!!}</span>
                        </div>
                    </a>
                @endauth
            </div>


            <div class="container-picture-ads">
                @if($announcement->picture)
                    <img itemprop="image" src="{{ asset($announcement->picture) }}"
                         alt="{!! __('messages.dashboard_workerz.profil__picture')!!} {!! __('messages.of__word')!!} {{ucfirst($announcement->title)}}"/>
                @else
                    <img itemprop="image" src="{{asset('svg/ad.svg')}}" alt="{!! __('messages.ads.icone__ads__alt')!!}">
                @endif
            </div>
            <div class="container-infos-perso-ads">
                <h3 aria-level="3" itemprop="name">
                    {{ucfirst($announcement->title)}}
                </h3>
                <p itemprop="description">
                    {{ucfirst($announcement->description)}}
                </p>
                <section class="container-perso-infos container-six-category-home container-show-boxes-ads" itemscope
                         itemtype="https://schema.org/Person">
                    <h4 aria-level="4" class="hidden">{!! __('messages.ads.contact__info')!!}</h4>
                    <div>
                        <img src="{{asset('svg/envelope.svg')}}" alt="{!! __('messages.ads.icone__mail__livewire')!!}">
                        <a itemprop="email"
                           href="mailto:{{$announcement->user->email}}">{{$announcement->user->email}}</a>
                    </div>
                    @foreach($announcement->user->phones as $up)
                        @if($up->number != null)
                            <div>
                                <img src="{{asset('svg/phone.svg')}}" alt="{!! __('messages.icon__phone')!!}">
                                <a itemprop="telephone"
                                   href="tel:{{$up->number}}">{{chunk_split($up->number, 4, ' ')}}</a>
                            </div>
                        @endif
                    @endforeach
                    <div>
                        <img src="{{asset('svg/calendar.svg')}}" alt="{!! __('messages.icon__calendar')!!}">
                        <span>
                            {!! __('messages.ads.after__date')!!} {{$announcement->startmonth->name}}
                        </span>
                    </div>
                    <div>
                        <img src="{{asset('svg/suitcase.svg')}}"
                             alt="{!! __('messages.ads.icone__wallet__livewire')!!}">
                        <span class="job-cat-ads" itemprop="jobTitle">
                        <span>{{ucfirst($announcement->job)}}</span>
                        @if($announcement->categoryAds->count())
                                <span class="categoryJob">
                                (@foreach($announcement->categoryAds as $a)@if(Session::get('applocale') === 'en'){{$a->name_en}}{{ ($loop->last ? ')' : ', ') }}@elseif(Session::get('applocale') === 'nl'){{$a->name_nl}}{{ ($loop->last ? ')' : ', ') }}@else{{$a->name}}{{ ($loop->last ? ')' : ', ') }}@endif @endforeach
                            </span>
                            @endif
                        </span>
                    </div>
                    @if(!$announcement->pricemax)
                        <div itemscope itemtype="https://schema.org/PriceSpecification">
                            <img src="{{asset('svg/euro.svg')}}" alt="{!! __('messages.ads.icone__euro__livewire')!!}">
                            <span itemprop="price">{!! __('messages.max__notdetermined')!!}</span>
                        </div>
                    @else
                        <div itemscope itemtype="https://schema.org/PriceSpecification">
                            <img src="{{asset('svg/euro.svg')}}" alt="{!! __('messages.ads.icone__euro__livewire')!!}">
                            <span itemprop="price">{{ucfirst(__('messages.ads.max__euro__livewire'))}} : {{$announcement->pricemax}} €</span>
                        </div>
                    @endif
                    <div itemscope itemtype="https://schema.org/PostalAddress">
                        <img src="{{asset('svg/placeholder.svg')}}"
                             alt="{!! __('messages.ads.icone__locality__livewire')!!}">
                        <span>
                            @if($announcement->adress)
                                <span itemprop="streetAddress">{{$announcement->adress}}</span>
                            @endif
                                <span itemprop="addressRegion">{{ucfirst($announcement->province->name)}}</span>
                        </span>
                    </div>
                    @if(auth()->id() !== $announcement->user_id)
                        @auth
                            <form action="{{route('messages.post',[$announcement->user->slug])}}" method="POST"
                                  class="formsendmsg button-workerz">
                                @csrf
                                <input type="hidden" name="from_id" id="from_id" value="{{auth()->user()->id}}">
                                <input type="hidden" name="to_id" id="to_id" value="{{$announcement->user->id}}">
                                <input type="hidden" name="slug" id="slug" value="{{$announcement->user->slug}}">
                                <button type="submit" class="button-cta button-msg" name="talkTo">
                                    {!! __('messages.ads.talk__text__livewire')!!} {{$user->name}} {{$user->surname}}
                                </button>
                            </form>
                        @else
                            <form action="{{route('login')}}" class="formsendmsg">
                                <button name="registerRequired"
                                        title="{!! __('messages.ads.connexion__required__talk__ad')!!}"
                                        class="button-cta button-msg formsenmsg-show-view-Notauth show-view-msg send-msg-button">
                                    {!! __('messages.ads.connexion__required__talk__ad')!!}
                                </button>
                            </form>
                        @endauth
                    @endif
                </section>
            </div>
        </section>
    </section>
    @if($randomAds->count() > 0)
        <section class="container-categories-home margin show-content container-adss-random">
            <div class="container-title-ads">
                <h2 aria-level="2">
                    {!! __('messages.ads.ads__text')!!}
                </h2>
            </div>
            <div class="container-ads-random">
                @foreach($randomAds as $ra)
                    <section class="container-announcement container-ads-randomm" wire:loading.class="load"
                             itemtype="https://schema.org/Thing"
                             itemscope>
                        <div class="container-infos-announcement">
                            <div class="container-love-show">
                                @auth
                                    <div
                                        class="containerPrice container-show-love like-users-connected like-index containerLove help-show @guest notHoverHeart @endguest">
                                        @if(!$ra->isLikedBy($user))
                                            <form method="POST"
                                                  title="{!! __('messages.ads.label__put__like__livewire')!!} {{$ra->title}}"
                                                  aria-label="{!! __('messages.ads.label__put__like__livewire')!!} {{$ra->title}}"
                                                  action="/announcements/{{$ra->slug}}/like">
                                                @csrf

                                                <button type="submit" class="button-loves">
                                                    <img class="heart" src="{{asset('svg/heart.svg')}}"
                                                         alt="{!! __('messages.ads.label__put__like__livewire')!!} {{$ra->title}}">
                                                    <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                                         alt="{!! __('messages.ads.label__put__alreadylike__livewire')!!} {{$ra->title}}">
                                                    <span>
                                        {{$ra->likes ? : 0}}</span></button>
                                            </form>
                                        @else

                                            <form method="POST"
                                                  title="{!! __('messages.ads.label__remove__like__livewire')!!} {{$ra->title}}"
                                                  aria-label="{!! __('messages.ads.label__remove__like__livewire')!!} {{$ra->title}}"
                                                  action="/announcements/{{$ra->slug}}/like">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button-loves">
                                                    <img class="heartFul heartLiked" src="{{asset('svg/heartFul.svg')}}"
                                                         alt="{!! __('messages.ads.label__remove__like__livewire')!!} {{$ra->title}}">
                                                    <span>
                                        {{$ra->likes ? : 0}}</span></button>
                                            </form>
                                        @endif
                                    </div>
                                @else
                                    <a href="{{route('login')}}"
                                       title="{!! __('messages.ads.connexion__required__like')!!} {{$ra->title}}">
                                        <div class="containerPrice containerLove hepling helping-like help-show">

                                            <img width="60" height="60" class="heart" src="{{asset('svg/heart.svg')}}"
                                                 alt="{!! __('messages.ads.label__empty__like__livewire')!!}">
                                            <img width="60" height="60" class="heartFul"
                                                 src="{{asset('svg/heartFul.svg')}}"
                                                 alt="{!! __('messages.ads.label__fullheart__like__livewire')!!}">
                                            <p>
                                                {{$ra->likes? : 0}}</p>
                                            <span>{!! __('messages.ads.connexion__required__like')!!} {{$ra->title}}</span>
                                        </div>
                                    </a>
                                @endauth
                            </div>
                            @if($ra->pricemax)
                                <div class="containerPrice">
                                    <img src="{{asset('svg/euro.svg')}}"
                                         alt="{!! __('messages.ads.icone__euro__livewire')!!}"><span>{{ucfirst(__('messages.ads.max__euro__livewire'))}} : {{$ra->pricemax}}€</span>
                                </div>
                            @endif
                            <div class="container-image-announcement container-profil-img">
                                @if($ra->picture)
                                    <img itemprop="image" src="{{ asset($ra->picture) }}"
                                         alt="{!! __('messages.alt__profil__img')!!} {{$ra->title}}"/>
                                @else
                                    <img itemprop="image" src="{{asset('svg/ad.svg')}}"
                                         alt="{!! __('messages.dashboard_workerz.icone__ads__alt')!!}">
                                @endif
                            </div>
                            <div class="container-description-Ads">
                                <h3 aria-level="3" itemprop="name" id="ad{{$ra->id}}">
                                    {{ucfirst($ra->title)}}
                                </h3>
                                <p class="paragraph-ann" itemprop="description">
                                    {{ucfirst(substr($ra->description,0,100)).'...'}}
                                </p>
                                <div class="container-infos">
                                    <div class="container-info-announcement">
                                        <img src="{{asset('svg/suitcase.svg')}}"
                                             alt="{!! __('messages.ads.icone__wallet__livewire')!!}">
                                        <div class="containerJobAds">
                                            <p>
                                                {{ucfirst($ra->job)}} @if($ra->categoryAds->count())
                                                    <span class="categoryJob">
                                                (@foreach($ra->categoryAds as $a)@if(Session::get('applocale') === 'en'){{$a->name_en}}{{ ($loop->last ? ')' : ', ') }}@elseif(Session::get('applocale') === 'nl'){{$a->name_nl}}{{ ($loop->last ? ')' : ', ') }}@else{{$a->name}}{{ ($loop->last ? ')' : ', ') }}@endif @endforeach
                                            </span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="container-info-announcement" itemtype="https://schema.org/PostalAddress"
                                         itemscope>
                                        <img src="{{asset('svg/placeholder.svg')}}"
                                             alt="{!! __('messages.ads.icone__locality__livewire')!!}">
                                        <div>
                                            @if($ra->adress)
                                                <p itemprop="streetAddress">{{$ra->adress}}</p>
                                            @endif
                                            <p itemprop="addressRegion">
                                                {{ucfirst($ra->province->name)}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="/announcements/{{$ra->slug}}"
                           title="{!! __('messages.ads.see__details__alt')!!} {{$ra->title}}"
                           class="button-personnal-announcement">
                            {!! __('messages.ads.see__details__alt')!!} {{$ra->title}}
                        </a>
                    </section>
                @endforeach
            </div>
        </section>
    @endif
@endsection
