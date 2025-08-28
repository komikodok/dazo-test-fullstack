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
import { Search } from 'lucide-vue-next'

import { ProductSchema } from '@/lib/schemas/product.schema'
import axios, { isAxiosError } from 'axios'

const formSchema = toTypedSchema(ProductSchema)

const form = useForm({
  validationSchema: formSchema,
})

const onSubmit = form.handleSubmit(async (values: z.infer<typeof ProductSchema>) => {
  try {
    await axios.post(route('product.store'), {
      ...values
    })
  } catch (err) {
    if (isAxiosError(err)) {
        const errorMessage = err.response?.data
        console.error("Product Create Error: ", errorMessage.errors)
    } else {
        console.error("Unexpected Error: ", err)
    }
  }
})
</script>

<template>
  <Form>
    <form @submit="onSubmit" class="space-y-6">
      <FormField name="name">
        <FormItem class="space-y-3">
            <FormLabel class="font-semibold">
              Nama Produk
              <span class="text-red-500 text-lg">*</span>
            </FormLabel>
            <FormControl>
              <Input class="bg-slate-100 outline-none focus-visible:ring-0.5" v-model="form.values.name" placeholder="Masukkan nama produk" />
            </FormControl>
          <FormMessage />
        </FormItem>
      </FormField>
    
      <FormField name="category_id">
        <FormItem class="space-y-3">
          <FormLabel class="font-semibold">
            Kategory Produk
            <span class="text-red-500 text-lg">*</span>
          </FormLabel>
          <FormControl>
            <div class="bg-slate-100 p-2 flex rounded-md justify-center items-center">
              <Search class="text-blue-800"/>
              <Input class="outline-none focus-visible:ring-0.5" v-model="form.values.category_id" placeholder="Cari kategori atau tambah kategori dengan cara diketik langsung" />
            </div>
          </FormControl>
          <FormMessage />
        </FormItem>
      </FormField>
    </form>
  </Form>
</template>
