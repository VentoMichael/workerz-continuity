@extends('layouts.app')
@section('content')
    @if (Session::has('loveOk'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}"
                                                                  alt="pictogramme d'un v correct">
            <p>{!!session('loveOk')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('loveNotOk'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}"
                                                                  alt="pictogramme d'un v correct">
            <p>{!!session('loveNotOk')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <section class="container-home margin">
        <div class="container-home_image container-home-create container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Aidons {{ucfirst($announcement->user->name)}} {{ucfirst($announcement->user->surname)}}
                    </h2>
                    <p>Prenez contact
                        avec {{ucfirst($announcement->user->name)}} {{ucfirst($announcement->user->surname)}}, soit par
                        <a
                                href="mailto:{{$announcement->user->email}}">mail</a> soit par <a
                                href="tel:{{$announcement->user->phones->first()->number}}">téléphone</a>. Cette
                        personne
                        s'enverra ravir&nbsp;!</p>
                </div>
            </div>
            <div class="container-svg">
                <img width="300" height="300" src="{{asset('svg/Great_idea_Monochromatic.svg')}}"
                     alt="Personne choissisant la catégorie de métier">
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
                    Une annonce {{$randomPhrasing->name}}
                </h2>
            @endif
        </div>
        <section class="container-personnal-ads show-content container-adv" itemtype="https://schema.org/Thing"
                 itemscope>
            <div class="container-love-show">
                @auth
                    <div
                            class="containerPrice container-show-love containerLove help-show @guest notHoverHeart @endguest">
                        @if(!$announcement->isLikedBy($user))
                            <form method="POST" title="Mettre un j'aime à {{$announcement->title}}"
                                  aria-label="Mettre un j'aime à {{$announcement->title}}"
                                  action="/announcements/{{$announcement->slug}}/like">
                                @csrf

                                <button type="submit" class="button-loves">
                                    <img width="60" height="60" class="heart" src="{{asset('svg/heart.svg')}}"
                                         alt="Mettre un j'aime à {{$announcement->title}}">
                                    <img width="60" height="60" class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                         alt="Le j'aime à déjà été attribuer à {{$announcement->title}}">
                                    <span>
                                        {{$announcement->likes ? : 0}}</span></button>
                            </form>
                        @else

                            <form method="POST" title="Enlever le j'aime donner à {{$announcement->title}}"
                                  aria-label="Enlever le j'aime donner à {{$announcement->title}}"
                                  action="/announcements/{{$announcement->slug}}/like">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button-loves">
                                    <img width="60" height="60" class="heartFul heartLiked"
                                         src="{{asset('svg/heartFul.svg')}}"
                                         alt="Enlever le j'aime attribué à {{$announcement->title}}">
                                    <span>
                                        {{$announcement->likes ? : 0}}</span></button>
                            </form>
                        @endif
                    </div>

                @else
                    <a href="{{route('login')}}"
                       title="Il faut se connecté pour mettre un j'aime à {{$announcement->title}}">
                        <div class="containerPrice containerLove hepling helping-like help-show">

                            <img width="60" height="60" class="heart" src="{{asset('svg/heart.svg')}}"
                                 alt="icone de coeur vide">
                            <img width="60" height="60" class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                 alt="icone de coeur remplis">
                            <p>
                                {{$announcement->likes? : 0}}</p>
                            <span> Il faut être connecté pour aimer l'annonce</span>
                        </div>
                    </a>
                @endauth
            </div>


            <div class="container-picture-ads">
                @if($announcement->picture)
                    <img itemprop="image" src="{{ asset($announcement->picture) }}"
                         alt="photo de profil de {{ucfirst($announcement->title)}}"/>
                @else
                    <img itemprop="image" src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
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
                    <h4 aria-level="4" class="hidden">Information de contact</h4>
                    <div>
                        <img src="{{asset('svg/envelope.svg')}}" alt="icone de mail">
                        <a itemprop="email"
                           href="mailto:{{$announcement->user->email}}">{{$announcement->user->email}}</a>
                    </div>
                    @foreach($announcement->user->phones as $up)
                        @if($up->number != null)
                            <div>
                                <img src="{{asset('svg/phone.svg')}}" alt="icone de téléphone">
                                <a itemprop="telephone" href="tel:{{$up->number}}">{{chunk_split($up->number, 4, ' ')}}</a>
                            </div>
                        @endif
                    @endforeach
                    <div>
                        <img src="{{asset('svg/calendar.svg')}}" alt="icone de calendrier">
                        <span>
                            À partir de {{$announcement->startmonth->name}}
                        </span>
                    </div>
                    <div>
                        <img src="{{asset('svg/suitcase.svg')}}" alt="icone de malette">
                        <span class="job-cat-ads" itemprop="jobTitle">
                        <span>{{ucfirst($announcement->job)}}</span>
                        @if($announcement->categoryAds->count())
                                <span class="categoryJob">
                                (@foreach($announcement->categoryAds as $a){{$a->name}}{{ ($loop->last ? '' : ', ') }}@endforeach)
                            </span>
                            @endif
                        </span>
                    </div>
                    @if(!$announcement->pricemax)
                        <div itemscope itemtype="https://schema.org/PriceSpecification">
                            <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro">
                            <span itemprop="price">Max : non déterminer</span>
                        </div>
                    @else
                        <div itemscope itemtype="https://schema.org/PriceSpecification">
                            <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro">
                            <span itemprop="price">Max : {{$announcement->pricemax}} €</span>
                        </div>
                    @endif
                    <div itemscope itemtype="https://schema.org/PostalAddress">
                        <img src="{{asset('svg/placeholder.svg')}}" alt="icone de position">
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
                                Parler avec {{$user->name}} {{$user->surname}}
                            </button>
                        </form>
                    @else
                            <form action="{{route('login')}}" class="formsendmsg">
                                <button name="registerRequired"
                                        title="Il faut se connecté pour parler avec le detenteur de l'annonce"
                                        class="button-cta button-msg formsenmsg-show-view-Notauth show-view-msg send-msg-button">
                                    Il faut être connecté
                                    pour parler avec la personne ayant poster l'annonce
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
                    Ca pourrait vous intéresser
                </h2>
            </div>
            <div class="container-ads-random">
                @foreach($randomAds as $ra)
                    <section class="container-announcement container-ads-randomm" wire:loading.class="load" itemtype="https://schema.org/Thing"
                             itemscope>
                        <div class="container-infos-announcement">
                            <div class="container-love-show">
                                @auth
                                    <div
                                        class="containerPrice container-show-love like-users-connected like-index containerLove help-show @guest notHoverHeart @endguest">
                                        @if(!$ra->isLikedBy($user))
                                            <form method="POST" title="Mettre un j'aime à {{$ra->title}}"
                                                  aria-label="Mettre un j'aime à {{$ra->title}}"
                                                  action="/announcements/{{$ra->slug}}/like">
                                                @csrf

                                                <button type="submit" class="button-loves">
                                                    <img class="heart" src="{{asset('svg/heart.svg')}}"
                                                         alt="Mettre un j'aime à {{$ra->title}}">
                                                    <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                                         alt="Le j'aime à déjà été attribuer à {{$ra->title}}">
                                                    <span>
                                        {{$ra->likes ? : 0}}</span></button>
                                            </form>
                                        @else

                                            <form method="POST" title="Enlever le j'aime donner à {{$ra->title}}"
                                                  aria-label="Enlever le j'aime donner à {{$ra->title}}"
                                                  action="/announcements/{{$ra->slug}}/like">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button-loves">
                                                    <img class="heartFul heartLiked" src="{{asset('svg/heartFul.svg')}}"
                                                         alt="Enlever le j'aime donner à {{$ra->title}}">
                                                    <span>
                                        {{$ra->likes ? : 0}}</span></button>
                                            </form>
                                        @endif
                                    </div>
                                @else
                                        <a href="{{route('login')}}"
                                           title="Il faut être connecté pour aimer l'annonce">
                                            <div class="containerPrice containerLove hepling helping-like help-show">

                                                <img width="60" height="60" class="heart" src="{{asset('svg/heart.svg')}}"
                                                     alt="icone de coeur vide">
                                                <img width="60" height="60" class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                                     alt="icone de coeur remplis">
                                                <p>
                                                    {{$ra->likes? : 0}}</p>
                                                <span> Il faut être connecté pour aimer l'annonce</span>
                                            </div>
                                        </a>
                                @endauth
                            </div>
                            @if($ra->pricemax)
                                <div class="containerPrice">
                                    <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro"><span>Max: {{$ra->pricemax}}€</span>
                                </div>
                            @endif
                            <div class="container-image-announcement container-profil-img">
                                @if($ra->picture)
                                    <img itemprop="image" src="{{ asset($ra->picture) }}"
                                         alt="image de profil de {{$ra->title}}"/>
                                @else
                                    <img itemprop="image" src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
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
                                        <img src="{{asset('svg/suitcase.svg')}}" alt="icone de malette de travail">
                                        <div class="containerJobAds">
                                            <p>
                                                {{ucfirst($ra->job)}} @if($ra->categoryAds->count())
                                                    <span class="categoryJob">
                                                (@foreach($ra->categoryAds as $a){{$a->name}}{{ ($loop->last ? '' : ', ') }}@endforeach)
                                            </span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="container-info-announcement" itemtype="https://schema.org/PostalAddress"
                                         itemscope>
                                        <img src="{{asset('svg/placeholder.svg')}}" alt="icone de localité">
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
                        <a href="/announcements/{{$ra->slug}}" title="Voir les détails de {{$ra->title}}" class="button-personnal-announcement">
                            Voir les détails de {{$ra->title}}
                        </a>
                    </section>
                @endforeach
            </div>
        </section>
    @endif
@endsection
