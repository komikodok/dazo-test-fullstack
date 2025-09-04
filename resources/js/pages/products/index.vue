<script setup lang="ts">
import AppLayout from '@/components/layout/AppLayout.vue';
import ProductIndexHeader from '@/components/product/ProductIndexHeader.vue';
import ProductDataTable from '@/components/product/ProductDataTable.vue';
import ProductDataMobile from '@/components/product/ProductDataMobile.vue';
import { IPaginatedProduct, IProduct } from '@/lib/types/product.type';

const { products } = defineProps<{ products: IPaginatedProduct<IProduct> }>();

</script>

<template>
    <AppLayout>
        <div class="w-full px-6 bg-slate-100">
            <div class="w-full h-20 flex items-center">
                <h2 class="text-xl font-bold">Daftar Produk</h2>
            </div>

            <div class="w-full h-full bg-white rounded-lg">
                <ProductIndexHeader />

                <div class="px-4">
                    <div class="max-md:hidden">
                        <ProductDataTable :products="products" />
                    </div>

                    <div class="md:hidden">
                        <ProductDataMobile :products="products" />
                    </div>
                </div>

                <div class="px-4 flex justify-end">
                </div>
            </div>
        </div>
    </AppLayout>
</template>