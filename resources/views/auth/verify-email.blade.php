@extends('layouts.app')

@section('content')
    <div class="container-home">
        <section class="container-home_image">
            <div class="container-connexion">
                <h2 aria-level="2">{!! __('messages.auth.check__email__title')!!}</h2>
                <p>{!! __('messages.auth.check__email__text')!!}</p>
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

                    <div>
                        <form aria-label="{{ucfirst(__('messages.auth.email__title__h1'))!!}" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button class="button-cta" type="submit">
                                {!! __('messages.auth.resend__verify__email')!!}
                            </button>
                        </form>
                    </div>
                    <div>

                        <form aria-label="{!! __('messages.auth.logout')!!}" method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button class="button-cta">
                                {!! __('messages.auth.logout')!!}
                            </button>
                        </form>
                    </div>
            </div>

            <div class="container-svg">
                <img width="300" height="300" class="svg-icon" src="{{asset('svg/New_Message_Monochromatic.svg')}}"
                     alt="{!! __('messages.auth.alt__text__verify__email__img')!!}">
            </div>
        </section>
    </div>
    @if (session('status') == 'verification-link-sent')
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="{!! __('messages.good__answer')!!}">
            <p>{!! __('messages.auth.verify__msg__success')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
@endsection
