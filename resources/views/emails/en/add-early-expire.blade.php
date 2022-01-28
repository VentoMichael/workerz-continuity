@component('mail::message')
# Attention, there is only one day left to your ad {{$data["title"]}}

@component('mail::button',['url' => env('APP_URL').'/dashboard/ads'])
I come to upgrade it
@endcomponent

@endcomponent
