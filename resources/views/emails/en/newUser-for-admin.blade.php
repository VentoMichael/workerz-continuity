@component('mail::message')
# A new user has registered!

## This is a role user @if($user->role["name"]) user | "I am looking for a company" @else company | "I am a company" @endif, with a level plan {{$user->plan_user['name']}}

### Name:
{{$user["name"]}}


@component('mail::button',['url' => env('APP_URL').'/nova'])
Go to the dashboard
@endcomponent

@endcomponent
