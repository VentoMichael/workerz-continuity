@component('mail::message')
# An ad has been added {{$data["title"]}}

## Name:

{{$data["title"]}}

<br/>

___

<br/>

## Job:

{{$data["job"]}}

<br/>

___

<br/>

## Description:

{{$data["description"]}}


@component('mail::button',['url' => env('APP_URL').'/announcements/'.strtolower($data["title"])])
View ad
@endcomponent

@endcomponent
