@extends('layouts.app')
@section('content')

    <section class="container-home margin">
        <div class="container-home_image container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        {!! __('messages.policy.title')!!}
                    </h2>
                    <p>
                        {!! __('messages.policy.listings')!!}
                    </p>
                </div>
            </div>
            <div class="container-svg">
                <img src="{{asset('svg/Online_campaign_Monochromatic.svg')}}"
                     alt="{!! __('messages.policy.alt__text__conditions__img')!!}">
            </div>
        </div>
    <section class="container-categories-home">
        <h3 aria-level="3" class="container-categories-text-home title-policy">
            {!! __('messages.policy.title__conditions')!!}
        </h3>
        <div class="container-policy show-content">
            <section>
                <h4 aria-level="4">{!! __('messages.policy.info__perso__title')!!}</h4>
                <p>
                    {!! __('messages.policy.info__perso__text_one')!!}</p>
                <p>

                    {!! __('messages.policy.info__perso__text_two')!!}</p>
            </section>


            <section>
                <h4 aria-level="4">{!! __('messages.policy.consent__title')!!}</h4>
                <section>
                    <h5 aria-level="5">{!! __('messages.policy.consent__little__title')!!}</h5>

                    <p>{!! __('messages.policy.consent__text')!!}</p>
                </section>
                <section>

                    <h5 aria-level="5">{!! __('messages.policy.consent__remove__title')!!}</h5>
                    <p>
                        {!! __('messages.policy.consent__remove__text')!!}<a href="mailto:vento.michael0705@hotmail.com">vento.michael0705@hotmail.com</a>.
                    </p></section>
            </section>


            <section>
                <h4 aria-level="4">{!! __('messages.policy.divulgation__title')!!}</h4>
                <p>
                    {!! __('messages.policy.divulgation__text')!!}</p>
            </section>


            <section>
                <h4 aria-level="4">{!! __('messages.policy.service__give__title')!!}</h4>
                <p>
                    {!! __('messages.policy.service__give__text')!!}
                </p>

                <section>
                    <h4 aria-level="4">{!! __('messages.policy.links__title')!!}</h4>
                    <p>
                        {!! __('messages.policy.links__text')!!}</p>
                </section>
            </section>


            <section>
                <h4 aria-level="4">{!! __('messages.policy.security__title')!!}</h4>
                <p>
                    {!! __('messages.policy.security__text')!!}</p>

            </section>

            <section>
                <h4 aria-level="4">{!! __('messages.policy.old__consent__title')!!}</h4>
                <p>
                    {!! __('messages.policy.old__consent__text')!!}</p>
            </section>


            <section>
                <h4 aria-level="4">{!! __('messages.policy.modif__title')!!}</h4>
                <p>
                    {!! __('messages.policy.modif__text')!!}</p></section>


            <section>
                <h4 aria-level="4">{!! __('messages.policy.qst__title')!!}</h4>
                <p>
                    {!! __('messages.policy.qst__text')!!}<a href="mailto:vento.michael0705@hotmail.com">vento.michael0705@hotmail.com</a>.
                </p></section>

        </div>
    </section>
    </section>

@endsection
