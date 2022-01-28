@component('mail::message')
# Het begin van je grote avontuur!

## Uw account geeft u nu toegang tot een groot aantal functies. [Daar kom ik zo op.]({{env('APP_URL').'/dashboard'}})

## U kunt nu een advertentie plaatsen.
Wist je dat je met je advertentie veel klanten kunt aantrekken? Ik weet zeker dat het een grote hit wordt! [Ik ga er een posten.]({{env('APP_URL').'/announcement/plans'}})


Dank u voor uw vertrouwen, {{$user["name"]}}.

@component('mail::button',['url' => env('APP_URL').'/login'])
Ik log in
@endcomponent

@endcomponent

