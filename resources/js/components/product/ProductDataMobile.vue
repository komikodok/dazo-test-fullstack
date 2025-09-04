<script setup lang="ts">
import { IProduct, IPaginatedProduct } from '@/lib/types/product.type';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { nextTick, onMounted } from 'vue';
import { Trash, Repeat } from 'lucide-vue-next';
import { defineProps, defineEmits } from 'vue';
import DeleteProduct from './DeleteProduct.vue';
import ProductPagination from './ProductPagination.vue';
import Switch from '@/components/ui/switch/Switch.vue';

const { products } = defineProps<{ products: IPaginatedProduct<IProduct> }>();

onMounted(async () => {
  await nextTick();
  gsap.registerPlugin(ScrollTrigger);

  const cards = gsap.utils.toArray('.product-data');

  cards.forEach((card, index) => {
    gsap.to(card as HTMLDivElement, {
      x: 300,
      opacity: 0,
      ease: 'power1',
      scrollTrigger: {
        trigger: card as HTMLDivElement,
        start: 'top top',
        end: 'bottom top',
        scrub: true,
        scroller: '.product-data-container',
      },
    });
  });
});

</script>

<template>
  <div
    class="product-data-container flex flex-col gap-6 overflow-y-scroll h-[430px] px-4 py-3"
  >
    <div
      v-for="(product, index) in products.data"
      :key="index"
      class="product-data bg-white rounded-2xl flex-shrink-0 shadow-lg overflow-hidden transform transition hover:-translate-y-2 hover:shadow-2xl duration-300 border border-gray-100"
    >
      <div class="relative">
        <img
          src="/sound.jpg"
          alt="product image"
          class="w-full h-48 object-cover"
        />
        <span
          class="absolute top-3 right-3 bg-gradient-to-r from-blue-600 to-blue-800 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md"
        >
          {{ product.category.name }}
        </span>
      </div>

      <div class="p-5 space-y-2">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-900">{{ product.name }}</h3>
            <Switch v-model="product.status" />
        </div>
        <p class="text-gray-500 text-sm font-medium">SKU: {{ product.sku }}</p>
        <p class="text-gray-400 text-xs">{{ product.created_at }}</p>
        <p class="text-indigo-600 text-base font-semibold">
          Rp {{ product.variants[0].special_price }} – Rp {{ product.variants[0].sell_price }}
        </p>
      </div>

      <div
        class="p-4 border-t border-gray-100 flex justify-end gap-3 bg-gray-50"
      >
        <button
          class="p-2 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-100 transition"
          title="Edit Produk"
        >
          <Repeat class="w-5 h-5" />
        </button>
        <DeleteProduct :id="product.id">
          <button
          class="p-2 rounded-full bg-red-50 text-red-600 hover:bg-red-100 transition"
          title="Hapus Produk"
          >
          <Trash class="w-5 h-5" />
        </button>
      </DeleteProduct>
      </div>
    </div>
  </div>

  <ProductPagination :products="products" />
</template>








<!-- 
<script setup lang="ts">
import { IProduct } from '@/lib/types/product.type';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

import { nextTick, onMounted, useTemplateRef } from 'vue';

const { productsData } = defineProps<{ productsData: IProduct[] }>();

onMounted(async () => {
    await nextTick()

    gsap.registerPlugin(ScrollTrigger)
    
    const cards = gsap.utils.toArray('.product-data')

    cards.forEach((card, index) => {
        gsap.to(card as HTMLDivElement, {
            scale: 0.5,
            opacity: 0,
            scrollTrigger: {
                trigger: card as HTMLDivElement,
                start: 'top top',
                end: '+=100%',
                scrub: true,
                markers: true,
                scroller: '.product-data-container'
            },
        })
    })
})
</script>

<template>
    
    <div class="product-data-container border border-black w-full flex flex-col gap-6 place-items-center">
        <div 
            v-for="product, index in 5"
            class="product-data sticky top-0 w-full  shadow-lg flex flex-shrink-0 bg-white gap-2 p-6 rounded-lg"
        >
            <div class="w-16 h-16 flex-shrink-0 rounded-md">
                <img 
                    src="/profile.png"
                    alt=""
                    class="object-cover"
                >
            </div>
            <div class="h-full w-full space-y-3">
                <h2 class="font-semibold text-xl flex flex-col">
                    Sound
                    <span class="font-light text-black/60 text-sm">( NM-213 )</span>
                </h2>
                <p class="font-semibold">Rp. 15.000 - Rp. 30.000</p>
                <p class="font-semibold">Digital</p>
                <p class="font-semibold">Variasi</p>
                <p class="font-semibold">25 September 2023</p>
                <p class="font-semibold">Status</p>
            </div>
        </div>

    </div>
</template> -->