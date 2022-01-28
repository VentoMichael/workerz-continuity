@extends('layouts.appDashboard')
@section('content')
    @if (Session::has('success-ads'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="{!! __('messages.good__answer')}}">
            <p>{!!session('success-ads')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if($errors->has('message'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/cross.svg')}}" alt="{!! __('messages.bad__answer')}}">
            <p>{{$errors->first('message')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-messages">
            <h2 aria-level="2">
                {!! __('messages.mymsg__item__nav')}}
            </h2>
            <div class="container-form-ads container-form-msgs">
                <livewire:messenger>
                </livewire:messenger>
                <div class="container-profil-dashboard container-ads-dashboard container-messenger-profil">
                    <div class="container-picture-title-dashboard-ads  container-messenger">
                    </div>
                    @if($messages->count() > 20)
                        @if($messages->hasMorePages() || $messages->previousPageUrl())
                            <div class="link-next-previous">
                                @if($messages->hasMorePages())
                                    <div class="@if($messages->previousPageUrl()) noMorePage @endif nextLink-container">
                                        <a class="nextLink" title="{!! __('messages.conversation.see__next__msg')}}"
                                           href="{{ $messages->nextPageUrl() }}">
                                            {!! __('messages.conversation.see__next__msg')}}
                                        </a>
                                    </div>
                                @endif
                                @if($messages->previousPageUrl())
                                    <div class="previousLink-container">
                                        <a class="previousLink" title="{!! __('messages.conversation.see__previous__msg')}}"
                                           href="{{ $messages->previousPageUrl() }}">
                                            {!! __('messages.conversation.see__previous__msg')}}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endif
                    <section class="container-messages-all" id="container-message">
                        <div class="container-helper-message">
                            <h4 aria-level="4">
                                <span class="hidden"> {!! __('messages.conversation.selected__user')}}</span>{{$user->name}} {{$user->surname}}
                            </h4>
                        </div>
                        @foreach($messages as $message)
                            @if($message->content != null)
                                <div @if($message->user->id == $user->id) class="container-from-msg container-message"
                                     @endif class="container-message">
                                    <div class="container-picture-message">
                                        @if($message->user->picture)
                                            <img width="40" height="60" itemprop="image" src="{{ asset($message->user->picture) }}"
                                                 alt="{!! __('messages.ads.label__picture')}} {{ucfirst($message->user->name)}}"/>
                                        @else
                                            <img width="40" height="60" itemprop="image" src="{{asset('svg/user.svg')}}"
                                                 alt="{!! __('messages.ads.icone__ads__alt')}}">
                                        @endif
                                    </div>
                                    <div>
                                        <p class="date-message"> @if($message->receiver->id == $user->id)
                                                {!! __('messages.conversation.word__me')}} @else {{$message->user->name}} {{$message->user->surname}}, @endif {{$message->created_at->locale('en')->isoFormat('Do MMMM, H:mm')}}</p>
                                        <p class="content-message">{{$message->content}}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </section>
                    <form id="formMsg" class="form-login" style="position: relative" enctype="multipart/form-data"
                          aria-label="{!! __('messages.conversation.send__msg__to')}}{{$user->name}}" role="form" method="POST"
                          action="{{route('messages.post',[$user->slug])}}">
                        @csrf

                        <label for="message" class="hidden">{!! __('messages.conversation.put__msg')}}</label>
                        <textarea type="text" class="input-message @if($errors->has('message')) is-invalid @endif"
                                  placeholder="{!! __('messages.conversation.placeholder__form')}}" name="message"
                                  id="message"></textarea>

                        <input type="hidden" name="from_id" id="from_id" value="{{auth()->user()->id}}">
                        <input type="hidden" name="to_id" id="to_id" value="{{$user->id}}">
                        <button type="submit" id="btnMsgSend" class="submit-message" title="{!! __('messages.conversation.send__msg')}} {{$user->name}}"><span class="helpSendMsg" id="helpMsg">Ctrl + Enter</span></button>

                        @error('message')
                        <p class="danger help"
                           style="position: absolute;top: -10px;background: white;border-radius: 5px;padding: 0 3% 5px;margin-bottom: -3%;">
                            {{$errors->first('message')}}
                        </p>
                        @enderror
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/sendForm.js')}}"></script>
@endsection
