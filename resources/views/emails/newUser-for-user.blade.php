@component('mail::message')
# Le début de votre grande aventure !

## Votre compte vous donne maintenant accès à une multitude de particularités, [je vais voir ça de suite.]({{env('APP_URL').'/dashboard'}})

## Vous pouvez, dorénavant postez une annonce.
SSavez-vous que vous pouvez attirer énormément de client avec votre annonce ? J'en suis sur elle fera un carton ! [Je vais en poster une.]({{env('APP_URL').'/announcement/plans'}})


Nous vous remercions pour votre confiance, {{$user["name"]}}.

@component('mail::button',['url' => env('APP_URL').'/login'])
Je me connecte
@endcomponent

@endcomponent

