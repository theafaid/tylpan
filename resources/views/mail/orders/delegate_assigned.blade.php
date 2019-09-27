@component('mail::message')
# Hey {{$order->owner->defaultName}},

<p>We have assigned a delegate in your country for you.</p>
<p>Now {{$delegate->fullName}} exists in {{$delegate->country->name}} and will be the person who help you till the end.</p>
<p>Feel free to contact {{$delegate->defaultName}} anytime you want.</p>

<hr>

@component('mail::button', ['url' => route('orders.show', $order->code)])
    Contact My Delegate
@endcomponent

<hr>

Thanks,<br>
{{ general_settings('app_name') }}
@endcomponent
