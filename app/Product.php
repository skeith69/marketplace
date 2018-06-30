<?php

namespace App;

use App\Traits\Filtering;
use App\Traits\Imaging;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, Filtering, Imaging;
    
    /**
     * Products table.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'store_id', 'category_id', 'name',
        'description', 'price', 'status'
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
     * The product belongs to a category.
     *
     * @return object
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * The product belongs to a store.
     *
     * @return object
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
