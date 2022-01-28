@extends('layouts.app')
@section('content')
    @if (session('status'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="{!! __('messages.good__answer')!!}">
            <div class="alert alert-success" role="alert">
                <p>{{ session('status') }}</p>
            </div>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <div class="container-home">
        <section class="container-home_image">
            <div class="container-connexion">
                <h2 aria-level="2">{{ __('messages.auth.password__forget') }}</h2>
                <p>{{ __('messages.auth.password__forget__text') }}</p>
                <form aria-label="{{ __('messages.auth.label__form__reset') }}" class="form-login" role="form" method="POST"
                      action="{{ route('password.email') }}">
                    @csrf
                    <div class="container-form-email">
                        <label for="email"
                        >{{ __('messages.auth.adress__mail') }}</label>
                        <input id="email" type="email"
                               class="email-label @error('email') is-invalid @enderror"
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
                    <div>
                        <div class="inscription-links">
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}">
                                    {{ __('messages.link__connexion') }}
                                </a>
                            @endif
                            @if (Route::has('register'))
                                <a href="{{ route('users.plans') }}">
                                    {{ __('messages.link__inscription') }}
                                </a>
                            @endif
                        </div>
                        <button role="button" type="submit"
                                class="button-cta">
                            {{ __('messages.recup__password') }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="container-svg">
                <img width="300" height="300" class="svg-icon" src="{{asset('svg/Password_Monochromatic.svg')}}"
                     alt="{{ __('messages.auth.alt__img') }}">
            </div>
        </section>
    </div>
@endsection
