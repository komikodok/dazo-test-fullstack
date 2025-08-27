<script setup lang="ts">
import { useForm } from 'vee-validate'
import { toTypedSchema } from '@vee-validate/zod'
import * as z from 'zod'
import { route } from 'ziggy-js'

import {
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage
} from '@/components/ui/form'
import { Input } from '@/components/ui/input'
import { Button } from '@/components/ui/button'

import { type ProductSchema } from '@/lib/types/product.type'
import { productSchema } from '@/lib/schemas/product.schema'

const formSchema = toTypedSchema(productSchema)

const form = useForm<ProductSchema>({
  validationSchema: formSchema,
  initialValues: {
    name: '',
    category_id: '',
    sku: '',
    status: true,
    stock: 0,
    cost_price: 0,
    sell_price: 0,
    special_price: null,
    imageUrl: null,
    variants: null,
    type: 'simple',
    createdAt: new Date()
  }
})

function onSubmit(values: ProductSchema) {
  route('products.store', values)
}
</script>

<template>
  <form @submit="form.handleSubmit(onSubmit)" class="space-y-4">
    <FormField name="name">
      <FormItem>
        <FormLabel class="font-semibold">Nama Produk</FormLabel>
        <FormControl>
          <Input class="bg-slate-100 outline-none focus-visible:ring-0.5" v-model="form.values.name" placeholder="Masukkan nama produk" />
        </FormControl>
        <FormMessage />
      </FormItem>
    </FormField>
  </form>
</template>
