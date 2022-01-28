@component('mail::message')
# Een nieuwe gebruiker heeft zich geregistreerd!

## Dit is een rol gebruiker @if($user->role["name"]) gebruiker | "Ik ben op zoek naar een bedrijf @else Ik ben een bedrijf. @endif, met een plattegrond {{$user->plan_user['name']}}

### Naam :
{{$user["name"]}}


@component('mail::button',['url' => env('APP_URL').'/nova'])
Ga naar het dashboard
@endcomponent

@endcomponent
