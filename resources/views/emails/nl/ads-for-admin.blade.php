@component('mail::message')
# Er is een advertentie toegevoegd {{$data["title"]}}

## Naam :

{{$data["title"]}}

<br/>

___

<br/>

## Functieomschrijving :

{{$data["job"]}}

<br/>

___

<br/>

## Beschrijving :

{{$data["description"]}}


@component('mail::button',['url' => env('APP_URL').'/announcements/'.strtolower($data["title"])])
Advertentie bekijken
@endcomponent

@endcomponent
