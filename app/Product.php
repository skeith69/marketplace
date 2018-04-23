<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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
        'store_id', 'category_id', 'name',
        'description', 'price', 'status'
    ];

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
