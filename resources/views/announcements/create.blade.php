@extends('layouts.app')
@section('content')
    @if (Session::has('success-inscription'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}"
                                                                  alt="{!! __('messages.good__answer')}}">
            <p>{!!session('success-inscription')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <section class="container-home margin">
        <div class="container-home_image container-home-create container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        {!! __('messages.ads.title')}}
                    </h2>
                    <p>
                        {!! __('messages.ads.text')}}
                    </p>
                </div>
            </div>
            <div class="container-svg">
                <img width="300" height="300" src="{{asset('svg/Great_idea_Monochromatic.svg')}}"
                     alt="{!! __('messages.ads.img__alt')}}">
            </div>
        </div>
    </section>
    <section class="container-home container-announcements container-create-ads">
        <div class="title-first-step-register">
            <h2 aria-level="2">{!! __('messages.ads.title__second')}}</h2>
        </div>
        <div class="container-all-announcement show-content container-create-ads-infos">
            <form class="form-login form-register" enctype="multipart/form-data"
                  aria-label="{!! __('messages.ads.arialabel')}}" role="form" method="POST"
                  action="{{ route('announcements.store') }}">
                @csrf
                <div class="container-register-form container-register">
                    <div class="container-form-email">
                        <label for="catchPhrase">{!! __('messages.ads.label__catch')}}</label>
                        <input type="text" id="catchPhrase" value="{{old("catchPhrase")}}"
                               class="email-label" name="catchPhrase"
                               placeholder="{!! __('messages.ads.placeholder__catch')}}">
                        <p class="help">
                            {!! __('messages.ads.help__catch')}}
                        </p>
                    </div>
                    <div class="container-form-email">
                        <div class="avatar-container">
                            <label for="picture">{!! __('messages.ads.label__picture')}}</label>
                            <img width="200" height="200" id="output" class="preview-picture"
                                 alt="{!! __('messages.ads.alt__img__picture__company')}}"/>
                        </div>
                        <input type="file"
                               id="picture" class="input-field @error('picture') is-invalid @enderror email-label"
                               name="picture"
                               accept=".jpg, .jpeg, .png">
                        @error('picture')
                        <p class="danger help">
                            {{$errors->first('picture')}}
                        </p>
                        @enderror
                    </div>
                    <div class="container-form-email">
                        <label for="title">{!! __('messages.title__ad_up')}} <span class="required">*</span></label>
                        <input type="text" id="title" value="{{old("title")}}"
                               class=" @error('title') is-invalid @enderror email-label" name="title"
                               required aria-required="true" placeholder="{!! __('messages.ads.placeholder__title')}}">
                        @error('title')
                        <p class="danger help">
                            {{$errors->first('title')}}
                        </p>
                        @enderror
                    </div>
                    <div class="container-form-email container-email-form regions-create-ad">
                        <label for="location">{!! __('messages.ads.location__label')}} <span
                                class="required">*</span></label>
                        <select required aria-required="true"
                                class="select-register select-regions @error('location') is-invalid @enderror"
                                data-maxoption="1"
                                name="location" id="location">
                            <option value="0" disabled selected>{!! __('messages.ads.fOption__label')}}</option>
                            @foreach($regions as $region)
                                <option @if(old('location') == $region->id) selected
                                        @endif value="{{$region->id}}">
                                    @if(Session::get('applocale') === 'en')
                                        {{$region->name_en}}
                                    @elseif(Session::get('applocale') === 'nl')
                                        {{$region->name_nl}}
                                    @else
                                        {{$region->name}}
                                    @endif </option>
                            @endforeach
                        </select>
                        @error('location')
                        <p class="danger help">
                            {{$errors->first('location')}}
                        </p>
                        @enderror
                    </div>

                    <div class="container-form-email">
                        <label for="job">{!! __('messages.ads.label__job')}} <span class="required">*</span></label>
                        <input placeholder="{!! __('messages.ads.job__example')}}" type="text"
                               id="job" value="{{old("job")}}"
                               class=" @error('job') is-invalid @enderror email-label" name="job" required
                               aria-required="true">
                        @error('job')
                        <p class="danger help">
                            {{$errors->first('job')}}
                        </p>
                        @enderror
                    </div>

                    <div class="container-form-email">
                        <label for="pricemax">{!! __('messages.ads.label__pricemax')}}</label>
                        <input type="text" pattern="^[0-9-+\s()]*$" id="pricemax" name="pricemax"
                               value="{{old("pricemax")}}"
                               class="email-label" maxlength="999999" placeholder="500"><span
                            class="horary-cost">€</span>
                        <p class="help hepl-price">
                            {!! __('messages.ads.help__pricemax')}}
                        </p>
                        @error('pricemax')
                        <p class="danger help">
                            {{$errors->first('pricemax')}}
                        </p>
                        @enderror
                    </div>
                    <div class="container-form-email">

                        <label for="categoryAds">{!! __('messages.ads.label__category')}} <span class="required">*</span></label>
                        <div
                            class="container-filter-categories container-category @error('categoryAds') is-invalid @enderror">
                            <ul class="list-categories">
                                @foreach($categories as $c)
                                    <li>
                                        <input
                                            @for($i=0;$i<=2;$i++)
                                            @if(isset(old('categoryAds')[$i]) && old('categoryAds')[$i] == $c->id) checked
                                            @endif
                                            @endfor
                                            role="checkbox"
                                            aria-checked="false" class="checkCat hiddenCheckbox inp-cbx"
                                            name="categoryAds[]" id="categoryAds{{$c->id}}"
                                            type="checkbox" value="{{$c->id}}"/>
                                        <label class="cbx" for="categoryAds{{$c->id}}">
                                                <span>
                                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                                      <polyline points="1 5 4 8 11 1"></polyline>
                                                    </svg>
                                                </span>
                                            @if(Session::get('applocale') === 'en')
                                                <span>{{$c->name_en}}</span>
                                            @elseif(Session::get('applocale') === 'nl')
                                                <span>{{$c->name_nl}}</span>
                                            @else
                                                <span>{{$c->name}}</span>
                                            @endif
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @error('categoryAds')
                        <p class="danger dangerCategory help" style="margin-bottom: 0;margin-top: 0;">
                            {{$errors->first('categoryAds')}}
                        </p>
                        @enderror
                        @if(auth()->user()->plan_user_id == 1)
                            <p style="font-size: .8em"><a href="{{route('usersAlready.plans')}}#plans">
                                    {!! __('messages.upgrade_plan')}}</a> {!! __('messages.upgrade__possibilityto3')}}</p>
                        @endif
                        @if(auth()->user()->plan_user_id == 2)
                            <p style="font-size: .8em">{!! __('messages.upgrade__to__2')}}</p>
                        @endif
                        @if(auth()->user()->plan_user_id == 3)
                            <p style="font-size: .8em">{!! __('messages.upgrade__to__3')}}</p>
                        @endif


                    </div>
                    <div class="container-form-email selectdiv">
                        <label for="startmonth">{!! __('messages.ads.label__start__month')}} <span
                                class="required">*</span></label>
                        <div
                            class="container-filter-categories container-category @error('startmonth') is-invalid @enderror">

                            <ul class="list-categories">
                                @foreach($disponibilities as $disponibility)
                                    <li id="checkDispo">
                                        <input @if(old('startmonth') == $disponibility->id) checked @endif
                                        role="checkbox"
                                               aria-checked="false" class="checkDispo hiddenCheckbox inp-cbx"
                                               name="startmonth" id="startmonth{{$disponibility->id}}"
                                               type="checkbox" value="{{$disponibility->id}}"/>
                                        <label class="cbx" for="startmonth{{$disponibility->id}}">
                                                <span>
                                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                                      <polyline points="1 5 4 8 11 1"></polyline>
                                                    </svg>
                                                </span>
                                            @if(Session::get('applocale') === 'en')
                                                <span>{{$disponibility->name_en}}</span>
                                            @elseif(Session::get('applocale') === 'nl')
                                                <span>{{$disponibility->name_nl}}</span>
                                            @else
                                                <span>{{$disponibility->name}}</span>
                                            @endif
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @error('startmonth')
                        <p class="danger dangerCategory help" style="margin-bottom: 0;margin-top: 0;">
                            {{$errors->first('startmonth')}}
                        </p>
                        @enderror
                        <p style="font-size: .8em">{!! __('messages.possibility__to__one__only')}}</p>

                    </div>


                    <div class="container-form-email container-job-ads-create container-description-ad">
                        <div class="container-maxCharacters">
                            <label for="description">{!! __('messages.ads.label__description')}} <span
                                    class="required">*</span></label>
                            <span class="maxCharacters">{!! __('messages.ads.max__caractere')}}</span>
                        </div>
                        <textarea id="description" name="description" required
                                  class=" @error('description') is-invalid @enderror email-label"
                                  maxlength="256" placeholder="Description de votre annonce..."
                                  rows="5" cols="33">{{old("description")}}</textarea>
                        @error('description')
                        <p class="danger help">
                            {{$errors->first('description')}}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="conditionsAds">
                    <p>
                        <a href="{{route('conditions')}}">{!! __('messages.ads.conditions')}}</a> {!! __('messages.ads.and__text')}}
                        <a
                            href="{{route('policy')}}">{!! __('messages.ads.politic__text')}}</a> {!! __('messages.ads.website__text')}}
                    </p>
                </div>
                <div class="container-buttons-ads">
                    <div class="link-back">
                        <button class="button-back button-cta button-draft" name="is_draft">
                            {!! __('messages.ads.put__in__draft')}}
                        </button>
                    </div>
                    <button role="button" class="button-cta" type="submit">
                        {!! __('messages.ads.create__ads')}}
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{asset('js/previewPicture.js')}}"></script>
    @if(Session::get('applocale') === 'en')
        @if(auth()->user()->plan_user_id == 1)
            <script src="{{asset('js/en/checkDataMaxOptions.js')}}"></script>
        @endif
        @if(auth()->user()->plan_user_id == 2)
            <script src="{{asset('js/en/checkDataMaxOptions2.js')}}"></script>
        @endif
        @if(auth()->user()->plan_user_id == 3)
            <script src="{{asset('js/en/checkDataMaxOptions3.js')}}"></script>
        @endif
    @elseif(Session::get('applocale') === 'nl')
        @if(auth()->user()->plan_user_id == 1)
            <script src="{{asset('js/nl/checkDataMaxOptions.js')}}"></script>
        @endif
        @if(auth()->user()->plan_user_id == 2)
            <script src="{{asset('js/nl/checkDataMaxOptions2.js')}}"></script>
        @endif
        @if(auth()->user()->plan_user_id == 3)
            <script src="{{asset('js/nl/checkDataMaxOptions3.js')}}"></script>
        @endif
    @else
        @if(auth()->user()->plan_user_id == 1)
            <script src="{{asset('js/checkDataMaxOptions.js')}}"></script>
        @endif
        @if(auth()->user()->plan_user_id == 2)
            <script src="{{asset('js/checkDataMaxOptions2.js')}}"></script>
        @endif
        @if(auth()->user()->plan_user_id == 3)
            <script src="{{asset('js/checkDataMaxOptions3.js')}}"></script>
        @endif
    @endif

@endsection
