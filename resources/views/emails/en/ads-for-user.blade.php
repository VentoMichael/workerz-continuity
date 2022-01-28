@component('mail::message')
# A new ad, stay calm, someone will contact you!

## Brief description of your new ad

### Name of the ad :

{{$data["title"]}}

<br/>

___

<br/>

### Selected job:

{{$data["job"]}}

<br/>

___

<br/>

### Description:

{{$data["description"]}}


@component('mail::button',['url' => env('APP_URL').'/dashboard/ads'])
See my ad
@endcomponent

@endcomponent
