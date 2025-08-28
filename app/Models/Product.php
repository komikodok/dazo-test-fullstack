<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Product extends Model
{
    protected $collection = 'products';
    protected $connection = 'mongodb';

    protected $fillable = [
        'name',
        'sku',
        'type',
        'category_id',
        'status',
        'createdAt',
        'variant',
    ];

    protected $casts = [
        'status' => 'boolean',
        'variant' => 'array',
    ];

    function category(){
        return $this->belongsTo(Category::class, 'category_id', '_id');
    }
    
}
