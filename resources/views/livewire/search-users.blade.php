<div>
    <div class="container-form-search">
        <form aria-label="{!! __('messages.home.arialabel__form__search__user')!!}" role="search" action="{{route('workers')}}#workerzLink" method="get">
            <label for="search" class="hidden">{!! __('messages.home.label__form__search__user')!!}</label>
            <input type="search" spellcheck="false" placeholder="{!! __('messages.home.placeholder__form__search__user')!!}" wire:model="search" name="search" class="search-home" id="search">
            <input type="submit" class="submit-category-home" value="{!! __('messages.home.btn__form__search__user')!!}">
        </form>
            @if($helpText !== '') <span style="margin-top: 10px;">{!! __('messages.helpText')!!}</span>@endif
    </div>
    @if($search !== "" && strlen($search) >1)
        <div wire:loading.class="load" class="container-boxes">
            <div class="container-users-box">
                <ul>
                    <li class="container-all-users-boxes">
                        @forelse($workerz as $worker)
                            <a wire:loading.class="load" class="link-container-infos-user-box" href="/workers/{{$worker->slug}}">
                                <ul class="container-infos-user-box" itemscope
                         itemtype="https://schema.org/Person">
                                    <li>
                                        @if($worker->picture)
                                            <img class="user-img-box" src="{{ $worker->picture }}"
                                                 alt="{!! __('messages.alt__profil__img')!!} {{$worker->name}} @if($worker->surname) {{$worker->surname}} @endif">
                                        @else
                                            <img class="user-img-box" src="{{asset('svg/market.svg')}}"
                                                 alt="{!! __('messages.market__icon')!!}">
                                        @endif
                                    </li>
                                    <li>
                                        <span itemprop="affiliation">{{$worker->name}}</span>
<p itemprop="address" class="categoryJob">{{ucfirst($worker->job)}}</p>
                                    </li>
                                </ul>
                            </a>
                        @empty
                            <ul wire:loading.class="load" class="container-infos-user-box-no-data">
                                <li>
                                    <img width="40" height="60" class="user-img-box" src="{{asset('svg/not-found.svg')}}" alt="{!! __('messages.home.img__alt__no__users')!!}">
                                </li>
                                <li>
                                    <p>{!! __('messages.home.text__no__users')!!}
                                     <a style="text-decoration: underline;"
                                        href="{{route('workers')}}">{!! __('messages.home.link__no__users')!!}</a></p>
                                </li>
                            </ul>
                        @endforelse
                    </li>
                </ul>
            </div>
        </div>
    @endif
</div>
