<script setup lang="ts">
import AppLayout from '@/components/layout/AppLayout.vue';
import ProductListHeader from '@/components/product/ProductListHeader.vue';
import ProductTable from '@/components/product/ProductTable.vue';
import { IProduct } from '@/lib/types/product.type';

const { products } = defineProps<{ products: IProduct[] }>();
</script>

<template>
    <AppLayout>
        <div class="w-full px-6 bg-slate-100">
            <div class="w-full h-20 flex items-center">
                <h2 class="text-xl font-bold">Daftar Produk</h2>
            </div>

            <div class="w-full h-full bg-white rounded-lg">
                <ProductListHeader />

                <div class="px-4">
                    <ProductTable :products="products" />
                </div>

                <div class="px-4 flex justify-end">
                </div>
            </div>
        </div>
    </AppLayout>
</template>