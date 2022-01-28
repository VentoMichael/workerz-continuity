@component('mail::message')
# Attentie, er is nog maar één dag voor uw advertentie {{$data["title"]}}

@component('mail::button',['url' => env('APP_URL').'/dashboard/ads'])
Ik kom het opwaarderen
@endcomponent

@endcomponent
