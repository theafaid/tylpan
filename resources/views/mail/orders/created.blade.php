@component('mail::message')
# Hey {{$order->owner->defaultName}},

<p>You have created your order {{$order->formattedCode}} in {{general_settings('site_name')}} successfully.</p>
<p>All you have to do no is waiting until we review your order and we taking an action according to your details.</p>
<p>We will assign a delegate for you, who exists in your country [{{$order->owner->country->name}}] and he/she will help you for all of what you want</p>

<hr>

@component('mail::button', ['url' => route('orders.show', $order->code)])
    Show my order details
@endcomponent

<hr>

Thanks,<br>
{{ general_settings('site_name') }}
@endcomponent
