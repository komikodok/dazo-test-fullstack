<script setup lang="ts">
import {
  Pagination,
  PaginationContent,
  PaginationEllipsis,
  PaginationItem,
  PaginationNext,
  PaginationPrevious,
} from '@/components/ui/pagination'
import { router } from '@inertiajs/vue3'
import { route } from 'ziggy-js';
import { ChevronLeftIcon, ChevronRightIcon } from 'lucide-vue-next';

const { products } = defineProps<{
  products: {
    data: any[]
    current_page: number
    per_page: number
    total: number
  }
}>()

function handleChange(page: number) {
  router.get(route('products.index', { page }), {}, { preserveScroll: true })
}
</script>

<template>
  <Pagination
    v-slot="{ page }"
    :items-per-page="products.per_page"
    :total="products.total"
    :default-page="products.current_page"
    @update:page="handleChange"
  >
    <PaginationContent v-slot="{ items }" class="ml-auto my-8">
      <PaginationPrevious>
        <div class="p-2 border border-blue-800 rounded-md hover:bg-blue-100">
            <ChevronLeftIcon />
        </div>
      </PaginationPrevious>

      <template v-for="(item, index) in items" :key="index">
        <PaginationItem
          v-if="item.type === 'page'"
          :value="item.value"
          :is-active="item.value === page"
          class="hover:bg-blue-100 hover:border-blue-400"
          :class="item.value === page ? 'text-blue-800 font-bold' : 'text-gray-400'"
        >
          {{ item.value }}
        </PaginationItem>
        <PaginationEllipsis v-else-if="item.type === 'ellipsis'" :index="index" />
      </template>

      <PaginationNext>
        <div class="p-2 border border-blue-800 rounded-md hover:bg-blue-100">
            <ChevronRightIcon />
        </div>
      </PaginationNext>
    </PaginationContent>
  </Pagination>
</template>
