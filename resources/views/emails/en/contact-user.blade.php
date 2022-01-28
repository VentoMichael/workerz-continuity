@component('mail::message')
# We acknowledge receipt of your message via our contact form

## Here is the copy:

### Subject:
{{$data["subject"]}}

<br />

___

<br />

### Message:

{{$data["message"]}}

@component('mail::button',['url' => env('APP_URL').'/workers'])
The new independents
@endcomponent

@endcomponent
