@component('mail::message')
# A new mail in your message box!
{{$message->user->name}} You have sent a message
<br />

___

The message contains:
{{$message->content}}

@component('mail::button',['url' => env('APP_URL').'/dashboard/messages'])
I will see
@endcomponent

@endcomponent
