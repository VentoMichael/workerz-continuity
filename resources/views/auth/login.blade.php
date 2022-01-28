@extends('layouts.app')

@section('content')
    @if (Session::has('messageBanned'))
        <div width="40" height="60" id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/good.svg')}}" alt="{!! __('messages.good__answer')!!}">
            <p>{!!session('messageBanned')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('register'))
        <div width="40" height="60" id="successMsg" role="alert" class="successMsg"><img style="max-width: 50px;" src="{{asset('svg/question-signe-en-cercles.svg')}}" alt="{{ __('messages.question__mark') }}">
            <p>{!!session('register')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('forbidden'))
        <div width="40" height="60" id="successMsg" role="alert" class="successMsg"><img style="max-width: 50px;" src="{{asset('svg/question-signe-en-cercles.svg')}}" alt="{!! __('messages.question__mark')!!}">
            <p>{!!session('forbidden')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('success-update'))
        <div width="40" height="60" id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/good.svg')}}" alt="{!! __('messages.good__answer')!!}">
            <p>{!!session('success-update')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif

    @if (Session::has('success-inscription'))
        <div width="40" height="60" id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/question-signe-en-cercles.svg')}}" alt="{!! __('messages.question__mark')!!}">
            <p>{!!session('success-inscription')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <div class="container-home">
        <section class="container-home_image">
            <div class="container-connexion">
                <h2 aria-level="2">{!! ucfirst(__('messages.login__title__h1'))!!}</h2>
                <p>{!! __('messages.auth.see__news')!!}</p>
                <form class="form-login" aria-label="{!! ucfirst(__('messages.login__title__h1')) !!}" role="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="container-form-email">
                        <label for="email"
                        >Adresse email</label>
                        <input id="email" type="email"
                               class="@error('email') is-invalid @enderror email-label"
                               name="email" value="{{ old('email') }}" required aria-required="true" autocomplete="email"
                               autofocus>

                        @error('email')
                        <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                        </div>
                        @enderror
                    </div>

                    <div class="container-login-password">

                        <label for="password"
                        >{!! __('messages.auth.password__word')!!}</label>
                        <div class="@error('password')is-invalid @enderror password">
                            <div id="container-checkpass" class="container-checkpass">
                                <label for="checkPass" class="hidden">{!! __('messages.auth.see__hide__password')!!}</label>
                                <input type="checkbox" tabindex="1" class="password--visibleToggle" id="checkPass" checked>
                                <div class="password--visibleToggle-eye open">
                                    <img width="40" height="40" src="{{asset('svg/eye-open.svg')}}" alt="{!! __('messages.auth.icon__alt__see__password__open')!!}"/>
                                </div>
                                <div class="password--visibleToggle-eye close">
                                    <img width="40" height="40" src="{{asset('svg/eye-close.svg')}}" alt="{!! __('messages.auth.icon__alt__see__password__close')!!}"/>
                                </div>
                            </div>

                            <input id="password" type="password" placeholder="Xxxxxxx1"
                                   class="password--input"
                                   name="password" required aria-required="true">

                            @error('password')
                            <div class="container-error">
                                    <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <div class="inscription-links">
                            @if (Route::has('register'))
                                <a href="{{ route('users.plans') }}">
                                    {!! __('messages.link__inscription')!!}
                                </a>
                            @endif
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    {!! __('messages.auth.password__forget')!!}
                                </a>
                            @endif
                        </div>
                        <div>
                            <button role="button" class="button-cta" type="submit">
                                {!! __('messages.link__connexion')!!}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="container-svg">
                <img width="300" height="300" class="svg-icon" src="{{asset('svg/Innovation_Monochromatic.svg')}}"
                     alt="{!! __('messages.icon__ampoul')!!}">
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/passwordSee.js')}}"></script>
@endsection
