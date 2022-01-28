@component('mail::message')
# Nieuw bericht van {{$data["name"]}} via het contactformulier

## Naam :
{{$data["name"]}}

<br />

___

<br />

### Onderwerp:

{{$data["subject"]}}

___

<br />

### Bericht :

{{$data["message"]}}


@component('mail::button',['url' => env('APP_URL').'/nova'])
Zie in het dashboard
@endcomponent

@endcomponent
