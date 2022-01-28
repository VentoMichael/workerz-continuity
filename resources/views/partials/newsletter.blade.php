<section class="modal" id="modal" @if(request('newsletter') !== null) style="display: none" @endif>
    <div class="modal-header">
        <h3 aria-level="3" class="util-links title">
             {!! __('messages.ads.no__ads__text__one')!!} {!! __('messages.ads.no__ads__text__two')!!} <i>"@if($search){{$search}}@else{{request('search')}}@endif"</i>&nbsp;!
        </h3>
        <button data-close-button class="crossHideNewsletter" id="crossHide"></button>
    </div>
    <div class="modal-body form-newsletter-popup">
        <p>
             {!! __('messages.sub__news')!!}
        </p>
        <form action="{{route('newsletter.store')}}" method="POST"
              class="form-newsletter-container" title="{!! __('messages.label__sub__news')!!}"
              aria-label=" {!! __('messages.label__sub__news')!!}">
            @csrf
            <div class="form-newsletter">
                <label for="newsletterbox" style="margin-bottom: 10px;"> {!! __('messages.your_email')!!}</label>
                <input type="email" required name="newsletter" id="newsletterbox" class="input-newsletter"
                       placeholder="Albert01@gmail.com" aria-required="true">
            </div>
            <div class="form-example">
                <input type="submit" class="submit-newsletter" value="{!! __('messages.btn__inscription')!!}">
            </div>
        </form>
    </div>
</section>
