@component('mail::message')
# The beginning of your great adventure!

## Your account now gives you access to a multitude of features, [I'll get to that right away.]({{env('APP_URL').'/dashboard'}})

## You can now post an ad.
Did you know that you can attract a lot of customers with your ad? I'm sure it will be a hit! [I will post one.]({{env('APP_URL').'/announcement/plans'}})


Thank you for your trust, {{$user["name"]}}.

@component('mail::button',['url' => env('APP_URL').'/login'])
I connect
@endcomponent

@endcomponent

