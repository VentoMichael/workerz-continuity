<div id="adsLink">
    @if(request('search') && count($announcements) === 0 && !$newsletterValidated || $search && count($announcements) === 0 && !$newsletterValidated)
        @include('partials.newsletter')
    @endif
    <div class="container-home container-search hideForNewsletter">
        <form action="{{route('announcements')}}" aria-label="{!! __('messages.ads.label__form__livewire')!!}" role="search" method="get"
              class="formSearchAd">
            <label for="search" class="hidden">{!! __('messages.ads.label__form__livewire')!!}</label>
            <input type="text" name="search" value="{{request('search')}}" id="search" wire:model="search"
                   placeholder="{!! __('messages.ads.placeholder__form__livewire')!!}"
                   class="search-announcement search-home">
            <noscript>
                <input type="submit" class="submit-category-home submit-ad" value="{!! __('messages.ads.btn__send__form__livewire')!!}">
            </noscript>
        </form>
        @if($helpText !== '') <span style="margin-top: 10px;">{!! __('messages.helpText')!!}</span>@endif
    </div>
    <section class="container-home container-announcements hideForNewsletter">
        <h2 class="hidden" aria-level="2">
            {!! __('messages.ads.title__livewire')!!}
        </h2>
        <div class="container-all-announcement show-content @if($announcements->count() < 1)noAds @endif">
            @forelse($announcements as $announcement)
            
                <section class="container-announcement" wire:loading.class="load" itemtype="https://schema.org/Thing"
                         itemscope>
                    <div class="container-infos-announcement">
                        <div class="container-love-show">
                            @auth
                                <div
                                    class="containerPrice container-show-love like-users-connected like-index containerLove help-show @guest notHoverHeart @endguest">
                                    @if(!$announcement->isLikedBy($user))
                                        <form method="POST" title="{!! __('messages.ads.label__put__like__livewire')!!} {{$announcement->title}}"
                                              aria-label="{!! __('messages.ads.label__put__like__livewire')!!} {{$announcement->title}}"
                                              action="/announcements/{{$announcement->slug}}/like">
                                            @csrf

                                            <button type="submit" class="button-loves">
                                                <img class="heart" src="{{asset('svg/heart.svg')}}"
                                                     alt="{!! __('messages.ads.label__put__like__livewire')!!} {{$announcement->title}}">
                                                <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                                     alt="{!! __('messages.ads.label__put__alreadylike__livewire')!!} {{$announcement->title}}">
                                                <span>
                                        {{$announcement->likes ? : 0}}</span></button>
                                        </form>
                                    @else

                                        <form method="POST" title="{!! __('messages.ads.label__remove__like__livewire')!!} {{$announcement->title}}"
                                              aria-label="{!! __('messages.ads.label__remove__like__livewire')!!} {{$announcement->title}}"
                                              action="/announcements/{{$announcement->slug}}/like">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button-loves">
                                                <img class="heartFul heartLiked" src="{{asset('svg/heartFul.svg')}}"
                                                     alt="{!! __('messages.ads.label__remove__like__livewire')!!} {{$announcement->title}}">
                                                <span>
                                        {{$announcement->likes ? : 0}}</span></button>
                                        </form>
                                    @endif
                                </div>
                            @else
                            
                                <form action="{{route('login')}}">
                                    <button style="border: none;max-height: inherit" name="registerRequired"
                                            title="{!! __('messages.ads.label__connexion__required__livewire')!!} {{$announcement->title}}"
                                            class="containerPrice containerLove like-users like-index hepling helping-like help-show">
                                        <img class="heart" src="{{asset('svg/heart.svg')}}" alt="{!! __('messages.ads.label__empty__like__livewire')!!}">
                                        <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                             alt="{!! __('messages.ads.label__fullheart__like__livewire')!!}">
                                        <p>
                                            {{$announcement->likes? : 0}}</p>
                                    </button>
                                </form>
                            @endauth
                        </div>
                        @if($announcement->pricemax)
                            <div class="containerPrice">
                                <img src="{{asset('svg/euro.svg')}}" alt="{!! __('messages.ads.icone__euro__livewire')!!}"><span>{!! __('messages.ads.max__euro__livewire')!!} : {{$announcement->pricemax}}€</span>
                            </div>
                        @endif
                        <div class="container-image-announcement container-profil-img">
                            @if($announcement->picture)
                                <img itemprop="image" src="{{ asset($announcement->picture) }}"
                                     alt="{!! __('messages.ads.alt__profil__img')!!} {{$announcement->title}}"/>
                            @else
                                <img itemprop="image" src="{{asset('svg/ad.svg')}}" alt="{!! __('messages.ads.icone__ads__alt')!!}">
                            @endif
                        </div>
                        <div class="container-description-Ads">
                            <h3 aria-level="3" itemprop="name" id="ad{{$announcement->id}}">
                                {{ucfirst($announcement->title)}}
                            </h3>
                            <p class="paragraph-ann" itemprop="description">
                                {{ucfirst($announcement->description)}}
                            </p>
                            <div class="container-infos">
                                <div class="container-info-announcement">
                                    <img src="{{asset('svg/suitcase.svg')}}" alt="{!! __('messages.ads.icone__wallet__livewire')!!}">
                                    <div class="containerJobAds">
                                        <p>
                                            {{ucfirst($announcement->job)}} @if($announcement->categoryAds->count())
                                                <span class="categoryJob">
                                                (@foreach($announcement->categoryAds as $a) @if(Session::get('applocale') === 'en')
                                                        {{$a->name_en}}{{ ($loop->last ? '' : ', ') }}
                                                    @elseif(Session::get('applocale') === 'nl')
                                                        {{$a->name_nl}}{{ ($loop->last ? '' : ', ') }}
                                                    @else
                                                        {{$a->name}}{{ ($loop->last ? '' : ', ') }}
                                                    @endif
                                                @endforeach)
                                            </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="container-info-announcement" itemtype="https://schema.org/PostalAddress"
                                     itemscope>
                                    <img src="{{asset('svg/placeholder.svg')}}" alt="{!! __('messages.ads.icone__locality__livewire')!!}">
                                    <div>
                                        @if($announcement->adress)
                                            <p itemprop="streetAddress">{{$announcement->adress}}</p>
                                        @endif
                                        <p itemprop="addressRegion">
                                            {{ucfirst($announcement->province->name)}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        @if(auth()->id() !== $announcement->user_id)
                            @auth
                                @if($announcement)
                                    <form action="{{route('messages.post',[$announcement->user->slug])}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="from_id" id="from_id{{$loop->index}}"
                                               value="{{auth()->user()->id}}">
                                        <input type="hidden" name="to_id" id="to_id{{$loop->index}}"
                                               value="{{$announcement->user->id}}">
                                        <input type="hidden" name="slug" id="slug{{$loop->index}}"
                                               value="{{$announcement->user->slug}}">
                                        <button type="submit" title="{!! __('messages.ads.talk__text__livewire')!!} {{ucfirst($announcement->user->name)}} {{ucfirst($announcement->user->surname)}}"
                                                class="formsendmsg formsenmsg-show-view-Notauth button-cta formsenmsg-show-view button-personnal-announcement-talk" name="talkTo">
                                            {!! __('messages.ads.talk__text__livewire')!!}{{ucfirst($announcement->user->name)}} {{ucfirst($announcement->user->surname)}}
                                        </button>
                                    </form>
                                @endif
                            @else
                                <form action="{{route('login')}}">
                                    <button name="registerRequired"
                                            title="{!! __('messages.ads.connexion__required__talk__ad')!!}"
                                            class="formsendmsg formsenmsg-show-view-Notauth button-cta formsenmsg-show-view button-personnal-announcement-talk">
                                        {!! __('messages.ads.talk__with')!!}
                                    </button>
                                </form>
                            @endauth
                        @endif
                        <a href="/announcements/{{$announcement->slug}}" title="{!! __('messages.ads.see__details__alt')!!}{{$announcement->title}}" class="button-personnal-announcement">
                            {!! __('messages.ads.see__details__alt')!!}{{$announcement->title}}
                        </a>
                    </div>
                </section>
            @empty
                <section wire:loading.class="load" class="container-announcement container-empty-ad">
                    <div class="container-infos-announcement">
                        <img src="{{asset('svg/not-found.svg')}}" alt="{!! __('messages.ads.light__alt__img')!!}">
                        <h3 aria-level="3">
                            {!! __('messages.ads.no__ads__text')!!}
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
            {{ $announcements->links() }}
        </div>
        <div class="container-filters container-filters-workerz">
            <form aria-label="{!! __('messages.filtrage__ad')!!}" action="{{route('announcements')}}" method="get">
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
                                            @if(request('categoryAds') && in_array($category->id,request('categoryAds'))) checked
                                            @else wire:model="categoryAds" @endif class="inp-cbx hiddenCheckbox"
                                            id="categoryAds{{$category->id}}"
                                            name="categoryAds[]"
                                            type="checkbox" value="{{$category->id}}"/>
                                        <label class="cbx" for="categoryAds{{$category->id}}">
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
                                            @if(request('province') && in_array($region->id,request('province'))) checked
                                            @else wire:model="province" @endif role="checkbox"
                                            aria-checked="false" class="hiddenCheckbox inp-cbx"
                                            id="province{{$region->id}}"
                                            name="province[]"
                                            type="checkbox" value="{{$region->id}}"/>
                                        <label class="cbx" for="province{{$region->id}}">
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
                        <button type="submit" class="apply-filter-btn">
                            {!! __('messages.ads.btn__filters')!!}
                        </button>
                    </noscript>
                </section>
            </form>
        </div>
    </section>
</div>
@section('scripts')
    @livewireScripts
    <script src="{{asset('js/newsletter.js')}}"></script>
@endsection
