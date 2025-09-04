<script setup lang="ts">
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/components/ui/dialog'
import DialogClose from '@/components/ui/dialog/DialogClose.vue';
import Button from '@/components/ui/button/Button.vue';
import ProductForm from './ProductForm.vue';
import { route } from 'ziggy-js';
import axios from 'axios';
import { router } from '@inertiajs/vue3';

const { id } = defineProps<{ id: string }>()
</script>

<template>
  <Dialog>
    <DialogTrigger as-child>
      <slot />
    </DialogTrigger>
    <DialogContent class="bg-white w-96 md:min-w-[700px] h-96 min-h-[600px] overflow-y-scroll">
        <DialogHeader class="text-start">
            <DialogTitle class="text-blue-950">Edit Produk</DialogTitle>
        </DialogHeader>

        <ProductForm event="update-product" :id="id"/>

        <div class="flex gap-3 ml-auto">
            <DialogClose class="bg-slate-100 rounded-lg px-3 font-semibold text-blue-800">Batal</DialogClose>
            <button form="update-product" type="submit" class="bg-blue-800 px-2 py-1 rounded-md text-white">Edit</button>
        </div>
    </DialogContent>
  </Dialog>
</template>