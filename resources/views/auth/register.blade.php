@extends('layouts.app')
@section('content')
    @if($type == 'user' || $type == 'company' || $request->old('type') == 'user' || $request->old('type') == 'company')
        @if($type == 'company' || $request->type == 'company' || $request->old('type') == 'company')
            <div class="container-home">
                <section class="container-home_image">
                    <div class="container-connexion">
                        <h2 aria-level="2">{!! __('messages.auth.register__title')!!}</h2>
                        <p>{!! __('messages.auth.register__text')!!}</p>
                        @guest
                            <div>
                                <a class="button-cta" href="{{ route('login') }}">
                                    {!! __('messages.auth.register__already__account')!!}
                                </a>
                            </div>
                        @endguest
                    </div>
                    <div class="container-svg">
                        <img width="300" height="300" class="svg-icon" src="{{asset('svg/Waiting_Monochromatic.svg')}}"
                             alt="{!! __('messages.auth.register__alt__img')!!}">
                    </div>
                </section>
            </div>
        @endif
        @if($type == 'user' || $request->type == 'user' || $request->old('type') == 'user')
            <div class="container-home">
                <section class="container-home_image">
                    <div class="container-connexion">

                        <h2 aria-level="2">{!! __('messages.auth.register__title')!!}</h2>
                        <p>{!! __('messages.auth.register__text__second')!!}</p>
                        <div>
                            <a href="{{ route('login') }}">
                                <button role="button" class="button-cta" type="submit">
                                    {!! __('messages.auth.already__account__btn')!!}
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="container-svg">
                        <img width="300" height="300" class="svg-icon" src="{{asset('svg/Waiting_Monochromatic.svg')}}"
                             alt="{!! __('messages.auth.alt__img__waiting__register')!!}">
                    </div>
                </section>
            </div>
        @endif
    @endif
    <section class="container-form-register container-home">
        <div class="title-first-step-register">
            <h2 aria-level="2">{!! __('messages.auth.title__form__register')!!}</h2>
            @if($type == 'company' || $type == 'user' || $request->type == 'user' || $request->type == 'company' || $request->old('type') == 'user' || $request->old('type') == 'company')
                <p>{!! __('messages.auth.register__text__form')!!}</p>
            @endif
        </div>
        @if($type == 'company' || $type == 'user' || $request->type == 'user' || $request->type == 'company' || $request->old('type') == 'user' || $request->old('type') == 'company')
                <form action="{{route('users.type')}}" method="get">
                    @csrf
                    <input type="hidden" name="plan" value="{{request()->session()->get('plan')}}">
                    <button class="link-back button-back button-cta">
                        {!! __('messages.auth.register__btn__back')!!}
                    </button>
                </form>
        @endif

        @if($type == 'user' || $request->type == 'user' || $request->old('type') == 'user')
            @include('layouts.formUser')
        @endif
        @if($type == 'company' || $request->type == 'company' || $request->old('type') == 'company')
            @include('layouts.formCompany')
        @endif
    </section>
@endsection
@if($type == 'company' || $type == 'user' || $request->type == 'user' || $request->type == 'company' || $request->old('type') == 'user' || $request->old('type') == 'company')
@section('scripts')
    <script src="{{asset('js/passwordCheck.js')}}"></script>
    <script src="{{asset('js/passwordSee.js')}}"></script>
    <script src="{{asset('js/previewPicture.js')}}"></script>
    @if(Session::get('applocale') === 'en')
        @if($plan == 1 || $request->plan == 1)
            <script src="{{asset('js/en/checkDataMaxOptions.js')}}"></script>
        @endif
        @if($plan == 2 || $request->plan == 2)
            <script src="{{asset('js/en/checkDataMaxOptions2.js')}}"></script>
        @endif
        @if($plan == 3 || $request->plan == 3)
            <script src="{{asset('js/en/checkDataMaxOptions3.js')}}"></script>
        @endif
    @elseif(Session::get('applocale') === 'nl')
        @if($plan == 1 || $request->plan == 1)
            <script src="{{asset('js/nl/checkDataMaxOptions.js')}}"></script>
        @endif
        @if($plan == 2 || $request->plan == 2)
            <script src="{{asset('js/nl/checkDataMaxOptions2.js')}}"></script>
        @endif
        @if($plan == 3 || $request->plan == 3)
            <script src="{{asset('js/nl/checkDataMaxOptions3.js')}}"></script>
        @endif
    @else
        @if($plan == 1 || $request->plan == 1)
            <script src="{{asset('js/checkDataMaxOptions.js')}}"></script>
        @endif
        @if($plan == 2 || $request->plan == 2)
            <script src="{{asset('js/checkDataMaxOptions2.js')}}"></script>
        @endif
        @if($plan == 3 || $request->plan == 3)
            <script src="{{asset('js/checkDataMaxOptions3.js')}}"></script>
        @endif
    @endif
@endsection
@endif
