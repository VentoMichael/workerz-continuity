@extends('layouts.app')
@section('content')
    <section class="container-home margin">
        <div class="container-home_image container-home-page">
            <div class="container-about-text">
                <div class="container-home-text">
                    <h2 aria-level="2">
                        {!! __('messages.contact.title')!!}
                    </h2>
                    <p>
                        {!! __('messages.contact.text')!!}
                    </p>
                </div>
                @guest
                    @include('partials.btnInscription')
                @endguest
            </div>
            <div class="container-svg">
                <img width="150" height="150" src="{{asset('svg/us.svg')}}"
                     alt="{!! __('messages.contact.alt__text__img')!!}">
            </div>
        </div>
    </section>
    @if (Session::has('success-send'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="{!! __('messages.bad__answer')!!}">
            <p>{!!session('success-send')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <section class="container-categories-home margin container-message" id="form">
        <div class="container-categories-text-home">
            <h2 aria-level="2">
                {!! __('messages.contact.title__form')!!}
            </h2>
            <p>{!! __('messages.contact.text__form')!!}</p>
        </div>
        <div id="createMsg">
            <form class="show-content form-login form-register form-message"
                  aria-label="{!! __('messages.contact.label__form')!!}" role="form" method="POST"
                  action="{{ route('contact.store') }}">
                @csrf
                <div class="container-register-form">
                    <div class="container-form-email">
                        <label for="name">{!! __('messages.contact.label__name')!!} <span class="required">*</span></label>
                        <input type="text" id="name"
                               @if(\Illuminate\Support\Facades\Auth::check())
                               value="{{\Illuminate\Support\Facades\Auth::user()->name}}"
                               @else
                               value="{{ old('name') }}"
                               @endif
                               placeholder="Rotis"
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
                        <input type="text" id="surname"
                               @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->surname !== null) value="{{\Illuminate\Support\Facades\Auth::user()->surname}}"
                               @else value="{{ old('surname') }}" @endif placeholder="Daniel"
                               class=" @error('surname') is-invalid @enderror email-label" name="surname">
                    </div>
                </div>

                <div class="container-register-form">
                    <div class="container-form-email">
                        <label for="email">{!! __('messages.contact.label__email')!!} <span class="required">*</span></label>
                        <input id="email" type="email"
                               class=" @error('email') is-invalid @enderror email-label"
                               name="email"
                               value="@if(\Illuminate\Support\Facades\Auth::check()) {{\Illuminate\Support\Facades\Auth::user()->email}} @else {{ old('email') }} @endif"
                               placeholder="danielrotis@gmail.com" required aria-required="true" autocomplete="email">
                        @error('email')
                        <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                        </div>
                        @enderror
                    </div>
                    <div class="container-form-email">
                        <label for="subject">{!! __('messages.contact.label__subject')!!}<span class="required"> *</span></label>
                        <input type="text" placeholder="Engager un menuisier" id="subject" value="{{old("subject")}}"
                               class=" @error('subject') is-invalid @enderror email-label" name="subject" required
                               aria-required="true">
                        @error('subject')
                        <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="container-register-form container-textarea">
                    <div class="container-form-email">
                        <label for="message">{!! __('messages.contact.label__msg')!!} <span class="required">*</span></label>
                        <textarea id="message" name="message" required aria-required="true"
                                  class=" @error('message') is-invalid @enderror email-label"
                                  placeholder="{!! __('messages.contact.placeholder')!!}"
                                  rows="5" cols="33">{{old("message")}}</textarea>
                        @error('message')
                        <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="container-button">
                    <button role="button" class="button-cta" type="submit">
                        {!! __('messages.contact.label__btn__send')!!}
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
