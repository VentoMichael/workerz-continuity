@extends('layouts.appDashboard')
@section('content')
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-profil">
            <h2 aria-level="2">
                {!! __('messages.dashboard_workerz.profil__title')}}
            </h2>
            <div class="container-profil-dashboard">
                <div class="container-link-to-back container-change-plan">
                    <a class="link-back button-back button-cta button-draft" href="{{route('dashboard.profil')}}">
                        {!! __('messages.auth.register__btn__back')}}
                    </a>
                    @if(auth()->user())
                        <form action="{{route('users.plans')}}" method="get">
                            @csrf
                            <input type="hidden" name="changeCurrentPlan">
                            <button class="button-cta button-upgrade" id="changePlan">
                                {!! __('messages.dashboard_workerz.change__plan__btn')}}
                            </button>
                        </form>
                    @endif
                </div>
                @if(auth()->user()->role_id == 2)
                    @include('layouts.formCompany')
                @else
                    @include('layouts.formUser')
                @endif
            </div>
        </section>
    </div>
@endsection
