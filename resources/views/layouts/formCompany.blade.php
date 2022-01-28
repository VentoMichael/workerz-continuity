<div>
    <form class="form-login form-register @if(auth()->user())form-edit @endif" enctype="multipart/form-data"
          aria-label="{!! __('messages.ads.arialabel')!!}" role="form" method="POST"
          @if(auth()->user()) action="{{ route('dashboard.update') }}"
          @else action="{{ route('register') }}" @endif>
        @csrf
        @if(auth()->user()) @method('PUT') @endif
        <div
            class="container-register-form container-register @if(auth()->user()) container-edition-formulary @else container-form-company container-form-registers @endif container-register-user">
            <div class="container-form-email">
                <div class="avatar-container">
                    <label for="picture">Logo</label>
                    <div class="container-profil-img">
                        <img
                            @if(auth()->user() && auth()->user()->picture !== null) src="{{asset(auth()->user()->picture)}}"
                            @elseif(auth()->user() && auth()->user()->picture == null) src="{{asset('svg/user.svg')}}"
                            @endif width="150" height="150" id="output" class="preview-picture preview-edit"
                            alt="{!! __('messages.ads.alt__img__picture__company')!!}"/>
                    </div>
                </div>
                <input type="file"
                       id="picture" class="input-field @error('picture') is-invalid @enderror email-label"
                       name="picture"
                       accept=".jpg, .jpeg, .png, .svg, .webp">
                <p class="help">{!! __('messages.format__accepted')!!} : jpg, png, jpeg ou svg</p>
                <p class="helpSecond">{!! __('messages.length__max')!!} : 2048KO</p>
                @error('picture')
                <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                </div>
                @enderror
            </div>
            <div class="container-form-email">
                <label for="number">{!! __('messages.dashbard_workerz.nb__phone')!!} <span
                        class="required">*</span></label>
                <input minlength="7" maxlength="15" type="tel" id="phone" pattern="^[0-9-+\s()]*$"
                       @if(auth()->user()) value="{{auth()->user()->phones()->first()->number}}"
                       @else value="{{old('number')}}" @endif placeholder="0494827235"
                       class=" @error('number') is-invalid @enderror email-label" name="number" required
                       aria-required="true">
                @error('number')
                <div class="container-error categoerror">
                <span role="alert" class="error">
                    <strong>{{ ucfirst($message) }}</strong>
                </span>
                </div>
                @enderror
                @if(!auth())
                    @if($plan == 1)
                        <p class="help"><a
                                href="{{route('users.plans')}}#plans">{!! __('messages.upgrade_plan')!!}</a> {!! __('messages.upgrade__possibilityto3')}}
                        </p>
                    @endif
                    @if($plan == 2)
                        <p class="help">{!! __('messages.upgrade__to__2')!!} {!! __('messages.from__profil')!!}</p>
                    @endif
                    @if($plan == 3)
                        <p class="help">{!! __('messages.upgrade__to__3')!!} {!! __('messages.from__profil')!!}</p>
                    @endif
                @endif

            </div>
            @if(auth()->user() && auth()->user()->plan_user_id ==2)

                @if(auth()->user()->phones()->count() > 1)
                    <div class="container-form-email">
                        <label
                            for="phonetwo">2<sup>{!! __('messages.nd__word')!!}</sup> {!! __('messages.dashbard_workerz.nb__phone')!!}
                            <span
                                class="required">*</span></label>
                        <input minlength="7" maxlength="15" type="tel" id="phonetwo" pattern="^[0-9-+\s()]*$"
                               placeholder="0494827235"
                               value="{{auth()->user()->phones()->skip(1)->first()->number}}"
                               class=" @error('phone') is-invalid @enderror email-label" name="phonetwo">
                    </div>
                @endif
            @endif
            @if(auth()->user() && auth()->user()->plan_user_id ==3)

                <div class="container-form-email">
                    <label
                        for="phonetwo">2<sup>{!! __('messages.nd__word')!!}</sup> {!! __('messages.dashbard_workerz.nb__phone')!!}
                    </label>

                    <input minlength="7" maxlength="15" type="tel" id="phonetwo" pattern="^[0-9-+\s()]*$"
                           placeholder="0494827235"
                           @if(auth()->user()->phones()->count() > 1)
                           value="{{auth()->user()->phones()->skip(1)->first()->number}}"
                           @endif class=" @error('phone') is-invalid @enderror email-label" name="phonetwo">
                </div>
                <div class="container-form-email">
                    <label
                        for="phonethree">3<sup>{!! __('messages.th__word')!!}</sup> {!! __('messages.dashbard_workerz.nb__phone')!!}
                    </label>

                    <input minlength="7" maxlength="15" type="tel" id="phonethree" pattern="^[0-9-+\s()]*$"
                           placeholder="0494827235"
                           @if(auth()->user()->phones()->count() > 2)
                           value="{{auth()->user()->phones()->skip(2)->first()->number}}"
                           @endif
                           class=" @error('phone') is-invalid @enderror email-label" name="phonethree">
                </div>

            @endif
            @if(!auth())
                <div
                    class="container-register-form container-register @if(auth()->user()) container-edit-formulary @endif">
                    @endif
                    <div class="container-form-email">
                        <label for="name">{!! __('messages.dashbard_workerz.company__name')!!} <span
                                class="required">*</span></label>
                        <input type="text" id="name" @if(auth()->user()) value="{{auth()->user()->name}}"
                               @else value="{{old('name')}}" @endif placeholder="Rotis"
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
                        <label for="website">{{ucfirst(__('messages.dashbard_workerz.website__word'))}}</label>
                        <input placeholder="https://workerz.be" type="text" id="website"
                               @if(auth()->user()) value="{{auth()->user()->website}}"
                               @else                                value="{{old('website')}}"
                               @endif
                               class=" @error('website') is-invalid @enderror email-label" name="website">
                        @if(!auth())
                            @if($plan == 1)
                                <p class="help"><a
                                        href="{{route('users.plans')}}#plans">{!! __('messages.upgrade_plan')!!}</a> {!! __('messages.upgrade__possibilityto3')!!}
                                </p>
                            @endif
                            @if($plan == 2)
                                <p class="help">{!! __('messages.upgrade__to__2')!!} {!! __('messages.from__profil')!!}</p>
                            @endif
                            @if($plan == 3)
                                <p class="help">{!! __('messages.upgrade__to__3')!!} {!! __('messages.from__profil')!!}</p>
                            @endif
                        @endif

                        @error('website')
                        <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                        </div>
                        @enderror

                    </div>
                    @if(auth()->user() && auth()->user()->plan_user_id == 2)

                        @if(auth()->user()->websites()->count() >= 1)
                            <div class="container-form-email">
                                <label for="websitetwo">2<sup>{!! __('messages.nd__word')!!}</sup> {{ucfirst(__('messages.dashbard_workerz.website__word'))}} <span
                                        class="required">*</span></label>
                                <input type="text" id="websitetwo"
                                       placeholder="http://workerz.be"
                                       @if(auth()->user()->websites()->count() > 1)
                                       value="{{auth()->user()->websites()->first()->number}}"
                                       @endif
                                       class=" @error('phone') is-invalid @enderror email-label" name="websitetwo">
                            </div>
                        @endif
                    @endif
                    @if(auth()->user() && auth()->user()->plan_user_id ==3)

                        <div class="container-form-email">
                            <label for="websitetwo">2<sup>{!! __('messages.nd__word')!!}</sup> {{ucfirst(__('messages.dashbard_workerz.website__word'))}}</label>

                            <input type="text" id="websitetwo"
                                   placeholder="http://workerz.be"
                                   @if(auth()->user()->websites()->count() > 0)
                                   value="{{auth()->user()->websites()->first()->number}}"
                                   @endif class=" @error('phone') is-invalid @enderror email-label" name="websitetwo">
                        </div>
                        <div class="container-form-email">
                            <label for="websitethree">3<sup>{!! __('messages.th__word')!!}</sup> {{ucfirst(__('messages.dashbard_workerz.website__word'))}}</label>

                            <input type="text" id="websitethree"
                                   placeholder="http://workerz.be"
                                   @if(auth()->user()->websites()->count() > 1)
                                   value="{{auth()->user()->websites()->skip(1)->first()->number}}"
                                   @endif
                                   class=" @error('phone') is-invalid @enderror email-label" name="websitethree">
                        </div>

                    @endif
                    @if(!auth())
                </div>
                <div
                    class="container-register-form container-register @if(auth()->user()) container-edit-formulary @endif container-job-dashboard">
                    @endif
                    <div
                        class="container-form-email container-job-profil selectdiv container-cat container-disponibilities-register">
                        <label for="categoryUser">{!! __('messages.dashbard_workerz.category')!!} <span
                                class="required">*</span></label>
                        @if(!auth()->user() && $plan == 1)
                            <select required aria-required="true" class="select-register select-regions"
                                    data-maxoption="1"
                                    name="categoryUser[]">
                                @if(auth())
                                    <option value="0" disabled selected>{!! __('messages.o0__category')!!}</option>
                                @endif
                                @foreach($categories as $c)
                                    <option
                                        @if(auth()->user() && $user_categories->contains($c->id)) selected
                                        @endif value="{{$c->id}}">
                                        @if(Session::get('applocale') === 'en')
                                            {{$c->name_en}}
                                        @elseif(Session::get('applocale') === 'nl')
                                            {{$c->name_nl}}
                                        @else
                                            {{$c->name}}
                                        @endif
                                            </option>
                                @endforeach
                            </select>
                        @else
                            <div class="container-category">
                                <ul class="list-categories list-checkboxes-register list-dispo-profil">
                                    @foreach($categories as $c)
                                        <li>
                                            <input
                                                @for($i=0;$i<=2;$i++)
                                                @if(isset(old('categoryUser')[$i]) && old('categoryUser')[$i] == $c->id) checked
                                                @endif
                                                @endfor
                                                @if(auth()->user() && $user_categories->contains($c->id)) checked
                                                @endif role="checkbox"
                                                aria-checked="false" class="checkCat hiddenCheckbox inp-cbx"
                                                name="categoryUser[]" id="categoryUser{{$c->id}}"
                                                type="checkbox" value="{{$c->id}}"/>
                                            <label class="cbx" for="categoryUser{{$c->id}}">
                                                <span>
                                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                                      <polyline points="1 5 4 8 11 1"></polyline>
                                                    </svg>
                                                </span>
                                                <span>
                                                    @if(Session::get('applocale') === 'en')
                                                        {{$c->name_en}}
                                                    @elseif(Session::get('applocale') === 'nl')
                                                        {{$c->name_nl}}
                                                    @else
                                                        {{$c->name}}
                                                    @endif
                                                </span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @error('categoryUser')
                        <div class="@if(!auth()->user())container-error @endif categoerror">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                        </div>
                        @enderror
                        @if($plan == 1)
                            <p class="help proposed-job" @if(!auth())style="margin-top: -15px"
                               @else style="margin-top: 0"@endif><a
                                    href="{{route('users.plans')}}#plans">{!! __('messages.upgrade_plan')!!}</a> {!! __('messagesupgrade__possibilityto3')!!}
                            </p>
                            <p class="help proposed-job" style="margin-top: -15px">{!! __('messages.dontfind__job')!!} <a
                                    href="{{route('contact'). '#form'}} ">{!! __('messages.propose__job__text')!!}</a></p>
                        @endif
                        @if($plan == 2)
                            <p class="help proposed-job">{!! __('messages.upgrade__to__2')!!}
                                , {{strtolower(__('messages.dontfind__job'))}} <a
                                    href="{{route('contact'). '#form'}} ">{!! __('messages.propose__job__text')!!}</a></p>
                        @endif
                        @if($plan == 3)
                            <p class="help proposed-job">{!! __('messages.upgrade__to__3')!!}
                                , {{strtolower(__('messages.dontfind__job'))}} <a
                                    href="{{route('contact'). '#form'}} ">{!! __('messages.propose__job__text')!!}</a></p>
                        @endif

                    </div>
                    <div
                        class="container-form-email selectdiv container-disponibilities-edit container-disponibilities-register container-job-dashboard">
                        <label for="disponibilities">{!! __('messages.dashbard_workerz.disponibility')!!}</label>
                        <div class="container-category">
                            <ul class="list-categories list-checkboxes-register list-dispo-profil"
                                style="overflow-y: scroll; -webkit-overflow-scrolling: touch;">
                                @foreach($disponibilities as $disponibility)

                                    <li>
                                        <input
                                            @for($i=0;$i<=6;$i++)
                                            @if(isset(old('disponibilities')[$i]) && old('disponibilities')[$i] == $disponibility->id) checked
                                            @endif
                                            @endfor
                                            @if(auth()->user() && $user_disponibilities->contains($disponibility->id)) checked
                                            @else                                             @endif @if(!auth()->user() && $disponibility->pre_selected == true && !old('disponibilities')) checked
                                            @endif role="checkbox"
                                            aria-checked="false" class=" hiddenCheckbox inp-cbx"
                                            name="disponibilities[]" id="disponibilities{{$disponibility->id}}"
                                            type="checkbox" value="{{$disponibility->id}}"/>
                                        <label class="cbx" for="disponibilities{{$disponibility->id}}">
                                                <span>
                                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                                      <polyline points="1 5 4 8 11 1"></polyline>
                                                    </svg>
                                                </span>
                                            <span>
                                                @if(Session::get('applocale') === 'en')
                                                    {{$disponibility->name_en}}
                                                @elseif(Session::get('applocale') === 'nl')
                                                    {{$disponibility->name_nl}}
                                                @else
                                                    {{$disponibility->name}}
                                                @endif
                                                </span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                            @error('disponibilities')
                            <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                        </div>
                        @if(!auth()->user())
                            <p class="help">{!! __('messages.open__hours__text')!!}</p>
                        @endif
                    </div>
                    @if(auth()->user() && auth()->user()->plan_user_id ==2)
                        @if(auth()->user()->adresses()->count() >= 1)
                            <div class="container-form-email">
                                <label for="adresstwo">{!! __('messages.secondary__adress')!!}Adresse secondaire et
                                    n°</label>
                                <input type="text" id="adresstwo"
                                       class=" @error('adresstwo') is-invalid @enderror email-label"
                                       name="adresstwo"
                                       placeholder="Rue des cocotier, 21" @if(auth()->user()->adresses()->count() > 1)
                                       value="{{auth()->user()->adresses()->first()->postal_adress}}"
                                    @endif>
                            </div>
                            <div class="container-form-email selectdiv">
                                <label for="locationtwo">{!! __('messages.second__region')!!}Région secondaire</label>
                                <select required aria-required="true" class="select-register select-regions"
                                        data-maxoption="1"
                                        name="locationtwo" id="locationtwo">
                                    @if(auth())
                                        <option value="0" disabled
                                                selected>{!! __('messages.ads.fOption__label')!!}</option>
                                    @endif

                                    @foreach($regions as $region)
                                        <option
                                            @if(auth()->user()->adresses()->count() > 1 && auth()->user()->adresses()->first()->province_id == $region->id) selected
                                            @endif value="{{$region->id}}">
                                            @if(Session::get('applocale') === 'en')
                                                {{$region->name_en}}
                                            @elseif(Session::get('applocale') === 'nl')
                                                {{$region->name_nl}}
                                            @else
                                                {{$region->name}}
                                            @endif
                                                </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    @endif

                    @if(auth()->user() && auth()->user()->plan_user_id == 3)
                        <div class="container-form-email">
                            <label for="adresstwo">{!! __('messages.secondary__adress')!!}Adresse secondaire et n°</label>
                            <input type="text" id="adresstwo"
                                   class=" @error('adresstwo') is-invalid @enderror email-label" name="adresstwo"
                                   placeholder="Rue des cocotier, 21"
                                   @if(auth()->user()->adresses()->count() > 1) value="{{auth()->user()->adresses()->skip(1)->first()->postal_adress}}"
                                @endif>
                        </div>
                        <div class="container-form-email selectdiv">
                            <label for="locationtwo">{!! __('messages.second__region')!!}Région secondaire</label>
                            <select required aria-required="true" class="select-register select-regions"
                                    data-maxoption="1"
                                    name="locationtwo" id="locationtwo">
                                @if(auth()->user())
                                    <option value="0" disabled selected>{!! __('messages.ads.fOption__label')!!}</option>
                                @endif
                                @foreach($regions as $region)
                                    <option
                                        @if(auth()->user()->adresses()->count() > 1 && auth()->user()->adresses()->skip(1)->first()->province_id == $region->id) selected
                                        @endif value="{{$region->id}}">@if(Session::get('applocale') === 'en')
                                            {{$region->name_en}}
                                        @elseif(Session::get('applocale') === 'nl')
                                            {{$region->name_nl}}
                                        @else
                                            {{$region->name}}
                                        @endif</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="container-form-email">
                            <label for="adressthree">{!! __('messages.third__adress')!!}Adresse tertiaire et n°</label>
                            <input type="text" id="adressthree"
                                   @if(auth()->user()->adresses()->count() > 2)
                                   value="{{auth()->user()->adresses()->skip(2)->first()->postal_adress}}"
                                   @endif
                                   class=" @error('adressthree') is-invalid @enderror email-label" name="adressthree"
                                   placeholder="Rue des cocotier, 21">
                        </div>
                        <div class="container-form-email selectdiv">
                            <label for="locationthree">{!! __('messages.third__region')}}Région tertiaire</label>
                            <select required aria-required="true" class="select-register select-regions"
                                    data-maxoption="1"
                                    name="locationthree" id="locationthree">
                                @if(auth()->user())
                                    <option value="0" disabled selected>{!! __('messages.ads.fOption__label')!!}</option>
                                @endif
                                @foreach($regions as $region)
                                    <option
                                        @if(auth()->user()->adresses()->count() > 2 && auth()->user()->adresses()->skip(2)->first()->province_id == $region->id) selected
                                        @endif value="{{$region->id}}">@if(Session::get('applocale') === 'en')
                                            {{$region->name_en}}
                                        @elseif(Session::get('applocale') === 'nl')
                                            {{$region->name_nl}}
                                        @else
                                            {{$region->name}}
                                        @endif</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="container-form-email container-job-dashboard">
                        <label for="job">{!! __('messages.ads.label__job')!!} <span class="required">*</span></label>
                        <input type="text" id="job" @if(auth()->user()) value="{{auth()->user()->job}}"
                               @else value="{{old("job")}}" @endif
                               class=" @error('job') is-invalid @enderror email-label" name="job"
                               placeholder="{!! __('messages.ads.job__example')!!}"
                               required aria-required="true">
                        @error('job')
                        <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                        </div>
                        @enderror
                    </div>


                    @if(!auth())
                </div>
                <div
                    class="container-register-form container-register @if(auth()->user()) container-edit-formulary @endif">
                    @endif

                    <div class="container-form-email">
                        <label for="pricemax">{!! __('messages.dashbard_workerz.horary__price')!!}</label>
                        <input max="999999" type="number" id="pricemax" pattern="^[0-9-+\s()]*$" name="pricemax"
                               @if(auth()->user()) value="{{auth()->user()->pricemax}}"
                               @else  value="{{old('pricemax')}}"
                               @endif class=" @error('pricemax') is-invalid @enderror email-label"
                               placeholder="55"><span
                            class="horary-cost horary-cost-company">€/h</span>
                        @if(!auth()->user())

                            <p class="help">{!! __('messages.view__price')!!}</p>
                        @endif

                        @error('pricemax')
                        <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                        </div>
                        @enderror
                    </div>


                    @if(!auth())
                </div>
                <div
                    class="container-register-form container-register @if(auth()->user()) container-edit-formulary @endif">
                    @endif
                    @if(!auth())
                        <div class="container-form-email selectdiv">
                            <label for="location">{!! __('messages.ads.location__label')}} <span class="required">*</span></label>
                            <select
                                required aria-required="true" class="select-register select-regions"
                                data-maxoption="1"
                                name="location" id="location">
                                @if(!auth() && !old('location'))
                                    <option value="0" disabled selected>{!! __('messages.ads.fOption__label')}}</option>
                                @endif
                                @foreach($regions as $region)
                                    <option value="{{$region->id}}">@if(Session::get('applocale') === 'en')
                                            {{$region->name_en}}
                                        @elseif(Session::get('applocale') === 'nl')
                                            {{$region->name_nl}}
                                        @else
                                            {{$region->name}}
                                        @endif</option>
                                @endforeach
                            </select>
                            @error('location')
                            <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                            @if($plan == 1)
                                <p class="help"><a
                                        href="{{route('users.plans')}}#plans">{!! __('messages.upgrade_plan')}}</a> {!! __('messages.upgrade__possibilityto3')}}
                                </p>
                            @endif
                            @if($plan == 2)
                                <p class="help">{!! __('messages.upgrade__to__2')}} {!! __('messages.from__profil')}}</p>
                            @endif
                            @if($plan == 3)
                                <p class="help">{!! __('messages.upgrade__to__3')}} {!! __('messages.from__profil')}}</p>
                            @endif
                        </div>
                    @endif

                    <div class="container-form-email container-job-dashboard">
                        <label for="adress">{!! __('messages.adress__number')}}Adresse du siège social et n°
                            <span class="required">*</span></label>
                        <input type="text" id="adress"
                               @if(auth()->user()) value="{{auth()->user()->adresses()->first()->postal_adress}}"
                               @else value="{{old("adress")}}" @endif
                               class=" @error('adress') is-invalid @enderror email-label" name="adress"
                               placeholder="Rue des cocotier, 21">
                        @error('adress')
                        <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                        </div>
                        @enderror
                    </div>
                    <div class="container-form-email">
                        <label for="catchPhrase">{!! __('messages.ads.label__catch')}}</label>
                        <input type="text" id="catchPhrase"
                               class="email-label" name="catchPhrase"
                               placeholder="{!! __('messages.dashbard_workerz.link__word')}}Une entreprise qui vous satisfera"
                               @if(auth()->user()) value="{{auth()->user()->catchPhrase}}"
                               @else  value="{{old("catchPhrase")}}" @endif>
                        @if(!auth()->user())
                            <p class="help">
                                {!! __('messages.attired__client')}}
                            </p>
                        @endif
                    </div>

                    <div class="container-form-email selectdiv container-job-dashboard">
                        <label for="location">{!! __('messages.ads.location__label')}} <span
                                class="required">*</span></label>
                        <select required aria-required="true" class="select-register select-regions" data-maxoption="1"
                                name="location" id="location">
                            @if(!auth()->user() && !old('location'))
                                <option value="0" disabled selected>{!! __('messages.ads.fOption__label')}}</option>
                            @endif
                            @foreach($regions as $region)
                                <option @if(old('location') == $region->id) selected @endif
                                @if(auth()->user() && auth()->user()->adresses->first()->province_id == $region->id) selected
                                        @else @endif value="{{$region->id}}">@if(Session::get('applocale') === 'en')
                                        {{$region->name_en}}
                                    @elseif(Session::get('applocale') === 'nl')
                                        {{$region->name_nl}}
                                    @else
                                        {{$region->name}}
                                    @endif</option>
                            @endforeach
                        </select>
                        @error('location')
                        <div class="container-error categoerror">
                <span role="alert" class="error">
                    <strong>{{ ucfirst($message) }}</strong>
                </span>
                        </div>
                        @enderror
                        @if($plan == 1)
                            <p class="help"><a
                                    href="{{route('users.plans')}}#plans">{!! __('messages.upgrade_plan')}}</a> {!! __('messages.upgrade__possibilityto3')}}
                            </p>
                        @endif
                        @if($plan == 2)
                            <p class="help">{!! __('messages.upgrade__to__2')}} {!! __('messages.from__profil')}}</p>
                        @endif
                        @if($plan == 3)
                            <p class="help">{!! __('messages.upgrade__to__3')}} {!! __('messages.from__profil')}}</p>
                        @endif
                    </div>
                    <div class="container-form-email container-job-dashboard">
                        <span>{!! __('messages.dashbard_workerz.possibility__job__company')}}</span>
                        <ul id="jobOpportunity">
                            <li>
                                <input role="radio" class="hiddenRadio inp-cbx"
                                       id="jobOpportunityYes"
                                       name="possibility_job"
                                       @if(old('possibility_job') === 'yes') checked @endif
                                       @if(!auth()->user()) aria-checked="false" @endif
                                       @if(auth()->user() && auth()->user()->possibility_job == 'yes') checked
                                       @endif type="radio" value="yes"/>
                                <label class="cbx" for="jobOpportunityYes">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span
                                        class="jobOpportunity">{!! __('messages.dashbard_workerz.possibility__yes')}}</span>
                                </label>
                            </li>
                            <li>
                                <input role="radio"
                                       class="hiddenRadio inp-cbx"
                                       id="jobOpportunityNo"
                                       @if(old('possibility_job') === 'no') checked @endif
                                       @if(!auth()->user()) aria-checked="false" @endif
                                       @if(auth()->user() && auth()->user()->possibility_job == 'no') checked
                                       @else aria-checked="false" @endif name="possibility_job"
                                       type="radio" value="no"/>
                                <label class="cbx" for="jobOpportunityNo">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span
                                        class="jobOpportunity">{!! __('messages.dashbard_workerz.possibility__no')}}</span>
                                </label>
                            </li>
                            <li>
                                <input role="radio"
                                       class="hiddenRadio inp-cbx"
                                       id="jobOpportunityNotDetermine"
                                       @if(auth()->user() && auth()->user()->possibility_job == 'dkn') checked @endif
                                       @if(old('possibility_job') === 'dkn') checked @endif
                                       @if(!auth()->user() && !old('possibility_job')) aria-checked="true" checked
                                       @endif name="possibility_job"
                                       type="radio" value="dkn"/>
                                <label class="cbx" for="jobOpportunityNotDetermine">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span class="jobOpportunity">{!! __('messages.dashbard_workerz.not__communicate')}}</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                    @if(!auth())
                </div>
                <div
                    class="container-register-form container-register @if(auth()->user()) container-edit-formulary @endif contaner-description">
                    @endif
                    <div class="container-form-email container-description-register container-description-edit">
                        <div class="container-maxCharacters">
                            <label for="description">{!! __('messages.dashbard_workerz.description__company')}} <span class="required">*</span></label>
                            <span class="maxCharacters">{!! __('messages.ads.max__caractere')}}</span>
                        </div>
                        @if(auth()->user() && auth()->user()->description)
                            <textarea id="description" maxlength="256" name="description" required
                                      class=" @error('description') is-invalid @enderror email-label"
                                      placeholder="{!! __('messages.ads.description__profil')}}"
                                      rows="5" cols="33">{{auth()->user()->description}}</textarea>
                        @else
                            <textarea id="description" maxlength="256" name="description" required
                                      class=" @error('description') is-invalid @enderror email-label"
                                      placeholder="{!! __('messages.ads.description__profil')}}"
                                      rows="5" cols="33">{{old("description")}}</textarea>
                        @endif
                        @error('description')
                        <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                        </div>
                        @enderror
                    </div>
                    @if(!auth())
                </div>
            @endif
            @include('partials.register')
            @if(auth()->user())
                <div class="container-form-email container-facebook-edit">
                    <label for="facebook">{!! __('messages.dashbard_workerz.link__word')}} Facebook</label>
                    <input placeholder="https://facebook.be" type="text" id="facebook"
                           @if(auth()->user()) value="{{auth()->user()->facebook}}" @endif
                           class=" @error('facebook') is-invalid @enderror email-label" name="facebook">

                    @error('facebook')
                    <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                    </div>
                    @enderror
                </div>
                <div class="container-form-email">
                    <label for="instagram">{!! __('messages.dashbard_workerz.link__word')}} Instagram</label>
                    <input placeholder="https://instagram.be" type="text" id="instagram"
                           @if(auth()->user()) value="{{auth()->user()->instagram}}" @endif
                           class=" @error('instagram') is-invalid @enderror email-label" name="instagram">

                    @error('instagram')
                    <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                    </div>
                    @enderror
                </div>
                <div class="container-form-email">
                    <label for="linkedin">{!! __('messages.dashbard_workerz.link__word')}} Linkedin</label>
                    <input placeholder="https://linkedin.be" type="text" id="linkedin"
                           @if(auth()->user()) value="{{auth()->user()->linkedin}}" @endif
                           class=" @error('linkedin') is-invalid @enderror email-label" name="linkedin">

                    @error('linkedin')
                    <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                    </div>
                    @enderror
                </div>
                <div class="container-form-email">
                    <label for="twitter">{!! __('messages.dashbard_workerz.link__word')}} twitter</label>
                    <input placeholder="https://twitter.be" type="text" id="twitter"
                           @if(auth()->user()) value="{{auth()->user()->twitter}}" @endif
                           class=" @error('twitter') is-invalid @enderror email-label" name="twitter">

                    @error('twitter')
                    <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                    </div>
                    @enderror
                </div>
            @endif
            <div class="button-save-company">
                @if(!\Illuminate\Support\Facades\Auth::user())
                    <input id="priceId" name="priceId" type="hidden" value="{{$plan}}">
                    <input id="role_id" name="role_id" type="hidden" value="2">
                    <input id="plan_user_id{{$plan}}" name="plan_user_id" type="hidden" value="{{$plan}}">
                    <input id="plan{{$plan}}" name="plan" type="hidden" value="{{$plan}}">
                    <input id="type" name="type" type="hidden" value="company">
                    <input id="{{$planName}}" name="lookup_key" type="hidden" value="{{request('lookup_key')}}">
                    <input type="hidden" name="type" value="company">
                    <button role="button" class="button-cta button-register-company" name="company" type="submit">
                        {!! __('messages.finish__sub')}}
                    </button>
                @else
                    <button role="button" class="button-cta" name="company" type="submit">
                        {!! __('messages.save__info__btn')}}
                    </button>
                @endif

            </div>
        </div>

    </form>
