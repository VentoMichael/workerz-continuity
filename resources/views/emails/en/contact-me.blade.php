@component('mail::message')
# New message from {{$data["name"]}} from the contact form

## Name:
{{$data["name"]}}

<br />

___

<br />

### Subject:

{{$data["subject"]}}

___

<br />

### Message:

{{$data["message"]}}


@component('mail::button',['url' => env('APP_URL').'/nova'])
See in the dashboard
@endcomponent

@endcomponent
