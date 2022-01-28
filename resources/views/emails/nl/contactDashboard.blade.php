@component('mail::message')
# Een nieuwe e-mail in je inbox!
{{$message->user->name}} je hebt een bericht gestuurd
<br />

___

Het bericht bevat:
{{$message->content}}

@component('mail::button',['url' => env('APP_URL').'/dashboard/messages'])
Ik zal zien.
@endcomponent

@endcomponent
