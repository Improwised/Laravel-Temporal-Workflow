@component('mail::message')
Hello {{$name}},

Welcome to the {{ env('APP_NAME') }}


@component('mail::button', ['url' => config('app.url')])
	Visit
@endcomponent

Thank you


![alt text]({{asset('logo.png')}} "{{ env('APP_NAME') }}")


@endcomponent