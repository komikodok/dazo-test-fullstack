<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import { Plus } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
import gsap from 'gsap';

</script>

<template>
    <div class="w-full flex justify-between p-4">
        <h2 class="font-semibold text-lg">Tambah Produk</h2>

        <div class="flex gap-4">
            <Button 
                class=" flex bg-slate-300 hover:bg-slate-400/70 rounded-[4px] overflow-hidden text-white"
            >
                <Link href="/products" class="text-blue-800 p-2">
                    Kembali
                </Link>
            </Button>
            
            <Button 
                class="group flex relative bg-gray-300 rounded-[4px] overflow-hidden text-white"
            >
                <span class="z-10 text-gray-500">Tambah Produk</span>
            </Button>
        </div>
    </div>
</template>