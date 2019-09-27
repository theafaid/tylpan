<?php

namespace App\Eloquent;

class Orders
{
    /**
     * Store a new order
     * @param $data
     * @return mixed
     */
    public function store($user, $data)
    {
        return $user->orders()->create([
            'code' => time(),
            'specializations' => json_encode($data['specializations']),
            'budget' => $data['budget'],
        ]);
    }

    /**
     * Update an order
     * @param $order
     * @param $data
     */
    public function update($order, $data)
    {
        $order->update($data);
    }

    /**
     * Assign a country to an order
     * @param $order
     * @param $countries
     */
    public function assignCountries($order, $countries, $sync = false)
    {
        $orderCountries = $order->countries();

        $sync ? $orderCountries->syncWithoutDetaching($countries) : $orderCountries->attach($countries);
    }

    /**
     * Assign a university to an order
     * @param $order
     * @param $universities
     */
    public function assignUniversities($order, $universities, $sync = false)
    {
        $orderUniversities = $order->universities();

        $sync ? $orderUniversities->syncWithoutDetaching($universities) : $orderUniversities->attach($universities);
    }


    /**
     * Assign a delegate to an order
     * @param $order
     * @param $delegateId
     * @return mixed
     */
    public function assignTo($order, $delegateId)
    {
        $order->update(['delegate_id' => $delegateId, 'delegate_assigned_by' => auth()->id()]);

        return $order->delegate;
    }

    /**
     * Check if the passed delegate is assigned to any of the passed orders
     * @param $orders
     * @param $suspect
     * @return bool
     */
    public function isDelegateForAnyOf($orders, $suspect)
    {
        return $orders->pluck('delegate_id')->contains($suspect->id);
    }

    /**
     * Assign a task to an order
     * @param $order
     * @param $data
     * @param $user
     * @return array
     */
    public function addTask($order, $data, $user)
    {
        return $order->tasks()->create([
            'task_from' => $user->id,
            'task_for'  => $data['task_for'],
            'task'      => $data['task'],
            'status'    => 'progressing',
        ]);
    }

    /**
     * Dismiss a delegate from a specific order
     * @param $order
     */
    public function dismissDelegateFrom($order)
    {
        $order->update(['delegate_id' => null]);
    }
}
