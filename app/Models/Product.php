<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'products';

    protected $fillable = [
        'name',           
        'category_id',    
        'sku',            
        'status',         
        'stock',          
        'cost_price',     
        'sell_price',     
        'special_price',  
        'imageUrl',       
        'variants',       
        'type',          
        'createdAt',      
    ];

    protected $casts = [
        'status'        => 'boolean',
        'cost_price'    => 'decimal:2',
        'sell_price'    => 'decimal:2',
        'special_price' => 'decimal:2',
        'createdAt'     => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', '_id');
    }
}
