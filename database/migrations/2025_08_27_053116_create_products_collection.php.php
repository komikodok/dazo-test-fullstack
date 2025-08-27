<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('mongodb')->create('products', function ($collection) {
            $collection->index('name');          
            $collection->index('category_id');   
            $collection->index('sku');           
            $collection->index('status');        
            $collection->index('stock');         
            $collection->index('cost_price');   
            $collection->index('sell_price');   
            $collection->index('special_price'); 
            $collection->index('type');          
            $collection->index('createdAt');    

            $collection->unique('sku');
        });
    }

    public function down(): void
    {
        Schema::connection('mongodb')->dropIfExists('products');
    }
};
