<?php

namespace App\Services\Admin\Orders;

use App\Eloquent\Orders;
use App\Events\Orders\OrderUpdated;
use Illuminate\Support\Arr;

class  OrderUpdateService
{
    protected $orders;

    public function __construct(Orders $orders)
    {
        $this->orders = $orders;
    }

    public function handle($order, $data)
    {
        if($data['basic']) {
            $this->orders->update($order, $this->basicData($data));
        } else {
            $this->orders->update($order, $this->additionalData($data));

            $this->orders->assignCountries($order, $data['countries'], $sync = true);

            $this->orders->assignUniversities($order, $data['universities'], $sync = true);
        }

        if(general_settings('allow_notifications'))
        {
            event(new OrderUpdated($order));
        }

    }

    protected function basicData($data)
    {
        return Arr::only($data, ['status', 'description_for_creator']);
    }

    protected function additionalData($data)
    {
        $data['specializations'] = json_encode($data['specializations'], JSON_UNESCAPED_SLASHES);

        return Arr::only($data, ['specializations', 'budget']);
    }
}
