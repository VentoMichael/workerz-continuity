<div class="container-register-form container-register">
    <div class="container-form-email">
        <label for="catchPhrase">{!! __('messages.dashboard_workerz.sentence__accroche')!!}</label>
        <input type="text" id="catchPhrase"
               @if(auth()->user()) value="{{$announcement->catchPhrase}}"
               @else value="{{old("catchPhrase")}}" @endif
               class="email-label" name="catchPhrase"
               placeholder="{!! __('messages.ads.placeholder__catch__update')!!}">
        <p class="help informations">
            {!! __('messages.ads.help__catch')!!}
        </p>
    </div>
    <div class="container-form-email">
        <div class="avatar-container">
            <label for="picture">{!! __('messages.dashoard_workerz.profil__picture')!!}</label>
            <img width="150" height="150" id="output" class="preview-picture" alt="{!! __('messages.dashboard_workerz.profil__picture')!!}"/>
        </div>
        <input type="file"
               id="picture"
               class="input-field @error('picture') is-invalid @enderror email-label"
               name="picture"
               accept="image/png, image/jpeg">
        @error('picture')
        <p class="danger help">
            {{$errors->first('picture')}}
        </p>
        @enderror
    </div>
</div>
<div class="container-register-form container-register">
    <div class="container-form-email category-input container-title-ad">
        <label for="title">{!! __('messages.title__ad_up')!!} <span class="required">*</span></label>
        <input type="text" id="title" @if(auth()->user()) value="{{$announcement->title}}"
               @else value="{{old("title")}}" @endif
               class=" @error('title') is-invalid @enderror email-label" name="title"
               required aria-required="true" placeholder="{!! __('messages.ads.placeholder__title')!!}">
        @error('title')
        <p class="danger help">
            {{$errors->first('title')}}
        </p>
        @enderror
    </div>
    <div class="container-form-email container-email-form category-input container-title-ad">
        <label for="location">{!! __('messages.ads.location__label')!!} <span class="required">*</span></label>
        <select required aria-required="true" class="select-register select-regions"
                data-maxoption="1" name="location" id="location">
            <option value="0" disabled selected>{!! __('messages.ads.fOption__label')!!}</option>
            @foreach($regions as $region)
                @if(Session::get('applocale') === 'en')
                    <option
                    @if(auth()->user() && $announcement->province_id == $region->id) selected
                    @endif value="{{$region->id}}">{{$region->name_en}}</option>
                @elseif(Session::get('applocale') === 'nl')
                    <option
                    @if(auth()->user() && $announcement->province_id == $region->id) selected
                    @endif value="{{$region->id}}">{{$region->name_nl}}</option>
                @else
                    <option
                    @if(auth()->user() && $announcement->province_id == $region->id) selected
                    @endif value="{{$region->id}}">{{$region->name}}</option>
                @endif

            @endforeach
        </select>
        @error('location')
        <p class="danger help">
            {{$errors->first('location')}}
        </p>
        @enderror
    </div>
</div>

<div class="container-register-form container-announcement-create container-register">
    <div class="container-form-email">
        <label for="job">{!! __('messages.ads.label__job')!!} <span class="required">*</span></label>
        <input placeholder="{!! __('messages.max__notdetermined')!!}" type="text"
               id="job" @if(auth()->user()) value="{{$announcement->job}}"
               @else value="{{old("job")}}" @endif
               class=" @error('job') is-invalid @enderror email-label" name="job" required
               aria-required="true">
        @error('job')
        <p class="danger help">
            {{$errors->first('job')}}
        </p>
        @enderror
    </div>
    <div class="container-form-email category-input container-title-ad">

        <label for="categoryAds">{!! __('messages.ads.label__category')!!} <span class="required">*</span></label>
        <div class="container-filter-categories container-category">
            <ul class="list-categories">
                @foreach($categories as $c)
                    <li>
                        <input role="checkbox"
                               @if(auth()->user() && $announcement_categories->contains($c->id)) checked
                               @endif aria-checked="false"
                               class="checkCat hiddenCheckbox inp-cbx" name="categoryAds[]"
                               id="categoryAds{{$c->id}}" type="checkbox"
                               value="{{$c->id}}"/> <label class="cbx"
                                                           for="categoryAds{{$c->id}}">
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
        <p class="danger dangerCategory help">
            {{$errors->first('categoryAds')}}
        </p>
        @enderror
        @if($plan == 1)
            <p class="help informations"><a href="{{route('announcements.create')}}#plans">{!! __('messages.upgrade_plan')!!}</a> {!! __('messages.upgrade__possibilityto3')!!}</p>
        @endif
        @if($plan == 2)
            <p class="help informations">{!! __('messages.upgrade__to__2')!!}</p>
        @endif
        @if($plan == 3)
            <p class="help informations">{!! __('messages.upgrade__to__3')!!}</p>
        @endif


    </div>
</div>

<div class="container-register-form container-register @if(!auth()->user()) container-job-ads-create @endif">
    <div class="container-form-email">
        <label for="pricemax">{!! __('messages.ads.max__authorized')!!}</label>
        <input max="999999" type="text" pattern="^[0-9-+\s()]*$" id="pricemax"
               name="pricemax"
               @if(auth()->user()) value="{{$announcement->pricemax}}"
               @else value="{{old("pricemax")}}" @endif
               class="email-label" maxlength="999999" placeholder="500"><span
            class="horary-cost">€</span>
        @error('pricemax')
        <p class="danger dangerCategory" style="font-size: .8em;position: absolute;bottom: -6px;">
            {{$errors->first('pricemax')}}
        </p>
        @enderror
        <p class="help hepl-price informations">
            {!! __('messages.ads.help__price')!!}
        </p>
    </div>
    <div class="container-form-email selectdiv">
        <label for="startmonth">{!! __('messages.ads.label__start__month')!!} <span
                class="required">*</span></label>
        <div class="container-filter-categories container-category">

            <ul class="list-categories">
                @foreach($disponibilities as $disponibility)
                    <li id="checkDispo">
                        <input role="checkbox"
                               @if(auth()->user() && $announcement->start_month_id == $disponibility->id) checked
                               @endif aria-checked="false"
                               class="checkDispo hiddenCheckbox inp-cbx"
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
        <p class="danger dangerCategory help">
            {{$errors->first('startmonth')}}
        </p>
        @enderror
        <p class="help informations">{!! __('messages.possibility__to__one__only')!!}</p>

    </div>

</div>

<div>
    <div class="container-form-email">
        <div class="container-maxCharacters">
            <label for="description">{!! __('messages.dasboard_workerz.description')!!} <span class="required">*</span></label>
            <span class="maxCharacters">{!! __('messages.ads.max__caractere')!!}</span>
        </div>
        <textarea id="description" name="description" required
                  class=" @error('description') is-invalid @enderror email-label"
                  placeholder="{!! __('messages.ads.description_ad')!!}"
                  rows="5" cols="33">@if(auth()->user()){{$announcement->description}} @else{{old("description")}} @endif</textarea>
        @error('description')
        <p class="danger help">
            {{$errors->first('description')}}
        </p>
        @enderror
    </div>
</div>
<div class="container-draft-publish-dashboard container-btn-draft">
    @if($announcement->is_draft === 1)
    <div class="link-back">
        <button class="button-back button-cta button-draft" name="publish">
            {!! __('messages.ads.post')!!}
        </button>
    </div>
    @endif
    <div class="container-buttons-ads btn-save-dashboard">
        <button role="button" class="button-cta" type="submit">
            {!! __('messages.ads.save__data')!!}
        </button>
    </div>
</div>
