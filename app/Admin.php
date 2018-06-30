<?php

namespace App;

use App\Traits\Filtering;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes, Filtering;

    /**
     * Admins table.
     *
     * @var string
     */
    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * Run functions on boot.
     *
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            //$model->password = bcrypt($model->password);
        });
    }

    /**
     * The admin has many roles.
     *
     * @return array object
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * The admin belongs to a store.
     *
     * @return object
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
