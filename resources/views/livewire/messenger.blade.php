<div
    class="@if($users->count() < 1) no-Users @endif container-search-ads @if(Request::is('dashboard/messages')) container-messenger-form @endif">
        <form action="{{$firstUser->slug.request('search')}}" aria-label="{!! __('messages.conversation.label__form')!!}" role="search"
              method="get" class="formSearchAd submit-msg">
            <label for="search" class="hidden">{!! __('messages.conversation.label__form')!!}</label>
            <input type="text" name="search" value="{{request('search')}}" id="search"
                   wire:model="search"
                   placeholder="{!! __('messages.conversation.search__by__name')!!}"
                   class="search-announcement search-home search-ads">
            <input type="hidden" name="firstAd" value="{{$firstUser->slug}}">
            <noscript>
                <button type="submit" class="button-cta submit-category-home submit-ad submit-msg">{!! __('messages.home.btn__form__search__user')!!}</button>
            </noscript>
        </form>
    <div class="container-announcments-dashboard @if($users->count() < 1)container-search-without-ads @endif"
         wire:loading.class="load">
        @forelse($users as $user)
            <div class="container-message-index">
                <a class="{{ Request::is('dashboard/messages/'.$user->slug) || Request::is('dashboard/messages/'.$user->slug.'/*') ? "container-announcements-active" : "" }} container-announcements"
                   href="{{route('dashboard.messagesShow',[$user->slug])}}"
                   aria-current="{{ Request::is('dashboard/messages/*') ? "page" : "" }}">
                    <section>
                        <img width="50" height="50" src="{{asset('svg/messenger.svg')}}" alt="{!! __('messages.conversation.icon__msg__alt')!!}">
                    @if(count($user->relatedTo->where('is_read',0)) > 0 && count($user->relatedTo->where('is_read',0)) > 9 && $user->relatedTo->where('content','!=', null))
                            <span class="counter-read-message">
                                    9+
                                </span>
                        @else
                            @if(count($user->relatedTo->where('is_read',0)) !== 0 )
                                <span class="counter-read-message">
                                    {{count($user->relatedTo->where('is_read',0)->where('to_id','!=',ucfirst($user->name))->where('content','!==',null))}}
                                </span>
                            @endif
                        @endif
                        <div>
                            <h3 aria-level="3">
                                {{ucfirst($user->name)}} {{ucfirst($user->surname)}}
                            </h3>
                            @if($user->role_id === 2)
                                <p>
                                    {{$user->job}}
                                </p>
                            @else
                                <p>
                                    {{$user->job}}
                                </p>
                            @endif
                        </div>
                    </section>
                </a>
                <form action="{{route('delete.conversations',$user->slug)}}" class="form-delete-msg" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="button-delete-msg" title="{!! __('messages.conversation.delete__conv')!!}{{$user->name}}">
                        {!! __('messages.conversation.delete_conv__word')!!}
                    </button>
                </form>
            </div>
        @empty
            <div class="container-announcements container-msg-notFound" style="margin: 0;padding: 5% 3%;">
                <section>
                    <img width="50" height="50" src="{{asset('svg/market.svg')}}" alt="{!! __('messages.conversation.icon__msg__alt')!!}">

                    <div>
                        <h3 aria-level="3">
                            {!! __('messages.conversation.text__conv__empty')!!}
                        </h3>
                        <a class="button-cta" href="{{route('workers')}}">
                            <span>{!! __('messages.conversation.all__companies')!!}</span>
                        </a>
                    </div>
                </section>
            </div>
        @endforelse
    </div>
</div>
@if($users->count())
@section('scripts')
    @if(Session::get('applocale') === 'en')
        <script src="{{asset('js/en/confirmDelete-msg.js')}}"></script>
    @elseif(Session::get('applocale') === 'nl')
        <script src="{{asset('js/nl/confirmDelete-msg.js')}}"></script>
    @else
        <script src="{{asset('js/confirmDelete-msg.js')}}"></script>
    @endif
    <script src="{{asset('js/sendForm.js')}}"></script>
    @livewireScripts
@endsection
@endif
