<div>
    <form class="form-login form-register @if(!auth()->user())container-register-user @endif"
          enctype="multipart/form-data"
          aria-label="{!! __('messages.ads.arialabel')!!} role="form" method="POST"
          @auth action="{{ route('dashboard.update') }}" @elseauth action="{{ route('register') }}" @endauth>
        @csrf
        @auth
            @method('PUT')
        @endauth
            <div class="container-register-form container-register @if(!auth()->user()) container-form-registers @else edition-user-profil @endif">
                <div class="container-form-email">
                    <div class="avatar-container @if(auth()->user()) avatar-dashboard-profil @endif">
                        <label for="picture">{!! __('messages.dashboard_workerz.profil__picture')!!}</label>
                        <div class="container-profil-img">
                        <img @if(auth()->user() && auth()->user()->picture !== null) src="{{asset(auth()->user()->picture)}}" @elseif(auth()->user() && auth()->user()->picture == null) src="{{asset('svg/user.svg')}} @endif width="150" height="150" id="output" class="preview-picture preview-edit" alt="photo du commerce"/>
                        </div>
                    </div>
                    <input type="file"
                           id="picture" class="input-field @error('picture') is-invalid @enderror email-label"
                           name="picture"
                       accept=".jpg, .jpeg, .png, .svg, .webp">
                    <p class="help helppicture">{!! __('messages.format__accepted')!!} : jpg, png, jpeg ou svg</p>
                    <p class="helpSecond helppicture">{!! __('messages.length__max')!!} : 2048KO</p>
                    @error('picture')
                    <div class="container-error">
                        <span role="alert" class="error">
                            <strong>{{ ucfirst($message) }}</strong>
                        </span>
                    </div>
                    @enderror
                </div>

                <div class="container-form-email container-phone">
                    <label for="number">{!! __('messages.dashboard_workerz.nb__phone')!!} <span class="required">*</span></label>

                    <input minlength="7" maxlength="15" type="tel" id="number" pattern="^[0-9-+\s()]*$"
                           @if(auth()->user()) value="{{auth()->user()->phones()->first()->number}}"
                           @else value="{{old('number')}}"
                           @endif placeholder="0494827235"
                           class=" @error('number') is-invalid @enderror email-label" name="number" required
                           aria-required="true">
                    @error('number')
                    <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                    </div>
                    @enderror
                    @if(!auth()->user())
                        @if($plan == 1)
                            <p class="help"><a href="{{route('users.plans')}}#plans">{!! __('messages.upgrade_plan')!!}</a> {!! __('messages.upgrade__possibilityto3')!!}</p>
                        @endif
                        @if($plan == 2)
                            <p class="help">{!! __('messages.upgrade__to__2')!!}</p>
                        @endif
                        @if($plan == 3)
                            <p class="help">{!! __('messages.upgrade__to__3')!!}</p>
                        @endif
                    @endif

                </div>
                @if(auth()->user() && auth()->user()->plan_user_id ==2)
                    @if(auth()->user()->phones()->count() >= 1)
                    <div class="container-form-email">
                        <label for="phonetwo">2<sup>{!! __('messages.nd__word')!!}</sup> {!! __('messages.dashboard_workerz.nb__phone')!!}</label>
                        <input minlength="7" maxlength="15" type="tel" id="phonetwo" pattern="^[0-9-+\s()]*$"
                               placeholder="0494827235" value="{{auth()->user()->phones()->first()->number}}"

                               class=" @error('phone') is-invalid @enderror email-label" name="phonetwo">
                               </div>
                    @endif
                @endif
                @if(auth()->user() && auth()->user()->plan_user_id ==3)
                    <div class="container-form-email">
                        <label for="phonetwo">2<sup>{!! __('messages.nd__word')!!}</sup> {!! __('messages.dashboard_workerz.nb__phone')!!}</label>
                        <input minlength="7" maxlength="15" type="tel" id="phonetwo" pattern="^[0-9-+\s()]*$"
                               placeholder="0494827235"
                               @if(auth()->user()->phones()->count() > 1)
                               value="{{auth()->user()->phones()->first()->number}}"
                               @endif class=" @error('phone') is-invalid @enderror email-label" name="phonetwo">
                    </div>
                    <div class="container-form-email">
                        <label for="phonethree">3<sup>{!! __('messages.th__word')!!}</sup> {!! __('messages.dashboard_workerz.nb__phone')!!}</label>
                        <input minlength="7" maxlength="15" type="tel" id="phonethree" pattern="^[0-9-+\s()]*$"
                               placeholder="0494827235"
                               @if(auth()->user()->phones()->count() > 2)
                               value="{{auth()->user()->phones()->skip(1)->first()->number}}"
                               @endif
                               class=" @error('phone') is-invalid @enderror email-label" name="phonethree">
                    </div>
                @endif

                <div class="container-form-email">
                    <label for="name">{!! __('messages.contact.label__name')!!}<span class="required"> *</span></label>
                    <input type="text" id="name" @if(auth()->user()) value="{{auth()->user()->name}}"
                           @else value="{{old('name')}}"
                           @endif placeholder="Rotis"
                           class=" @error('name') is-invalid @enderror email-label" name="name" required
                           aria-required="true">
                    @error('name')
                    <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                    </div>
                    @enderror
                </div>
                <div class="container-form-email">
                    <label for="surname">{!! __('messages.contact.label__surname')!!}</label>
                    <input type="text" id="surname" placeholder="Daniel"
                           @if(auth()->user()) value="{{auth()->user()->surname}}"
                           @else value="{{old('surname')}}"
                           @endif
                           class=" @error('surname') is-invalid @enderror email-label" name="surname">
                </div>

                @include('partials.register')
            </div>

        <div>
            @if(!\Illuminate\Support\Facades\Auth::user())
                <input id="role_id" name="role_id" type="hidden" value="3">
                <input id="priceId" name="priceId" type="hidden" value="{{$plan}}">
                <input id="plan_user_id" name="plan_user_id" type="hidden" value="{{$plan}}">
                <input id="plan{{ $plan }}" name="plan" type="hidden" value="{{$plan}}">
                <input id="{{$planName}}" name="lookup_key" type="hidden" value="{{request('lookup_key')}}">
                <input type="hidden" name="type" value="user">
                <button role="button" class="button-cta" name="user" type="submit">
                    {!! __('messages.finish__sub')!!}
                </button>
            @else
                <button role="button" class="button-cta" name="user" type="submit">
                    {!! __('messages.save__info__btn')!!}
                </button>
            @endif
        </div>
    </form>
