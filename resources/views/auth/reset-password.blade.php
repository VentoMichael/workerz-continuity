@extends('layouts.app')

@section('content')
    <div class="container-home">
        <section class="container-home_image">
            <div class="container-connexion">
                <h2 aria-level="2">{!! __('messages.auth.reset__password__title')!!}</h2>
                <p>{!! __('messages.auth.password__forget__text')!!}</p>
                <form aria-label="{!! __('messages.auth.reset__label__form')!!}" role="form" class="form-login" method="POST"
                      action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">
                    <div class="container-form-email notVisible">
                        <label for="email"
                        >{!! __('messages.auth.email__word')!!}</label>
                        <input id="email" type="email" class="email-label @error('email') is-invalid @enderror"
                               name="email" value="{{ request()->get('email') ?? old('email') }}" required
                               aria-required="true" autocomplete="email" autofocus>

                        @error('email')
                        <div class="container-error">
                            <span role="alert" class="error">
                                <strong>{{ ucfirst($message) }}</strong>
                            </span>
                        </div>
                        @enderror
                    </div>
                    <div class="container-form-email">
                        <label for="password"
                        >{!! __('messages.auth.password__word')!!}</label>
                        <input id="password" type="password"
                               class="email-label @error('password') is-invalid @enderror" name="password" required
                               aria-required="true"
                               autocomplete="new-password">
                        <div id="container-checkpass" class="container-checkpass">
                            <input type="checkbox" class="password--visibleToggle password-toggle-reset" id="checkPass"
                                   checked>
                            <div class="password--visibleToggle-eye eye-pass-reset eye-forget-pass open">
                                <img width="40" height="60" src="{{asset('svg/eye-open.svg')}}"
                                     alt="{!! __('messages.auth.icon__alt__see__password__open')!!}"/>
                            </div>
                            <div class="password--visibleToggle-eye eye-pass-reset eye-forget-pass close">
                                <img width="40" height="60" src="{{asset('svg/eye-close.svg')}}"
                                     alt="{!! __('messages.auth.icon__alt__see__password__close')!!}"/>
                            </div>
                        </div>
                        @error('password')

                        <div class="container-error">
                            <span role="alert" class="error">
                                <strong>{{ ucfirst($message) }}</strong>
                            </span>
                        </div>
                        @enderror
                    </div>
                    <div class="container-form-email">
                        <label for="password-confirm">{!! __('messages.auth.confirm__password')!!}</label>

                        <input id="password-confirm" type="password" class="email-label" name="password_confirmation"
                               required aria-required="true" autocomplete="new-password">
                    </div>
                    <ul role="list" class="list-password-required list-pass-reset">
                        <li id="cara">
                            <img width="40" height="60" src="{{asset('../svg/good.svg')}}"
                                 alt="{!! __('messages.good__answer')!!}">
                            <p role="listitem">
                                <span>&bull;</span> {!! __('messages.auth.caractere__word')!!}
                            </p>
                        </li>
                        <li id="maj">
                            <img width="40" height="60" src="{{asset('../svg/good.svg')}}"
                                 alt="{!! __('messages.good__answer')!!}">
                            <p role="listitem">
                                <span>&bull;</span> {!! __('messages.auth.maj__word')!!}
                            </p>
                        </li>
                        <li id="symbole">
                            <img width="40" height="60" src="{{asset('../svg/good.svg')}}"
                                 alt="{!! __('messages.good__answer')!!}">
                            <p role="listitem">
                                <span>&bull;</span> {!! __('messages.auth.chiffre__word')!!}
                            </p>
                        </li>
                        <li id="same">
                            <img width="40" height="60" src="{{asset('../svg/good.svg')}}"
                                 alt="{!! __('messages.good__answer')!!}">
                            <p role="listitem">
                                <span>&bull;</span> {!! __('messages.auth.same__word')!!}
                            </p>
                        </li>
                    </ul>

                    <div>
                        <button role="button" type="submit"
                                class="button-cta">
                            {!! __('messages.auth.reset__password')!!}
                        </button>
                    </div>
                </form>
            </div>

            <div class="container-svg">
                <img width="300" height="300" class="svg-icon" src="{{asset('svg/Settings_Monochromatic.svg')}}"
                     alt="{!! __('messages.auth.alt__text__password__img')!!}">
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/passwordCheck.js')}}"></script>
    <script>
        a = document.getElementById("password");
        c = document.getElementById("password-confirm");
        function checkPass(){
            var p = document.querySelector("#same p"),
                k = document.getElementById("same");
            a.value === c.value && a.value !== "" && c.value !== "" ?
                (p.classList.add("good"), p.style.transition = ".5s", p.style.alignItems = "center", k.style.display = "flex",
                    document.querySelector(".list-password-required li:nth-child(4) img").style.display = "inline") :
                (p.classList.remove("good"), document.querySelector(".list-password-required li:nth-child(4) img").style.display = "none")
        }
        c.addEventListener("keyup", function(){
            checkPass();
        })
        a.addEventListener("keyup", function(){
            checkPass();
        })
    </script>
    <script src="{{asset('js/passwordSee.js')}}"></script>
@endsection
