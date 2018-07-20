<?php

namespace App;

use App\Traits\Filtering;
use App\Traits\Imaging;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes, Filtering, Imaging;

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
        'image', 'name', 'address'
    ];

    /**
     * Run functions on boot.
     *
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            static::storeImage($model);
        });

        static::updating(function ($model) {
            static::updateImage($model);
        });

        static::deleting(function ($model) {
            static::deleteImage($model);
        });
    }

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

    /**
     * The store has many sales.
     *
     * @return array object
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
