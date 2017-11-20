@component('mail::message')
Hi #{{$user->firstName}},<br>
Congratulations for reaching this far, Please enjoy the service at our app
Your account with {{$user->email}} has been created!

@component('mail::button', ['url' => $url])
View Order
@endcomponent



Thanks,<br>
{{ config('app.name') }}
@endcomponent