</div>
@auth
@section('scripts')
    @if(Session::get('applocale') === 'en')
        @if(auth()->user()->plan_user_id !== 1)
            <script>function confirmDelete(e){return!0===confirm("The payment will not be refunded, are you sure you want to change your plan?")||(e.preventDefault(),!1)}document.getElementById('changePlan').addEventListener("click",confirmDelete)</script>
        @endif
        @if($plan == 1)
            <script src="{{asset('js/en/checkDataMaxOptions.js')}}"></script>
        @endif
        @if($plan == 2)
            <script src="{{asset('js/en/checkDataMaxOptions2.js')}}"></script>
        @endif
        @if($plan == 3)
            <script src="{{asset('js/en/checkDataMaxOptions3.js')}}"></script>
        @endif
        <script src="{{asset('js/en/confirmDelete.js')}}"></script>
    @elseif(Session::get('applocale') === 'nl')
        @if(auth()->user()->plan_user_id !== 1)
            <script>function confirmDelete(e){return!0===confirm("De betaling wordt niet terugbetaald, weet u zeker dat u uw plan wilt wijzigen?")||(e.preventDefault(),!1)}document.getElementById('changePlan').addEventListener("click",confirmDelete)</script>
        @endif
        @if($plan == 1)
            <script src="{{asset('js/nl/checkDataMaxOptions.js')}}"></script>
        @endif
        @if($plan == 2)
            <script src="{{asset('js/nl/checkDataMaxOptions2.js')}}"></script>
        @endif
        @if($plan == 3)
            <script src="{{asset('js/nl/checkDataMaxOptions3.js')}}"></script>
        @endif
        <script src="{{asset('js/nl/confirmDelete.js')}}"></script>
    @else
        @if(auth()->user()->plan_user_id !== 1)
            <script>function confirmDelete(e){return!0===confirm("Le paiement ne sera pas rembourser, ??tes vous s??r de changer de plan ?")||(e.preventDefault(),!1)}document.getElementById('changePlan').addEventListener("click",confirmDelete)</script>
        @endif
        @if($plan == 1)
            <script src="{{asset('js/checkDataMaxOptions.js')}}"></script>
        @endif
        @if($plan == 2)
            <script src="{{asset('js/checkDataMaxOptions2.js')}}"></script>
        @endif
        @if($plan == 3)
            <script src="{{asset('jscheckDataMaxOptions3.js')}}"></script>
        @endif
        <script src="{{asset('js/confirmDelete.js')}}"></script>
    @endif

    <script src="{{asset('js/passwordCheck.js')}}"></script>
    <script src="{{asset('js/passwordSee.js')}}"></script>
    <script src="{{asset('js/previewPicture.js')}}"></script>
@endsection
@endauth
