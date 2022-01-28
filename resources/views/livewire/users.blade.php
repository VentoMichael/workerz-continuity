<div class="container-home container-search" id="workerzLink">
    @if(request('search') && count($workerz) === 0 && !$newsletterValidated || $search && count($workerz) === 0 && !$newsletterValidated)
        @include('partials.newsletter')
    @endif
    <div class="container-search hideForNewsletter">
        <form action="{{route('workers')}}" aria-label="{!! __('messages.home.arialabel__form__search__user')!!}" role="search" method="get"
              class="formSearchAd">
            <label for="search" class="hidden">{!! __('messages.home.arialabel__form__search__user')!!}</label>
            <input type="text" name="search" value="{{request('search')}}" id="search" wire:model="search"
                   placeholder="{!! __('messages.ads.job__search')!!}"
                   class="search-announcement search-home">
            <noscript>
                <input type="submit" class="submit-category-home submit-ad" value="{!! __('messages.ads.btn__send__form__livewire')!!}">
            </noscript>
        </form>
        @if($helpText !== '') <span style="margin-top: 10px;">{!! __('messages.helpText')!!}</span>@endif
    </div>
    <section class="container-announcements show-content hideForNewsletter" id="workerz-section">
        <h2 class="hidden" aria-level="2">
            {!! __('messages.conversation.all__companies')!!}
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
                                        <form method="POST" title="{!! __('messages.ads.label__put__like__livewire')!!} {{$worker->name}}"
                                              aria-label="{!! __('messages.ads.label__put__like__livewire')!!} {{$worker->name}}"
                                              action="/workers/{{$worker->slug}}/like">
                                            @csrf

                                            <button type="submit" class="button-loves">
                                                <img class="heart" src="{{asset('svg/heart.svg')}}"
                                                     alt="{!! __('messages.ads.label__put__like__livewire')!!} {{$worker->name}}">
                                                <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                                     alt="{!! __('messages.ads.label__put__alreadylike__livewire')!!} {{$worker->name}}">
                                                <span>
                                        {{$worker->likes ? : 0}}</span></button>
                                        </form>
                                    @else

                                        <form method="POST" title="{!! __('messages.ads.label__remove__like__livewire')!!} {{$worker->name}}"
                                              aria-label="{!! __('messages.ads.label__remove__like__livewire')!!} {{$worker->name}}"
                                              action="/workers/{{$worker->slug}}/like">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button-loves">
                                                <img class="heartFul heartLiked" src="{{asset('svg/heartFul.svg')}}"
                                                     alt="{!! __('messages.ads.label__remove__like__livewire')!!} {{$worker->title}}">
                                                <span>
                                        {{$worker->likes ? : 0}}</span></button>
                                        </form>
                                    @endif
                                </div>

                            @else
                                <form action="{{route('login')}}">
                                    <button style="border: none;max-height: inherit" name="registerRequired"
                                            title="{!! __('messages.ads.label__connexion__required__livewire')!!} {{$worker->name}}"
                                            class="containerPrice containerLove like-users like-index hepling helping-like help-show">
                                        <img class="heart" src="{{asset('svg/heart.svg')}}" alt="{!! __('messages.ads.label__empty__like__livewire')!!}">
                                        <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                             alt="{!! __('messages.ads.label__fullheart__like__livewire')!!}">
                                        <p>
                                            {{$worker->likes? : 0}}</p>
                                    </button>
                                </form>
                            @endauth
                        </div>
                        @if($worker->pricemax)
                            <div class="containerPrice" itemscope itemtype="https://schema.org/PriceSpecification">
                                <img src="{{asset('svg/euro.svg')}}" alt="{!! __('messages.ads.icone__euro__livewire')!!}">
                                <span itemprop="price">{{$worker->pricemax}} €/h</span>
                            </div>
                        @endif
                        <div class="container-image-announcement container-profil-img">
                            @if($worker->picture)
                                <img src="{{ $worker->picture }}"
                                     alt="{!! __('messages.ads.alt__profil__img')!!} {{$worker->name}} @if($worker->surname) {{$worker->surname}} @endif">
                            @else
                                <img src="{{asset('svg/market.svg')}}" alt="{!! __('messages.ads.icone__ads__alt')!!}">
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
                                    <img src="{{asset('svg/suitcase.svg')}}" alt="{!! __('messages.ads.icone__wallet__livewire')!!}">
                                    <div class="containerJobAds" itemprop="jobTitle">
                                        <p>{{ucfirst($worker->job)}}</p>
                                        @if($worker->categoryUser->count())
                                            <p class="categoryJob">
                                                (@foreach($worker->categoryUser as $w)@if(Session::get('applocale') === 'en'){{$w->name_en}}{{ ($loop->last ? ')' : ', ') }}@elseif(Session::get('applocale') === 'nl'){{$w->name_nl}}{{ ($loop->last ? ')' : ', ') }}@else{{$w->name}}{{ ($loop->last ? ')' : ', ') }}@endif @endforeach
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                @if($worker->adresses->count())
                                    <div class="container-info-announcement">
                                        <img src="{{asset('svg/placeholder.svg')}}" alt="{!! __('messages.ads.icone__locality__livewire')!!}">
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
                                        <button type="submit" class="formsendmsg formsenmsg-show-view-Notauth button-cta button-msg" title="{!! __('messages.ads.talk__text__livewire')!!} {{ucfirst($worker->name)}} {{ucfirst($worker->surname)}}" name="talkTo">
                                            {!! __('messages.ads.talk__text__livewire')!!} {{ucfirst($worker->name)}} {{ucfirst($worker->surname)}}
                                        </button>
                                    </form>
                                @endif
                            @else
                                <form action="{{route('login')}}">
                                    <button name="registerRequired"
                                            title="{!! __('messages.ads.connexion__required__talk')!!} {{ucfirst($worker->name)}} {{ucfirst($worker->surname)}}"
                                            class="formsendmsg formsenmsg-show-view-Notauth button-cta button-msg">
                                        {!! __('messages.ads.talk__with')!!} {{ucfirst($worker->name)}} {{ucfirst($worker->surname)}}
                                    </button>
                                </form>
                            @endauth
                        @endif
                        <a href="/workers/{{$worker->slug}}" title="{!! __('messages.ads.see__details__alt')!!}{{ucfirst($worker->name)}}" class="button-personnal-announcement">
                            {!! __('messages.ads.see__details__alt')!!}{{ucfirst($worker->name)}}
                        </a>
                    </div>
                </section>
            @empty
                <section wire:loading.class="load" class="container-announcement container-empty-ad">
                    <div class="container-infos-announcement">
                        <img src="{{asset('svg/not-found.svg')}}" alt="{!! __('messages.ads.light__alt__img')!!}">
                        <h3 aria-level="3">
                            {!! __('messages.no__indep__text')!!}
                        </h3>
                        <p class="containerAllText" style="margin-top: 10px;">
                            {!! __('messages.ads.no__ads__text__one')!!} @if($search){!! __('messages.ads.no__ads__text__two')!!} <i>"{{$search}}"</i>@endif&nbsp;!
                            {!! __('messages.ads.no__ads__text__three')!!} <a
                                style="text-decoration: underline;"
                                href="{{route('workers').'#adsLink'}}">{!! __('messages.ads.no__ads__text__fourth')!!}</a>
                        </p>
                    </div>
                </section>
            @endforelse
            {{ $workerz->links() }}
        </div>
        <div class="container-filters container-filters-workerz">
            <form aria-label="{!! __('messages.filtrage__ind')!!}" action="{{route('workers')}}" method="get">
                <section>
                    <h2 aria-level="2">
                        {!! __('messages.ads.title__filters')!!}
                    </h2>
                    <section class="container-filter-categories">
                        <h3 aria-level="3">
                            {!! __('messages.ads.title__category')!!}
                        </h3>
                        <ul class="list-categories">
                            <fieldset>
                                <legend class="hidden">{!! __('messages.ads.title__category')!!}</legend>
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
                                            @if(Session::get('applocale') === 'en')
                                                <span>{{$category->name_en}}</span>
                                            @elseif(Session::get('applocale') === 'nl')
                                                <span>{{$category->name_nl}}</span>
                                            @else
                                                <span>{{$category->name}}</span>
                                            @endif
                                        </label>
                                    </li>
                                @endforeach
                            </fieldset>
                        </ul>
                    </section>
                    <section class="container-filter-categories">
                        <h3 aria-level="3">
                            {!! __('messages.ads.title__region')!!}
                        </h3>
                        <ul class="list-categories">
                            <fieldset>
                                <legend class="hidden">{!! __('messages.ads.title__region')!!}</legend>
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
                                            @if(Session::get('applocale') === 'en')
                                                <span>{{$region->name_en}}</span>
                                            @elseif(Session::get('applocale') === 'nl')
                                                <span>{{$region->name_nl}}</span>
                                            @else
                                                <span>{{$region->name}}</span>
                                            @endif
                                        </label>
                                    </li>
                                @endforeach
                            </fieldset>
                        </ul>
                    </section>
                    <noscript>
                        <button class="apply-filter-btn">
                            {!! __('messages.ads.btn__filters')!!}
                        </button>
                    </noscript>
                </section>
            </form>
        </div>
    </section>
</div>
