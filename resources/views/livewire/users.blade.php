<div class="container-home container-search" id="workerzLink">
    @if(request('search') && count($workerz) === 0 && !$newsletterValidated || $search && count($workerz) === 0 && !$newsletterValidated)
        @include('partials.newsletter')
    @endif
    <div class="container-search hideForNewsletter">
        <form action="{{route('workers')}}" aria-label="Recherche d'indépendants" role="search" method="get"
              class="formSearchAd">
            <label for="search" class="hidden">Recherche d'entreprises</label>
            <input type="text" name="search" value="{{request('search')}}" id="search" wire:model="search"
                   placeholder="Quel métier recherchez-vous ?"
                   class="search-announcement search-home">
            <noscript>
                <input type="submit" class="submit-category-home submit-ad" value="Recherchez">
            </noscript>
        </form>
        @if($helpText !== '') <span style="margin-top: 10px;">{{$helpText}}</span>@endif
    </div>
    <section class="container-announcements show-content hideForNewsletter" id="workerz-section">
        <h2 class="hidden" aria-level="2">
            Toutes les entreprises
        </h2>
        <div class="container-all-announcement show-content @if($workerz->count() < 1) noAds @endif">
            @forelse($workerz as $worker)
                <section class="container-announcement" wire:loading.class="load" itemscope
                         itemtype="https://schema.org/Person">
                    <div class="container-infos-announcement">
                        <div class="container-love-show">
                            @auth
                                <div
                                    class="containerPrice container-show-love like-users-connected containerLove like-index help-show @guest notHoverHeart @endguest">
                                    @if(!$worker->isLikedUBy($worker))
                                        <form method="POST" title="Mettre un j'aime à {{$worker->name}}"
                                              aria-label="Mettre un j'aime à {{$worker->name}}"
                                              action="/workers/{{$worker->slug}}/like">
                                            @csrf

                                            <button type="submit" class="button-loves">
                                                <img class="heart" src="{{asset('svg/heart.svg')}}"
                                                     alt="Mettre un j'aime à {{$worker->name}}">
                                                <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                                     alt="Le j'aime à déjà été attribuer à {{$worker->name}}">
                                                <span>
                                        {{$worker->likes ? : 0}}</span></button>
                                        </form>
                                    @else

                                        <form method="POST" title="Enlever le j'aime donner à {{$worker->name}}"
                                              aria-label="Enlever le j'aime donner à {{$worker->name}}"
                                              action="/workers/{{$worker->slug}}/like">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button-loves">
                                                <img class="heartFul heartLiked" src="{{asset('svg/heartFul.svg')}}"
                                                     alt="Enlever le j'aime attribué à {{$worker->title}}">
                                                <span>
                                        {{$worker->likes ? : 0}}</span></button>
                                        </form>
                                    @endif
                                </div>

                            @else
                                <form action="{{route('login')}}">
                                    <button style="border: none;max-height: inherit" name="registerRequired"
                                            title="Il faut se connecter pour mettre un j'aime à {{$worker->name}}"
                                            class="containerPrice containerLove like-users like-index hepling helping-like help-show">
                                        <img class="heart" src="{{asset('svg/heart.svg')}}" alt="icone de coeur vide">
                                        <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                             alt="icone de coeur remplis">
                                        <p>
                                            {{$worker->likes? : 0}}</p>
                                    </button>
                                </form>
                            @endauth
                        </div>
                        @if($worker->pricemax)
                            <div class="containerPrice" itemscope itemtype="https://schema.org/PriceSpecification">
                                <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro">
                                <span itemprop="price">{{$worker->pricemax}} €/h</span>
                            </div>
                        @endif
                        <div class="container-image-announcement container-profil-img">
                            @if($worker->picture)
                                <img src="{{ $worker->picture }}"
                                     alt="image de profil de {{$worker->name}} @if($worker->surname) {{$worker->surname}} @endif">
                            @else
                                <img src="{{asset('svg/market.svg')}}" alt="icone d'un magasin">
                            @endif
                        </div>
                        <div class="container-description-Ads">

                            <h3 aria-level="3" itemprop="affiliation">
                                {{ucfirst($worker->name)}}
                            </h3>
                            <p class="paragraph-ann">
                                {{ucfirst($worker->description)}}
                            </p>
                            <div class="container-infos">
                                <div class="container-info-announcement">
                                    <img src="{{asset('svg/suitcase.svg')}}" alt="icone de malette de travail">
                                    <div class="containerJobAds" itemprop="jobTitle">
                                        <p>{{ucfirst($worker->job)}}</p>
                                        @if($worker->categoryUser->count())
                                            <p class="categoryJob">
                                                (@foreach($worker->categoryUser as $w){{ucfirst($w->name)}}{{ ($loop->last ? '' : ', ') }}@endforeach)
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                @if($worker->adresses->count())
                                    <div class="container-info-announcement">
                                        <img src="{{asset('svg/placeholder.svg')}}" alt="icone de localité">
                                        <div class="container-location" itemprop="address">
                                            <p>{{ucfirst($worker->adresses->first()->postal_adress)}}</p>
                                            @if(ucfirst($worker->adresses->first()->postal_adress))
                                                <p class="categoryJob">
                                                    ({{ucfirst($worker->adresses->first()->province->name)}})</p>@else
                                                <p class="categoryJob">{{ucfirst($worker->adresses->first()->province->name)}}</p>@endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div>
                        @if(auth()->id() !== $worker->id)
                            @auth
                                @if($workerz)
                                    <form action="{{route('messages.post',[$worker->slug])}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="from_id" id="from_id{{$loop->index}}"
                                               value="{{auth()->user()->id}}">
                                        <input type="hidden" name="to_id" id="to_id{{$loop->index}}"
                                               value="{{$worker->id}}">
                                        <input type="hidden" name="slug" id="slug{{$loop->index}}"
                                               value="{{$worker->slug}}">
                                        <button type="submit" class="formsendmsg formsenmsg-show-view-Notauth button-cta button-msg" title="Parler avec {{ucfirst($worker->name)}} {{ucfirst($worker->surname)}}" name="talkTo">
                                            Parler avec {{ucfirst($worker->name)}} {{ucfirst($worker->surname)}}
                                        </button>
                                    </form>
                                @endif
                            @else
                                <form action="{{route('login')}}">
                                    <button name="registerRequired"
                                            title="Il faut se connecté pour parler avec {{ucfirst($worker->name)}} {{ucfirst($worker->surname)}}"
                                            class="formsendmsg formsenmsg-show-view-Notauth button-cta button-msg">
                                        Parler
                                        avec {{ucfirst($worker->name)}} {{ucfirst($worker->surname)}}                            </button>
                                </form>
                            @endauth
                        @endif
                        <a href="/workers/{{$worker->slug}}" title="Voir les détails de {{ucfirst($worker->name)}}" class="button-personnal-announcement">
                            Voir les détails de {{ucfirst($worker->name)}}
                        </a>
                    </div>
                </section>
            @empty
                <section wire:loading.class="load" class="container-announcement container-empty-ad">
                    <div class="container-infos-announcement">
                        <img src="{{asset('svg/not-found.svg')}}" alt="Pictogramme d'une ampoule">
                        <h3 aria-level="3">
                            Aucun indépendant trouvé avec cette recherche
                        </h3>
                        <p class="containerAllText" style="margin-top: 10px;">
                            Oops, je n'ai rien trouvé @if($search)avec cette recherche <i>"{{$search}}"</i>@endif&nbsp;!
                            Essayez une autre recherche ou <a
                                style="text-decoration: underline;"
                                href="{{route('workers').'#adsLink'}}">rafraichissez la page</a>
                        </p>
                    </div>
                </section>
            @endforelse
            {{ $workerz->links() }}
        </div>
        <div class="container-filters container-filters-workerz">
            <form aria-label="Filtrage d'indépendants" action="{{route('workers')}}" method="get">
                <section>
                    <h2 aria-level="2">
                        Filtres
                    </h2>
                    <section class="container-filter-categories">
                        <h3 aria-level="3">
                            Catégories
                        </h3>
                        <ul class="list-categories">
                            <fieldset>
                                <legend class="hidden">Catégories</legend>
                                @foreach($categories as $category)
                                    <li>
                                        <input
                                            @if(request('categoryUser') && in_array($category->id,request('categoryUser'))) checked
                                            @else wire:model="categoryUser" @endif role="checkbox"
                                            class="hiddenCheckbox inp-cbx"
                                            name="categoryUser[]"
                                            id="categoryUser{{$category->id}}"
                                            type="checkbox" value="{{$category->id}}"/>
                                        <label class="cbx" for="categoryUser{{$category->id}}">
        <span>
            <svg width="12px" height="9px" viewbox="0 0 12 9">
              <polyline points="1 5 4 8 11 1"></polyline>
            </svg>
        </span>
                                            <span>{{$category->name}}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </fieldset>
                        </ul>
                    </section>
                    <section class="container-filter-categories">
                        <h3 aria-level="3">
                            Régions
                        </h3>
                        <ul class="list-categories">
                            <fieldset>
                                <legend class="hidden">Régions</legend>
                                @foreach($regions as $region)
                                    <li>
                                        <input
                                            @if(request('provinces') && in_array($region->id,request('provinces'))) checked
                                            @endif wire:model="provinces" role="checkbox"
                                            aria-checked="false" class="hiddenCheckbox inp-cbx"
                                            id="provinces{{$region->id}}"
                                            name="provinces[]"
                                            type="checkbox" value="{{$region->id}}"/>
                                        <label class="cbx" for="provinces{{$region->id}}">
<span>
<svg width="12px" height="9px" viewbox="0 0 12 9">
<polyline points="1 5 4 8 11 1"></polyline>
</svg>
</span>
                                            <span>{{$region->name}}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </fieldset>
                        </ul>
                    </section>
                    <noscript>
                        <button class="apply-filter-btn">
                            Appliquer les filtres
                        </button>
                    </noscript>
                </section>
            </form>
        </div>
    </section>
</div>
