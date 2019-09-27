<?php

namespace App\Models;

use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\Datatable\Dataviewer;

class Order extends Model
{
    use Dataviewer, HasStatus;

    protected $guarded = [];

    protected $appends = ['formattedStatus', 'formattedCode', 'formattedBudget'];

    protected $allowedFilters = [
        'code', 'status', 'budget', 'created_at', 'updated_at',
        'owner.first_name', 'owner.last_name', 'owner.email', 'owner.role', 'owner.phone_number',
        'delegate.first_name', 'delegate.last_name', 'delegate.email', 'delegate.role', 'delegate.phone_number',
        'owner.country.name', 'delegate.country.name',
        'countries.count', 'universities.count', 'tasks.count',
    ];

    protected $orderable = [
        'created_at', 'updated_at', 'status', 'budget',
    ];

    /**
     * @return mixed|string
     */
    public function getRouteKeyName()
    {
        return "code";
    }

    /**
     * @return string
     */
    public function getFormattedCodeAttribute()
    {
        return "#{$this->code}";
    }

    /**
     * @return string
     */
    public function getFormattedBudgetAttribute()
    {
        return "{$this->budget}$";
    }

    /**
     * @return string
     */
    protected function defaultDescriptionMessage()
    {
        return
            "Please wait until we assign a delegate in your country for you. We will not be late.";
    }

    /**
     * @param $value
     * @return string|null
     */
    public function getDescriptionForCreatorAttribute($value)
    {
        if ($value) return $value;

        return !$value && !$this->delegate_id ? $this->defaultDescriptionMessage() : null;
    }

    /**
     * @param $builder
     * @param $delegate
     */
    public function scopeAssignedTo($builder, $delegate) {
         $builder->where('delegate_id', $delegate->id);
    }

    /**
     * Determine if the order has assigned to a delegate
     * @return bool
     */
    public function isAssignedToDelegate()
    {
        return !!$this->delegate_id;
    }

    /**
     * Get the person who assigned the delegate to this order
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignor()
    {
        return $this->belongsTo(User::class, 'delegate_assigned_by', 'id');
    }
    /**
     * Check if the order creator is the passed user
     * @param $user
     * @return bool
     */
    public function ownedBy($user)
    {
        return $user->id == $this->user_id;
    }

    /**
     * Get the country of the order creator
     * @return mixed
     */
    public function ownerCountry()
    {
        return $this->owner->country;
    }
    /**
     * Get order countries
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function countries()
    {
        return $this->belongsToMany(Country::class);
    }

    /**
     * Get order universities
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function universities()
    {
        return $this->belongsToMany(University::class);
    }

    /**
     * Get the creator of the order
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the order delegate
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function delegate()
    {
        return $this->belongsTo(User::class, 'delegate_id', 'id');
    }

    /**
     * Fetch order tasks
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
