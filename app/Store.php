<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /**
     * Stores table.
     *
     * @var string
     */
    protected $table = 'stores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address'
    ];

    /**
     * The store has many admins.
     *
     * @return array object
     */
    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    /**
     * The store has many products.
     *
     * @return array object
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
