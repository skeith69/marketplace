<?php

namespace App;

use App\Traits\Filtering;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes, Filtering;

    /**
     * Roles table.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'description'
    ];

    /**
     * Eager load the relationships
     *
     * @var array
     */
    protected $with = [
        'permissions'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The roles has many admins.
     *
     * @return array object
     */
    public function admins()
    {
        return $this->belongsToMany(Admin::class);
    }

    /**
     * The role has many permissions.
     *
     * @return array object
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
