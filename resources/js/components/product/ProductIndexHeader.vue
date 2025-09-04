<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import { Plus } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="w-full flex justify-between p-4">
        <h2 class="font-semibold block text-lg">Produk</h2>
        <Button 
            class="group max-md:ml-auto flex relative bg-blue-800 rounded-[4px] overflow-hidden text-white"
        >
            <div class="w-0 group-hover:w-full origin-right transition-all duration-300 h-full absolute left-0 bg-blue-900 rounded-md z-0" />

            <Plus class="size-4 z-10" />
            <Link href="/products/create" class="z-10">Tambah Produk</Link>
        </Button>
    </div>
</template>