@extends('layouts.app')
@section('content')

    <section class="container-home margin">
        <div class="container-home_image container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        {!! __('messages.conditions.title')!!}
                    </h2>
                    <p>
                        {!! __('messages.conditions.listing')!!}
                    </p>
                </div>
            </div>
            <div class="container-svg">
                <img width="300" height="300" src="{{asset('svg/proofiling.svg')}}"
                     alt="{!! __('messages.conditions.alt__text__conditions__img')!!}">
            </div>
        </div>
        <section class="container-categories-home">
            <h3 aria-level="3" class="container-categories-text-home title-policy">
                {!! __('messages.conditions.title__conditions')!!}
            </h3>
            <div class="container-policy show-content">
                <section>
                    <h4 aria-level="4">{!! __('messages.conditions.title__object') !!}</h4>

                    <p>
                        {!! __('messages.conditions.object__text__one')!!}
                    </p>
                    <p>
                        {!! __('messages.conditions.object__text__two')!!}
                    </p>
                    <p>
                        {!! __('messages.conditions.object__text__three')!!}
                    </p>
                </section>


                <section>
                    <h4 aria-level="4">{!! __('messages.conditions.title__legal__mention') !!}</h4>

                    <p>
                        {!! __('messages.conditions.legal__mention__text__one')!!}
                    </p>
                    <p>
                        {!! __('messages.conditions.legal__mention__text__two')!!}
                    </p>
                </section>


                <section>
                    <h4 aria-level="4">{!! __('messages.conditions.title__services') !!}</h4>

                    <p>
                        {!! __('messages.conditions.services__text__one')!!}</p>

                    <ul>
                        <li>• {!! __('messages.conditions.services__text__list__one')!!}</li>
                        <li>• {!! __('messages.conditions.services__text__list__two')!!}</li>
                    </ul>
                    <p>
                        {!! __('messages.conditions.services__text__two')!!}
                    </p>
                    <p>
                        {!! __('messages.conditions.services__text__three')!!}</p>

                    <ul>

                        <li>• {!! __('messages.conditions.services__text__list__three')!!}</li>
                        <li>• {!! __('messages.conditions.services__text__list__four')!!}</li>
                    </ul>
                    <p>
                        {!! __('messages.conditions.services__text__four')!!}</p>
                </section>

                <section>
                    <h4 aria-level="4">{!! __('messages.conditions.title__responsability') !!}</h4>

                    <p>
                        {!! __('messages.conditions.responsability__text__one')!!}
                    </p>
                    <p>
                        {!! __('messages.conditions.responsability__text__two')!!}
                    </p>
                    <p>
                        {!! __('messages.conditions.responsability__text__three')!!}
                    </p>
                    <p>
                        {!! __('messages.conditions.responsability__text__fourth')!!}
                    </p>
                    <p>
                        {!! __('messages.conditions.responsability__text__fiveth')!!}</p>

                    <ul>

                        <li>• {!! __('messages.conditions.responsability__text__list__one')!!}</li>
                        <li>• {!! __('messages.conditions.responsability__text__list__two')!!}</li>
                    </ul>
                    <p>
                        {!! __('messages.conditions.responsability__text__sixth')!!}
                    </p>
                    <p>
                        {!! __('messages.conditions.responsability__text__seventh')!!}
                    </p>
                    <p>
                        {!! __('messages.conditions.responsability__text__eight')!!}</p>
                </section>


                <section>
                    <h4 aria-level="4">{!! __('messages.conditions.title__respo__editor') !!}</h4>
                    <p>{!! __('messages.conditions.respo__editor__text__one')!!}</p>

                    <p>
                        {!! __('messages.conditions.respo__editor__text__two')!!}</p>

                    <p>
                        {!! __('messages.conditions.respo__editor__text__three')!!}
                    </p>
                    <p>
                        {!! __('messages.conditions.respo__editor__text__fourth')!!}</p>
                </section>


                <section>
                    <h4 aria-level="4">{!! __('messages.conditions.title__proprety__intelect') !!}</h4>

                    <p>
                        {!! __('messages.conditions.proprety__intelect__text__one')!!}</p>

                    <p>
                        {!! __('messages.conditions.proprety__intelect__text__two')!!}</p>

                    <p>
                        {!! __('messages.conditions.proprety__intelect__text__three')!!}</p>

                    <p>
                        {!! __('messages.conditions.proprety__intelect__text__fourth')!!}</p>

                    <p>{!! __('messages.conditions.proprety__intelect__text__fiveth')!!}</p>
                </section>


                <section>
                    <h4 aria-level="4">{!! __('messages.conditions.title__data__personnaly') !!}</h4>

                    <p>
                        {!! __('messages.conditions.data__personnaly__text__one')!!}</p>

                    <p>{!! __('messages.conditions.data__personnaly__text__two')!!}</p>

                    <p>{!! __('messages.conditions.data__personnaly__text__three')!!}</p>

                    <p>{!! __('messages.conditions.data__personnaly__text__fourth')!!}</p>

                    <ul>
                        <li>• {!! __('messages.conditions.data__personnaly__text__list__one')!!}</li>
                        <li>• {!! __('messages.conditions.data__personnaly__text__list__two')!!}</li>
                    </ul>
                </section>


                <section>
                    <h4 aria-level="4">{!! __('messages.conditions.title__link__hypertext') !!}</h4>

                    <p>
                        {!! __('messages.conditions.link__hypertext__text__one')!!}</p>

                    <p>{!! __('messages.conditions.link__hypertext__text__two')!!}</p>
                </section>


                <section>
                    <h4 aria-level="4">{!! __('messages.conditions.title__evolution') !!}</h4>


                    <p>{!! __('messages.conditions.evolution__text__one')!!}</p>
                </section>


                <section>
                    <h4 aria-level="4">{!! __('messages.conditions.title__contrat') !!}</h4>

                    <p>
                        {!! __('messages.conditions.contrat__text__one')!!}</p>
                </section>


                <section>
                    <h4 aria-level="4">{!! __('messages.conditions.title__droit') !!}</h4>

                    <p>
                        {!! __('messages.conditions.droit__text__one')!!}</p>
                </section>
            </div>
        </section>
    </section>

@endsection
