<script setup lang="ts">
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { 
    Popover ,
    PopoverTrigger,
    PopoverContent
} from '@/components/ui/popover';
import { EllipsisVertical, Trash, Repeat } from 'lucide-vue-next';
import { onMounted } from 'vue';
import gsap from 'gsap';
import { IProduct } from '@/lib/types/product.type';

const { products } = defineProps<{ products: IProduct[] }>();

const productsData = products ?? []

onMounted(() => {
    const tl = gsap.timeline()
    
    tl.fromTo('.table-head-group', { opacity: 0, y: 100 }, {
        opacity: 1,
        y: 0,
        stagger: 0.1,
        ease: 'power1'
    })
    .fromTo('.table-cell-group', { opacity: 0, y: 100 }, {
        opacity: 1,
        y: 0,
        stagger: 0.3,
        ease: 'power1'
    })
})
</script>

<template>
    <Table>
        <TableHeader class=" h-20 bg-slate-200 rounded-md p-3">
            <TableRow class="table-head-group">
                <TableHead class="font-semibold text-md px-4 rounded-l-md">Nama Produk</TableHead>
                <TableHead class="font-semibold text-md px-4">Varian</TableHead>
                <TableHead class="font-semibold text-md px-4">Tipe Produk</TableHead>
                <TableHead class="font-semibold text-md px-4">Kategori</TableHead>
                <TableHead class="font-semibold text-md px-4">Harga Jual</TableHead>
                <TableHead class="font-semibold text-md px-4">Waktu Dibuat</TableHead>
                <TableHead class="font-semibold text-md px-4">Status</TableHead>
                <TableHead class="font-semibold text-md px-4 rounded-r-md"></TableHead>
            </TableRow>
        </TableHeader>
        <TableBody>
            <TableRow v-for="product, index in productsData" :key="index" class="table-cell-group">
                <TableCell class="text-md px-4 bg-slate-100 py-4 rounded-md flex gap-5 justify-center items-center">
                    <img src="/profile.png" class="w-14 h-14 p-1 bg-sky-200 rounded-md object-cover" alt="">
                    <div class="space-y-2">
                        <p class="font-semibold text-sm">{{ product.name }}</p>
                        <p class="text-sm">({{ product.sku }})</p>
                    </div>
                </TableCell>
                <TableCell class="text-md p-4 bg-slate-100 rounded-md">{{ product.variants }}</TableCell>
                <TableCell class="text-md p-4 bg-slate-100 rounded-md">{{ product.type }}</TableCell>
                <TableCell class="text-md p-4 bg-slate-100 rounded-md">
                    <h2 class="rounded-full p-1 bg-slate-200 flex justify-center items-center">{{ product.category_id }}</h2>
                </TableCell>
                <TableCell class="text-md p-4 bg-slate-100 rounded-md">Rp. {{ product.variants[0]?.capital_price }} - Rp. {{ product.variants[0]?.sell_price }}</TableCell>
                <TableCell class="text-md p-4 bg-slate-100 rounded-md">{{ product.createdAt }}</TableCell>
                <TableCell class="text-md p-4 bg-slate-100 rounded-md">{{ product.status }}</TableCell>
                <TableCell class="text-md p-4 bg-slate-100 rounded-md">
                    <Popover>
                        <PopoverTrigger as-child class="cursor-pointer">
                            <EllipsisVertical class="size-5 text-blue-800" />
                        </PopoverTrigger>
                        <PopoverContent class="bg-white w-50 text-blue-800">
                            <div class="p-3 py-4 flex font-medium hover:bg-blue-100 rounded-md items-center gap-3">
                                <Trash class="size-5"/>
                                <p>Hapus Produk</p>
                            </div>
                            <div class="p-3 py-4 flex font-medium hover:bg-blue-100 rounded-md items-center gap-3">
                                <Repeat class="size-5"/>
                                <p>Edit Produk</p>
                            </div>
                        </PopoverContent>
                    </Popover>
                </TableCell>
            </TableRow>
        </TableBody>
    </Table>
</template>