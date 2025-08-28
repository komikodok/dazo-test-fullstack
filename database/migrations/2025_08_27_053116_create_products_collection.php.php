<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('products', function ($collection) {
            $collection->index('name');
            $collection->index('sku');
            $collection->index('category_id');
            $collection->index('status');
            $collection->index('createdAt');
        });
    }

    public function down(): void
    {
        Schema::connection('mongodb')->dropIfExists('products');
    }
};
