<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

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
        'variants',
        'created_at',
    ];

    protected $casts = [
        'status' => 'boolean',
        'variants' => 'array',
    ];

    function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', '_id');
    }
    
}
