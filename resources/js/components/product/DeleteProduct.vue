<script setup lang="ts">
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/components/ui/dialog'
import DialogClose from '@/components/ui/dialog/DialogClose.vue';
import Button from '@/components/ui/button/Button.vue';
import { route } from 'ziggy-js';
import axios from 'axios';
import { router } from '@inertiajs/vue3';

const { id } = defineProps<{ id: string }>()

async function handleDelete() {
  try {
    await axios.delete(route('products.destroy', { id: id }))
    
    router.visit(route('products.index'))
  } catch (err) {
    console.error(err)
  }
}
</script>

<template>
  <Dialog>
    <DialogTrigger as-child>
      <slot />
    </DialogTrigger>
    <DialogContent class="bg-white w-96 md:min-w-[700px]">
      <DialogHeader class="text-start">
        <DialogTitle class="text-blue-950">Yakin ingin menghapus produk?</DialogTitle>
        <DialogDescription>
          Setelah dihapus, produk ini tidak bisa dikembalikan. 
          Pastikan kamu yakin sebelum melanjutkan
        </DialogDescription>
      </DialogHeader>

      <DialogFooter class="flex ml-auto">
        <div class="flex gap-3">
          <DialogClose class="bg-slate-100 rounded-lg px-3 font-semibold text-blue-800">Batal</DialogClose>
          <Button @click="handleDelete" class="bg-blue-800 text-white">Hapus</Button>
        </div>
      </DialogFooter>
    </DialogContent>
  </Dialog>
</template>