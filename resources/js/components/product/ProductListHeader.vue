<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import { Plus } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
import gsap from 'gsap';

function handleMouseEnter() {
    gsap.to('.overlay', {
        width: "100%",
        transformOrigin: 'right',
        ease: 'power1'
    })
}

function handleMouseLeave() {
    gsap.to('.overlay', {
        width: "0%",
        transformOrigin: 'right',
        ease: 'power1'
    })
}
</script>

<template>
    <div class="w-full flex justify-between p-4">
        <h2 class="font-semibold text-lg">Produk</h2>
        <Button 
            @mouseenter="handleMouseEnter" 
            @mouseleave="handleMouseLeave"
            class="group flex relative bg-blue-800 rounded-[4px] overflow-hidden text-white"
        >
            <div class="overlay w-0 h-full absolute left-0 bg-blue-900 rounded-md z-0" />

            <Plus class="size-4 z-10" />
            <Link href="/products/create" class="z-10">Tambah Produk</Link>
        </Button>
    </div>
</template>