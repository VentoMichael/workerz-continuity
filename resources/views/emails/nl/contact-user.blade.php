@component('mail::message')
# Wij bevestigen de ontvangst van uw bericht via ons contactformulier

## Hier is een kopie:

### Onderwerp :
{{$data["subject"]}}

<br />

___

<br />

### Bericht :

{{$data["message"]}}

@component('mail::button',['url' => env('APP_URL').'/workers'])
De nieuwe onafhankelijken
@endcomponent

@endcomponent
