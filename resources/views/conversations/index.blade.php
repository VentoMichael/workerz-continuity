@extends('layouts.appDashboard')
@section('content')
    @if (Session::has('success-delete'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/good.svg')}}" alt="{!! __('messages.good__answer')}}">
            <p>{!!session('success-delete')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('success'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/cross.svg')}}" alt="{!! __('messages.bad__answer')}}">
            <p>{!!session('success')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-ads">
            <h2 aria-level="2">
                {!! __('messages.conversation.title')}}
            </h2>
            <div class="container-form-ads container-form-msgs">
                <livewire:messenger>
                </livewire:messenger>
                <section class="container-profil-dashboard container-ads-dashboard">
                    <div class="container-picture-title-dashboard-ads">
                        <div class="container-picture-dashboard">
                            <h4 aria-level="4">
                                {!! __('messages.conversation.title__messenger')}}
                            </h4>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
@endsection
