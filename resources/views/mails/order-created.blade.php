@component('mail::message')
Hi {{$user->firstName}},<br>

You've created order with {{ config('app.name') }} <br>
The order is at {{$order->status}} status

@component('mail::button', ['url' => $url])
View Order
@endcomponent

@component('mail::panel')
The order # is {{$order->id}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
