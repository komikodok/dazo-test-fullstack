<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import { Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
</script>

<template>
    <div class="w-full flex justify-between p-4">
        <h2 class="font-semibold text-lg">Tambah Produk</h2>

        <div class="flex gap-4">
        
            <Link 
                :href="route('products.index')" 
                class="group relative bg-slate-300 text-sm px-3 py-1 flex justify-center items-center rounded-md"
            >
                <div class="w-0 group-hover:w-full origin-right transition-all duration-300 h-full absolute left-0 bg-slate-400 rounded-md z-0" />
                <span class="z-10 text-blue-800 group-hover:text-white">Kembali</span>
            </Link>
            
            <button 
                type="submit"
                form="create-product"
                class="group flex relative justify-center items-center p-2 bg-gray-300 rounded-[4px] overflow-hidden"
            >
                <div class="w-0 group-hover:w-full origin-right transition-all duration-300 h-full absolute left-0 bg-blue-800 rounded-md z-0" />
                <span class="z-10 text-sm text-gray-500 group-hover:text-white">Tambah Produk</span>
            </button>
        </div>
    </div>
</template>