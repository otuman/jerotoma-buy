@component('mail::message')
Hi {{$user->firstName}},<br>

Thank you for buying item in our store, the payment was completed
You can view your order at the link below <br>

@component('mail::button', ['url' => $url])
View Order
@endcomponent

@component('mail::panel')
The order # is {{$order->id}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
