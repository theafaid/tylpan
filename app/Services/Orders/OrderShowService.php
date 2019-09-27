<?php

namespace App\Services\Orders;

use App\Caching\Countries;

class OrderShowService
{
    protected $countries;

    /**
     * OrderShowService constructor.
     * @param Countries $countries
     */
    public function __construct( Countries $countries)
    {
        $this->countries = $countries;
    }

    /**
     * @param $order
     * @return array
     */
    public function handleData($order)
    {
        $owner = $order->owner;

        $owner['country'] = $this->ownerCountry($owner);

        return [
            'order' => $order,
            'owner' => $owner,
            'delegate' => $order->isAssignedToDelegate() ? $order->delegate : null,
            'universities' => $order->universities,
            'countries' => $order->countries()->select(['name', 'flag', 'alpha2_code'])->get(),
        ];
    }

    /**
     * Get the country where owner from it
     * @param $owner
     * @return mixed
     */
    protected function ownerCountry($owner)
    {
        return $this->countries->allowedTravelFrom()->where('id', $owner->country_id)->first();
    }
}
