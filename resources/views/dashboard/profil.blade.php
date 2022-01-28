@extends('layouts.appDashboard')
@section('content')
    @if (Session::has('expire'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60"
                                                                  src="{{asset('svg/caution.svg')}}"
                                                                  alt="{!! __('messages.good__answer')}}">
            <p>{!!session('expire')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('success-update-not'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60"
                                                                  src="{{asset('svg/cross.svg')}}"
                                                                  alt="{!! __('messages.bad__answer')}}">
            <p>{!!session('success-update-not')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('success-update'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}"
                                                                  alt="{!! __('messages.good__answer')}}">
            <p>{!!session('success-update')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('success-inscription'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}"
                                                                  alt="{!! __('messages.good__answer')}}">
            <p>{!!session('success-inscription')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-profil container-profils-infos">
            <h2 aria-level="2">
                {!! __('messages.dashboard_workerz.profil__title')}}
            </h2>
            <div class="container-profil-dashboard">
                @if(auth()->user()->end_plan != null)
                    @if(auth()->user())
                        <form action="{{route('users.plans')}}" method="get">
                            @csrf
                            <input type="hidden" name="changeCurrentPlan">
                            <button class="button-cta button-upgrade" id="changePlan">
                                {!! __('messages.dashboard_workerz.change__plan')}}
                            </button>
                        </form>
                    @endif
                @endif
                @if(auth()->user()->end_plan == null)
                    <div class="container-button-expire">
                        <a href="{{route('usersAlready.plans')}}" class="button-cta button-expire">
                            {!! __('messages.dashboard_workerz.choose__plan')}}
                        </a>
                    </div>
                @endif
                @if(auth()->user()->role_id == 2)
                    <div @if(auth()->user()->end_plan == null) class="expire-plan" @endif>
                        <section class="container-infos-dashboard">
                            <h3 aria-level="3">
                                {!! __('messages.dashboard_workerz.personnal__info')}}
                            </h3>
                            <div class="form-login form-edit-company form-register form-edit-preview">
                                <div class="container-register-form container-register">
                                    <div class="container-form-email">
                                        <div class="avatar-container">
                                            <div class="container-form-email avatar-profil avatar-dashboard">
                                                <div class="avatar-container">
                                                    <p>Logo</p>
                                                </div>
                                                <div class="container-profil-img container-profil-img">
                                                    @if(auth()->user()->picture != null)
                                                        <img width="150" height="150"
                                                             src="{{asset(auth()->user()->picture)}}"
                                                             alt="logo {!! __('messages.of__word')}} {{auth()->user()->name}}">
                                                    @else
                                                        <img width="150" height="150" src="{{asset('svg/user.svg')}}"
                                                             alt="{!! __('messages.alt__profil__img__default')}}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @if(auth()->user()->end_plan != null)
                                    <div class="container-form-email">
                                        <p>{!! __('messages.dashboard_workerz.plan__word')}} : {{$plan->name}}</p>
                                        <span
                                            class="email-label">{!! __('messages.dashboard_workerz.renouvellement__to')}}{{auth()->user()->end_plan->locale('en')->addHours(4)->addHours(4)->isoFormat('Do MMMM YYYY, H:mm')}}</span>
                                    </div>
                                @else
                                    <div class="container-form-email">
                                        <p>{!! __('messages.dashboard_workerz.plan__word')}}</p>
                                        <span class="email-label required">{!! __('messages.dashboard_workerz.expired__word')}}</span>
                                    </div>
                                @endif
                                @if(auth()->user()->catchPhrase)
                                    <div class="container-form-email">
                                        <p>{!! __('messages.dashboard_workerz.sentence__accroche')}}</p>
                                        <span class="email-label">{{ucfirst(auth()->user()->catchPhrase)}}</span>
                                    </div>
                                @endif
                                <div class="container-form-email">
                                    <p>{!! __('messages.dashboard_workerz.nb__phone')}}</p>
                                    <span
                                        class="email-label">{{chunk_split(auth()->user()->phones()->first()->number, 4, ' ')}}</span>
                                </div>
                                @if(auth()->user()->phones()->count() > 1 && auth()->user()->phones()->skip(1)->first()->number != null)
                                    <div class="container-form-email">
                                        <p>2<sup>{!! __('nd__word')}}</sup> {!! __('messages.dashboard_workerz.nb__phone')}}</p>
                                        <span
                                            class="email-label">{{chunk_split(auth()->user()->phones()->skip(1)->first()->number, 4, ' ')}}</span>
                                    </div>
                                @endif
                                @if(auth()->user()->phones()->count() > 2 && auth()->user()->phones()->skip(2)->first()->number != null)
                                    <div class="container-form-email">
                                        <p>3<sup>{!! __('th__word')}}</sup> {!! __('messages.dashboard_workerz.nb__phone')}}</p>
                                        <span
                                            class="email-label">{{chunk_split(auth()->user()->phones()->skip(2)->first()->number, 4, ' ')}}</span>
                                    </div>
                                @endif
                                <div class="container-register-form container-register">
                                    <div class="container-form-email">
                                        <p>{!! __('messages.dashboard_workerz.company__name')}}</p>
                                        <span class="email-label">{{ucfirst(auth()->user()->name)}}</span>
                                    </div>
                                    @if(auth()->user()->possibily_job == 'no' || auth()->user()->possibily_job == 'yes')
                                        <p>{!! __('messages.dashboard_workerz.possibility__job__company')}}</p>
                                        @if(auth()->user()->possibily_job == 'no')
                                            <div class="container-form-email">
                                                <span>{!! __('messages.dashboard_workerz.possibility__no')}}</span>
                                            </div>
                                        @else
                                            <div class="container-form-email">
                                                <span>{!! __('messages.dashboard_workerz.possibility__yes')}}</span>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="container-register-form container-register">
                                    <div class="container-form-email">
                                        <p>{!! __('messages.dashboard_workerz.social__adress')}}</p>
                                        <span class="email-label">{{ucfirst(auth()->user()->adresses()->first()->postal_adress)}}, ({{auth()->user()->adresses()->first()->province()->first()->name}})</span>
                                    </div>
                                </div>
                                @if(auth()->user()->adresses()->count() > 1 && auth()->user()->adresses()->skip(1)->first()->postal_adress != null)
                                    <div class="container-form-email">
                                        <p>2<sup>{!! __('nd__word')}}</sup> {!! __('messages.dashboard_workerz.postal__adress')}}</p>
                                        <span
                                            class="email-label">{{ucfirst(auth()->user()->adresses()->skip(1)->first()->postal_adress)}}, ({{auth()->user()->adresses()->skip(1)->first()->province()->first()->name}})</span>
                                    </div>
                                @endif
                                @if(auth()->user()->adresses()->count() > 2 && auth()->user()->adresses()->skip(2)->first()->postal_adress != null)
                                    <div class="container-form-email">
                                        <p>3<sup>{!! __('th__word')}}</sup> {!! __('messages.dashboard_workerz.postal__adress')}}</p>
                                        <span
                                            class="email-label">{{ucfirst(auth()->user()->adresses()->skip(2)->first()->postal_adress)}}, ({{auth()->user()->adresses()->skip(2)->first()->province()->first()->name}})</span>
                                    </div>
                                @endif
                                @if(auth()->user()->website)
                                    <div class="container-form-email">
                                        <p>{{ucfirst(__('messages.dashboard_workerz.website__word'))}}</p>
                                        <span class="email-label">{{auth()->user()->website}}</span>
                                    </div>
                                @endif
                                @if(auth()->user()->websites()->count() > 0 && auth()->user()->websites()->first()->link)
                                    <div class="container-form-email">
                                        <p>2<sup>{!! __('nd__word')}}</sup> {!! __('messages.dashboard_workerz.website__word')}}</p>
                                        <span class="email-label">{{auth()->user()->websites()->first()->link}}</span>
                                    </div>
                                    @if(auth()->user()->websites()->count() > 1 && auth()->user()->websites()->skip(1)->first()->link != null)
                                        <div class="container-form-email">
                                            <p>3<sup>{!! __('th__word')}}</sup> {!! __('messages.dashboard_workerz.website__word')}}</p>
                                            <span
                                                class="email-label">{{auth()->user()->websites()->skip(1)->first()->link}}</span>
                                        </div>
                                    @endif
                                @endif
                                @if(auth()->user()->startDate()->count())

                                    <div class="container-form-email selectdiv">
                                        <p>{!! __('messages.dashboard_workerz.disponibility')}}</p>
                                        <div
                                            class="container-filter-categories container-category container-profil-cat">
                                            <ul class="list-categories list-checkboxes-register">
                                                <li class="email-label">
                                                    @foreach($disponibilities as $disponibility)
                                                        <span>
                                                            @if(Session::get('applocale') === 'en')
                                                                {{$disponibility->name_en}}
                                                            @elseif(Session::get('applocale') === 'nl')
                                                                {{$disponibility->name_nl}}
                                                            @else
                                                                {{$disponibility->name}}
                                                            @endif
                                                </span>
                                                    @endforeach
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                <div class="container-register-form container-register container-job-dashboard">
                                    <div class="container-form-email">
                                        <p>{!! __('messages.dashboard_workerz.job')}}</p>
                                        <span class="email-label">{{ucfirst(auth()->user()->job)}}</span>
                                    </div>
                                </div>
                                <div class="container-form-email selectdiv">
                                    <p>{!! __('messages.dashboard_workerz.category')}}</p>
                                    <div class="container-filter-categories container-category container-profil-cat">
                                        <ul class="list-categories list-checkboxes-register">
                                            <li class="email-label">
                                                @foreach($categories as $c)
                                                    <span>
                                                        @if(Session::get('applocale') === 'en')
                                                            {{$c->name_en}}
                                                        @elseif(Session::get('applocale') === 'nl')
                                                            {{$c->name_nl}}
                                                        @else
                                                            {{$c->name}}
                                                        @endif
                                                            <span
                                                            class="bar-dividend">{{ ($loop->last ? '' : ' | ') }}</span>
                                                </span>
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @if(auth()->user()->pricemax)
                                    <div class="container-form-email" style="    align-self: baseline;">
                                        <p>{!! __('messages.dashboard_workerz.horary__price')}}</p>
                                        <span class="email-label">{{auth()->user()->pricemax}}</span>
                                        <span class="horary-cost horary-profil">€/h</span>
                                    </div>
                                @endif

                                <div class="container-register-form container-register">
                                    <div class="container-form-email">
                                        <p>{!! __('messages.dashboard_workerz.description')}}</p>
                                        <span>
                                    <p style="color: black"
                                       class="email-label">{{ucfirst(auth()->user()->description)}}</p></span>
                                    </div>
                                </div>
                            </div>
                        </section>
                        @if(auth()->user()->facebook != null || auth()->user()->twitter != null || auth()->user()->linkedin != null || auth()->user()->instagram != null)
                            <section class="container-infos-dashboard">
                                <h3 aria-level="3">
                                    {!! __('messages.dashboard_workerz.social__media')}}
                                </h3>
                                <div class="form-login form-edit-company form-register form-edit-preview">
                                    @if(auth()->user()->facebook != null)
                                        <div class="container-register-form container-register">
                                            <div class="container-form-email">
                                                <p>{!! __('messages.dashboard_workerz.link__word')}} facebook</p>
                                                <span class="email-label">{{auth()->user()->facebook}}</span>
                                            </div>
                                        </div>
                                    @endif
                                    @if(auth()->user()->instagram != null)
                                        <div class="container-register-form container-register">
                                            <div class="container-form-email">
                                                <p>{!! __('messages.dashboard_workerz.link__word')}} instagram</p>
                                                <span class="email-label">{{auth()->user()->instagram}}</span>
                                            </div>
                                        </div>
                                    @endif
                                    @if(auth()->user()->linkedin != null)
                                        <div class="container-register-form container-register">
                                            <div class="container-form-email">
                                                <p>{!! __('messages.dashboard_workerz.link__word')}} linkedin</p>
                                                <span class="email-label">{{auth()->user()->linkedin}}</span>
                                            </div>
                                        </div>
                                    @endif
                                    @if(auth()->user()->twitter != null)
                                        <div class="container-register-form container-register">
                                            <div class="container-form-email">
                                                <p>{!! __('messages.dashboard_workerz.link__word')}} twitter</p>
                                                <span class="email-label">{{auth()->user()->twitter}}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </section>
                        @endif
                        @if(auth()->user()->end_plan != null)
                            <div class="register-btn-company">
                                <a href="{{route('dashboard.profil.edit')}}" role="button"
                                   class="button-cta button-edition"
                                   type="submit">
                                    {!! __('messages.dashboard_workerz.edit__btn__profil')}}
                                </a>
                            </div>
                        @endif
                        @else
                            <div @if(auth()->user()->end_plan == null) class="expire-plan" @endif>
                                <div class="form-login form-edit-preview edit-user-profile form-register">
                                    <div class="container-form-email avatar-profil">
                                        <div class="avatar-container">
                                            <p>{!! __('messages.dashboard_workerz.profil__picture')}}</p>
                                        </div>
                                        <div class="container-profil-img container-profil-img">
                                            @if(auth()->user()->picture != null)
                                                <img width="150" height="150" src="{{asset(auth()->user()->picture)}}"
                                                     alt="{!! __('messages.alt__profil__img')}} {{auth()->user()->name}}">
                                            @else
                                                <img width="150" height="150" src="{{asset('svg/user.svg')}}"
                                                     alt="{!! __('messages.alt__profil__img__default')}}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="container-form-email">
                                        <p>{!! __('messages.dashboard_workerz.nb__phone')}}</p>
                                        <span
                                            class="email-label">{{chunk_split(auth()->user()->phones()->first()->number, 4, ' ')}}</span>
                                        @if(auth()->user()->phones()->count() > 1 && auth()->user()->phones()->skip(1)->first()->number != null)
                                            <div class="container-form-email">
                                                <p>2<sup>{!! __('nd__word')}}</sup> {!! __('messages.dashboard_workerz.nb__phone')}}</p>
                                                <span
                                                    class="email-label">{{chunk_split(auth()->user()->phones()->skip(1)->first()->number, 4, ' ')}}</span>
                                            </div>
                                        @endif
                                        @if(auth()->user()->phones()->count() > 2 && auth()->user()->phones()->skip(2)->first()->number != null)
                                            <div class="container-form-email">
                                                <p>3<sup>{!! __('th__word')}}</sup> {!! __('messages.dashboard_workerz.nb__phone')}}</p>
                                                <span
                                                    class="email-label">{{chunk_split(auth()->user()->phones()->skip(2)->first()->number, 4, ' ')}}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="container-form-email">
                                        <p>{!! __('messages.contact.label__name')}}</p>
                                        <span class="email-label"> {{ucfirst(auth()->user()->name)}}</span>
                                    </div>
                                    <div class="container-form-email">
                                        <p>{!! __('messages.contact.label__surname')}}</p>
                                        <span class="email-label">{{ucfirst(auth()->user()->surname)}}</span>
                                    </div>
                                    @if(auth()->user()->end_plan != null)
                                        <div class="container-form-email">
                                            <p>{!! __('messages.dashboard_workerz.plan__word')}} : {{$plan->name}}</p>
                                            @if(auth()->user()->plan_user_id !== 1 && $realSub->cancel_at_period_end !== true || $realSub->cancel_at_period_end !== true)
                                                <span
                                                    class="email-label">{!! __('messages.dashboard_workerz.renew__word')}}{{auth()->user()->end_plan->locale('en')->addHours(4)->isoFormat('Do MMMM YYYY, H:mm')}}</span>
                                            @else
                                                <span
                                                    class="email-label">{!! __('messages.dashboard_workerz.expired__words')}}{{auth()->user()->end_plan->locale('en')->addHours(4)->isoFormat('Do MMMM YYYY, H:mm')}}</span>
                                            @endif
                                        </div>
                                    @else
                                        <div class="container-form-email">
                                            <p>{!! __('messages.dashboard_workerz.plan__word')}}</p>
                                            <span class="email-label required">{!! __('messages.dashboard_workerz.expired__word')}}</span>
                                        </div>
                                    @endif
                                    <div class="container-form-email">
                                        <p>{!! __('messages.auth.email__word')}}</p>
                                        <span class="email-label">{{auth()->user()->email}}</span>
                                    </div>
                                </div>
                                <div class="container-info-sub">
                                    @if(auth()->user()->end_plan != null)
                                        @if($realSub->cancel_at_period_end !== true)
                                            <div class="sub-btn-delete">
                                                <a href="{{route('dashboard.cancelSub')}}" role="button"
                                                   class="button-cta button-edition" id="sub-btn-delete"
                                                   type="submit">
                                                    {!! __('messages.dashboard_workerz.cancel__sub')}}
                                                </a>
                                            </div>
                                        @else
                                            <div class="sub-btn-reactivate">
                                                <a href="{{route('dashboard.activateSub')}}" id="sub-btn-reactivate"
                                                   role="button"
                                                   class="button-cta button-edition"
                                                   type="submit">
                                                    {!! __('messages.dashboard_workerz.reactivate__sub')}}
                                                </a>
                                            </div>
                                        @endif
                                        <div class="button-profil-editing">
                                            <a href="{{route('dashboard.profil.edit')}}" role="button"
                                               class="button-cta button-edition"
                                               type="submit">
                                                {!! __('messages.dashboard_workerz.edit__profil')}}
                                            </a>
                                        </div>

                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    @if(Session::get('applocale') === 'en')
        if(document.getElementById("sub-btn-delete")){function confirmDelete(e){return!0===confirm("The contract will be terminated and will end on the date communicated, are you sure to terminate the contract?")||(e.preventDefault(),!1)}document.getElementById("sub-btn-delete").addEventListener("click",confirmDelete)}
    @elseif(Session::get('applocale') === 'nl')
        if(document.getElementById("sub-btn-delete")){function confirmDelete(e){return!0===confirm("Het contract zal worden opgezegd en zal eindigen op de meegedeelde datum, bent u zeker dat u het contract wilt opzeggen?")||(e.preventDefault(),!1)}document.getElementById("sub-btn-delete").addEventListener("click",confirmDelete)}
    @else
        if(document.getElementById("sub-btn-delete")){function confirmDelete(e){return!0===confirm("Le contrat sera résilier et prendra fin à la date communiquée, êtes vous sûr de résilier le contrat ?")||(e.preventDefault(),!1)}document.getElementById("sub-btn-delete").addEventListener("click",confirmDelete)}
    @endif
@endsection
