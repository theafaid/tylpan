<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use App\Support\Traits\Datatable\Dataviewer;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Dataviewer;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $appends = ['defaultName', 'fullName'];
    protected $with = ['profile'];

    protected $allowedFilters = [
        'id', 'first_name', 'last_name', 'role', 'active', 'created_at','email',
        // nested
        'country.name', 'country.alpha2_code',
    ];
    protected $orderable = [
        'id', 'first_name', 'last_name', 'created_at', 'role'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->middle_name . " " . $this->last_name;
    }

    /**
     * @return string
     */
    public function getDefaultNameAttribute()
    {
        return $this->first_name . "." . substr($this->last_name, 0, 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeAdmins($query)
    {
        return $query->whereIn('role', ['admin', 'super_admin']);
    }
    /**
     * @param $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-M-Y');
    }

    /**
     * Check if the user is admin
     * @return bool
     */
    public function isAdmin()
    {
        return in_array($this->role, ['admin', 'super_admin']);
    }

    /**
     * Check if the user is a normal user
     * @return bool
     */
    public function isDefaultUser()
    {

        return $this->role == 'user';
    }

    /**
     * Check if the user is a delegate
     * @return bool
     */
    public function isDelegate()
    {
        return $this->role == 'delegate';
    }

    public function isSuperAdmin()
    {
        return $this->role == 'super_admin';
    }

    /**
     * Fetch user profile
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Fetch user country
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Fetch user orders
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get all user tasks
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
