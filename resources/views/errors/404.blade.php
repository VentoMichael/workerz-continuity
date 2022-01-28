@extends('layouts.app')

@section('content')
    @php
        if (auth()->user()) {
                $notificationsReaded = auth()->user()->notifications->where('read_at', null);
            }else{
                $notificationsReaded = '';
            }
    @endphp
    <div class="container-home">
        <section class="container-home_image">
            <div class="container-connexion">
                <h2 aria-level="2">{!! __('messages.404.404__title')!!}</h2>
                <p>{!! __('messages.404.404_text')!!}@if(auth())<a href="{{route('home.index')}}"
                                                                               role="button">{!! __('messages.404.link__one')!!}</a> @else <a href="{{route('dashboard')}}" role="button">{!! __('messages.404.link__two')!!}</a> @endif </p>
            </div>
            <div class="container-svg">
                <img class="svg-icon" src="{{asset('svg/404.svg')}}"
                     alt="{!! __('messages.404.404__icone')!!}">
            </div>
        </section>
    </div>
@endsection
