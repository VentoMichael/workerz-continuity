<div class="container-picture-title-dashboard-ads">
    @if($announcement->catchPhrase)
        <p class="container-ads-catch_phrase-dashboard">
            {{ucfirst($announcement->catchPhrase)}}
        </p>
    @endif
    <div class="container-picture-dashboard">
        @if($announcement->picture)
            <img itemprop="image" width="200" height="200" src="{{ asset($announcement->picture) }}"
                 alt="{!! __('messages.dashboard_workerz.profil__picture')!!} {{ucfirst($announcement->title)}}"/>
        @else
            <img itemprop="image" width="200" height="200" src="{{asset('svg/ad.svg')}}" alt="{!! __('messages.dashboard_workerz.icone__ads__alt')!!}">
        @endif
        <h3 aria-level="3">
            <span class="hidden">{!! __('messages.seleted__ad')!!}</span> {{ucfirst($announcement->title)}}
        </h3>
    </div>
    <p>
        {{ucfirst($announcement->description)}}
    </p>
</div>
<div class="container-perso-infos container-six-category-home container-six-ad" itemscope
     itemtype="https://schema.org/Person">
    <div>
        <img width="60" height="60" src="{{asset('svg/envelope.svg')}}" alt="{!! __('messages.dashboard_workerz.icon_mail')!!}">
        <a itemprop="email"
           href="mailto:{{$announcement->user->email}}">{{$announcement->user->email}}</a>
    </div>
    @foreach($announcement->user->phones as $up)
        @if($up->number != null)
            <div>
                <img width="60" height="60" src="{{asset('svg/phone.svg')}}" alt="{!! __('messages.icon__phone')!!}">
                <a itemprop="telephone" href="tel:{{$up->number}}">{{$up->number}}</a>
            </div>
        @endif
    @endforeach
    <div>
        <img width="60" height="60" src="{{asset('svg/calendar.svg')}}" alt="{!! __('messages.icon__calendar')!!}">
        <span>
                            {!! __('messages.for__month__word')!!} {{$announcement->startmonth->name}}
                        </span>
    </div>
    <div>
        <img width="60" height="60" src="{{asset('svg/suitcase.svg')}}" alt="{!! __('messages.ads.icone__wallet__livewire')!!}">
        <span class="job-cat-ads" itemprop="jobTitle">
                        <span>{{ucfirst($announcement->job)}}</span>
                        @if($announcement->categoryAds->count())
                <span class="categoryJob">
                                (@foreach($announcement->categoryAds as $a)
                        @if(Session::get('applocale') === 'en')
                        {{$a->name_en}}{{ ($loop->last ? '' : ', ') }}
                    @elseif(Session::get('applocale') === 'nl')
                        {{$a->name_nl}}{{ ($loop->last ? '' : ', ') }}
                    @else
                        {{$a->name}}{{ ($loop->last ? '' : ', ') }}
                    @endif
                    @endforeach)
                            </span>
            @endif
                        </span>
    </div>
    @if(!$announcement->pricemax)
        <div itemscope itemtype="https://schema.org/PriceSpecification">
            <img width="60" height="60" src="{{asset('svg/euro.svg')}}" alt="{!! __('messages.ads.icone__euro__livewire')!!}">
            <span itemprop="price">{!! __('messages.max__notdetermined')!!}</span>
        </div>
    @else
        <div itemscope itemtype="https://schema.org/PriceSpecification">
            <img width="60" height="60" src="{{asset('svg/euro.svg')}}" alt="{!! __('messages.ads.icone__euro__livewire')!!}">
            <span itemprop="price">{{ucfirst(__('messages.ads.max__euro__livewire'))}} : {{$announcement->pricemax}} €</span>
        </div>
    @endif
    <div itemscope itemtype="https://schema.org/PostalAddress">
        <img width="60" height="60" src="{{asset('svg/placeholder.svg')}}" alt="{!! __('messages.ads.icone__locality__livewire')!!}">
        <span>
                            @if($announcement->adress)
                <span itemprop="streetAddress">{{ucfirst($announcement->adress)}}</span>
            @endif
                                <span itemprop="addressRegion">{{ucfirst($announcement->province->name)}}</span>
                        </span>
    </div>
</div>
