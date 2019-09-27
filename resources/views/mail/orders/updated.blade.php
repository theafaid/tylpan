@component('mail::message')
    # Hey {{$order->owner->defaultName}},

    <p>We have been made some changes of your order {{$order->formattedCode}} in {{general_settings('site_name')}}.</p>
    <p>Please check the updated data</p>
    <hr>

    @component('mail::button', ['url' => route('orders.show', $order->code)])
        From Here
    @endcomponent

    <hr>

    Thanks,<br>
    {{ general_settings('site_name') }}
@endcomponent
