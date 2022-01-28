<div class="container-search-ads">
        <form action="{{route('dashboard.ads.showDraft',['announcement' => $firstAdDraft->slug]) }}" aria-label="{!! __('messages.dashboard_workerz.label__form__draft')!!}" role="search"
              method="get" class="formSearchAd">
            <label for="search" class="hidden"{!! __('messages.dashboard_workerz.label__form__draft')!!}></label>
            <input type="text" name="search" value="{{request('search')}}" id="search"
                   wire:model="search"
                   placeholder="{!! __('messages.dashboard_workerz.label__form__draft__title')!!}"
                   class="search-announcement search-home search-ads">
            <noscript>
                <button type="submit" class="button-cta submit-category-home submit-ad" >{!! __('messages.dashboard_workerz.btn__form__search__user')!!}</button>
            </noscript>
        </form>
    <div class="container-announcments-dashboard" wire:loading.class="load">
        @forelse($announcements as $announcement)
            <a class="{{ Request::is('dashboard/ads/draft/'.$announcement->slug) || Request::is('dashboard/ads/draft/'.$announcement->slug.'/*') ? "container-announcements-active" : "" }} container-announcements"
               href="{{asset('dashboard/ads/draft/'.$announcement->slug)}}"
               aria-current="{{ Request::is('dashboard/ads/*') ? "page" : "" }}">
                <section>
                    <img width="150" height="150" src="{{asset('svg/ad.svg')}}" alt="{!! __('messages.dashboard_workerz.icone__ads__alt')!!}">
                    <div>
                        <h3 aria-level="3">
                            {{$announcement->title}}
                        </h3>
                        <div class="container-view-ads">
                        <p class="view-counter">{{ $announcement->view_count }} @if($announcement->view_count >1 ){!! __('messages.dashboard_workerz.vues__word')!!} @else {!! __('messages.dashboard_workerz.vue__word')!!} @endif</p>
                        <p class="view-like">{{$announcement->likes ? : 0}} @if($announcement->likes == null || $announcement->likes <= 1){!! __('messages.dashboard_workerz.love__word')!!} @else {!! __('messages.dashboard_workerz.loves__word')!!} @endif</p>
                        </div>
                    </div>
                </section>
            </a>
        @empty
            <div class="container-announcements"
            >
                <section>
                    <img width="150" height="150" src="{{asset('svg/ad.svg')}}" alt="{!! __('messages.dashboard_workerz.icone__ads__alt')!!}">

                    <div>
                        <h3 aria-level="3">
                            {!! __('messages.dashboard_workerz.no__ads__found')!!}
                        </h3>
                        <a class="button-cta" href="{{route('announcements.create')}}">
                            {!! __('messages.dashboard_workerz.ads__words')!!}
                        </a>
                    </div>
                </section>
            </div>
        @endforelse
    </div>
</div>
