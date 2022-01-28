@component('mail::message')
# Een nieuwe advertentie, hou je gemak, iemand zal contact met je opnemen!

## Korte beschrijving van uw nieuwe advertentie

### Naam van de advertentie :

{{$data["title"]}}

<br/>

___

<br/>

### Geselecteerde handel:

{{$data["job"]}}

<br/>

___

<br/>

### Beschrijving:

{{$data["description"]}}


@component('mail::button',['url' => env('APP_URL').'/dashboard/ads'])
Zie mijn advertentie
@endcomponent

@endcomponent