</div>
@section('scripts')
    @if(Session::get('applocale') === 'en')
        @if($plan == 1)
            <script src="{{asset('js/en/checkDataMaxOptions.js')}}"></script>
        @endif
        @if($plan == 2)
            <script src="{{asset('js/en/checkDataMaxOptions2.js')}}"></script>
        @endif
        @if($plan == 3)
            <script src="{{asset('js/en/checkDataMaxOptions3.js')}}"></script>
        @endif
    @elseif(Session::get('applocale') === 'nl')
        @if($plan == 1)
            <script src="{{asset('js/nl/checkDataMaxOptions.js')}}"></script>
        @endif
        @if($plan == 2)
            <script src="{{asset('js/nl/checkDataMaxOptions2.js')}}"></script>
        @endif
        @if($plan == 3)
            <script src="{{asset('js/nl/checkDataMaxOptions3.js')}}"></script>
        @endif
    @else
        @if($plan == 1)
            <script src="{{asset('js/checkDataMaxOptions.js')}}"></script>
        @endif
        @if($plan == 2)
            <script src="{{asset('js/checkDataMaxOptions2.js')}}"></script>
        @endif
        @if($plan == 3)
            <script src="{{asset('jscheckDataMaxOptions3.js')}}"></script>
        @endif
    @endif
    <script src="{{asset('js/passwordCheck.js')}}"></script>
    <script src="{{asset('js/passwordSee.js')}}"></script>
    <script src="{{asset('js/previewPicture.js')}}"></script>
@endsection
