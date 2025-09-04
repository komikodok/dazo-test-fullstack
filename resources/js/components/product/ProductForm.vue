<script setup lang="ts">
import { useForm, useField } from 'vee-validate'
import { toTypedSchema } from '@vee-validate/zod'
import * as z from 'zod'
import { route } from 'ziggy-js'
import { router } from '@inertiajs/vue3'

import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'
import { Input } from '@/components/ui/input'
import { Search } from 'lucide-vue-next'
import { Switch } from '@/components/ui/switch'
import { Separator } from 'reka-ui'

import { ProductSchema } from '@/lib/schemas/product.schema'
import { ICategory } from '@/lib/types/product.type'
import axios from 'axios'
import { onMounted, ref, watch } from 'vue'
import gsap from 'gsap'


const { event, id } = defineProps<{
  event: "create-product" | "update-product"
  id?: string
}>()


const formSchema = toTypedSchema(ProductSchema)

const form = useForm({
  validationSchema: formSchema,
  validateOnMount: true
})

const { value: nameValue, handleChange: nameChange, errorMessage: nameError, meta: nameMeta } = useField<string>('name', undefined, {
  initialValue: ''
})

const { value: typeValue, handleChange: typeChange, errorMessage: typeError, meta: typeMeta } = useField<string>('type', undefined, {
  initialValue: ''
})

const { value: categoryValue, handleChange: categoryChange, errorMessage: categoryError, meta: categoryMeta } = useField<string>('category', undefined, {
  initialValue: ''
})

const { value: skuValue, handleChange: skuChange, errorMessage: skuError, meta: skuMeta } = useField<string>('sku', undefined, {
  initialValue: ''
})

const { value: statusValue, handleChange: statusChange, errorMessage: statusError, meta: statusMeta } = useField<boolean>('status', undefined, {
  initialValue: false
})

const { value: stockValue, handleChange: stockChange, errorMessage: stockError, meta: stockMeta } =
  useField<number>('variants[0].stock')

const { value: capitalValue, handleChange: capitalChange, errorMessage: capitalError, meta: capitalMeta } =
  useField<number>('variants[0].capital_price')

const { value: sellValue, handleChange: sellChange, errorMessage: sellError, meta: sellMeta } =
  useField<number>('variants[0].sell_price')

const { value: specialValue, handleChange: specialChange, errorMessage: specialError, meta: specialMeta } =
  useField<number>('variants[0].special_price')

const categories = ref<ICategory[]>([])

onMounted(() => {
  gsap.fromTo('.form-item', { opacity: 0, y: 100 }, {
    opacity: 1,
    y: 0,
    stagger: 0.1,
    ease: 'power1'
  })
})

async function handleSearchCategory(val: string) {
  if (!val) {
    categories.value = []
    return
  }

  try {
    const { data } = await axios.get(route('category.index', { search: val }))
    categories.value = data.data
  } catch (err) {
    console.error(err)
  }
}

function debounce<T extends (...args: any[]) => any>(fn: T, delay = 400) {
  let t: any
  return (...args: Parameters<T>) => {
    clearTimeout(t)
    t = setTimeout(() => fn(...args), delay)
  }
}

const debouncedSearchCategory = debounce(handleSearchCategory, 400)

const handleCreateProduct = form.handleSubmit(async (values: z.infer<typeof ProductSchema>) => {
  try {
    await axios.post(route('products.store'), {
      name: values.name,
      category: values.category,
      sku: values.sku,
      status: values.status,
      type: values.type,
      variants: values.variants
    })

    form.resetForm()
  } catch(err) {
    console.error(err)
  }
})

const handleUpdateProduct = form.handleSubmit(async (values: z.infer<typeof ProductSchema>) => {
  try {
    await axios.put(route('products.update', { id: id }), {
      name: values.name,
      category: values.category,
      sku: values.sku,
      status: values.status,
      type: values.type,
      variants: values.variants
    })

    router.visit(route('products.index'))
  } catch(err) {
    console.error(err)
  }
})

function onSubmit(e: Event) {
  e.preventDefault()

  if (event === 'create-product') {
    handleCreateProduct()
  } else if (event === 'update-product') {
    handleUpdateProduct()
  }
}

</script>

<template>
  <Form :form="form">
    <form 
      :id="event === 'create-product' ? 'create-product' : 'update-product'" 
      @submit.prevent="onSubmit" 
      class="space-y-6"
    >
      <FormField name="name">
        <FormItem class="space-y-3 form-item">
          <FormLabel class="font-semibold">
            Nama Produk
            <span class="text-red-500 text-lg">*</span>
          </FormLabel>
          <FormControl>
            <Input 
              class="bg-slate-100 outline-none focus-visible:ring-0.5" 
              :model-value="nameValue" 
              @update:model-value="nameChange" 
              placeholder="Masukkan nama produk" 
            />
            <p 
              v-if="nameError && nameMeta.dirty"
              class="text-xs px-2 text-red-500 transition-all duration-300"
            >
              {{ nameError }}
            </p>
          </FormControl>
        </FormItem>
      </FormField>

      <FormField name="type">
        <FormItem class="space-y-3 form-item">
          <FormLabel class="font-semibold">
            Tipe Produk
            <span class="text-red-500 text-lg">*</span>
          </FormLabel>
          <FormControl>
            <Input 
              class="bg-slate-100 outline-none focus-visible:ring-0.5" 
              :model-value="typeValue" 
              @update:model-value="typeChange" 
              placeholder="Masukkan tipe produk" 
            />
            <p 
              v-if="typeError && typeMeta.dirty"
              class="text-xs px-2 text-red-500 transition-all duration-300"
            >
              {{ typeError }}
            </p>
          </FormControl>
          <FormMessage />
        </FormItem>
      </FormField>
      
      <FormField name="category">
        <FormItem class="space-y-3 form-item relative z-10">
          <FormLabel class="font-semibold">
            Kategori Produk
            <span class="text-red-500 text-lg">*</span>
          </FormLabel>
          <FormControl>
            <div class="bg-slate-100 border flex rounded-md justify-center items-center">
              <div class="relative w-full flex justify-center items-center">
                <Search class="text-blue-800 absolute left-2"/>
                <Input
                  class="px-9 outline-none border-none focus-visible:ring-0.5"
                  :model-value="categoryValue"
                  @update:model-value="(val) => {categoryChange(val); debouncedSearchCategory(String(val))}"
                  placeholder="Cari kategori atau tambah kategori dengan cara diketik langsung"
                />
                <p 
                  v-if="categoryError && categoryMeta.dirty"
                  class="text-xs px-2 text-red-500 transition-all duration-300"
                >
                  {{ categoryError }}
                </p>

                <ul
                  v-if="categories.length"
                  class="w-[50%] max-h-96 overflow-y-scroll bg-white rounded-xl overflow-hidden space-y-2 border absolute left-0 top-[120%]"
                >
                  <li
                    v-for="category in categories"
                    :key="category.id"
                    @click="() => { categoryChange(category.name); categories = [] }"
                    class="border border-slate-400 font-medium text-black/60 hover:text-slate-800 cursor-pointer p-2 text-center bg-gradient-to-r z-10 from-slate-100 to-slate-200 hover:from-slate-200 hover:to-slate-300 rounded-md"
                  >
                    {{ category.name }}
                  </li>
                </ul>
              </div>
            </div>
          </FormControl>
          <FormMessage />
        </FormItem>
      </FormField>

      <FormField name="sku">
        <FormItem class="space-y-3 form-item">
          <FormLabel class="font-semibold">
            SKU
            <span class="text-red-500 text-lg">*</span>
          </FormLabel>
          <FormControl>
            <div class="space-y-2">
              <Input 
                class="bg-slate-100 outline-none focus-visible:ring-0.5" 
                :model-value="skuValue" 
                @update:model-value="skuChange" 
                placeholder="Masukkan sku" 
              />
              <p 
                v-if="skuError && skuMeta.dirty"
                class="text-xs px-2 text-red-500 transition-all duration-300"
              >
                {{ skuError }}
              </p>
              <h2 class="text-md text-slate-500">Maksimal 100 karakter</h2>
            </div>
          </FormControl>
          <FormMessage />
        </FormItem>
      </FormField>

      <FormField name="status">
        <FormItem class="w-full p-6 form-item flex rounded-lg border border-slate-200">
          <FormLabel>
            <div class="space-y-3">
              <h2 class="font-semibold">Status Produk</h2>
              <p class="text-slate-500">
                Tentukan apakah produk ditampilkan di toko dan toko digital. Nonaktifkan untuk menyembunyikan produk dari pembeli.
              </p>
            </div>
          </FormLabel>
          <FormControl>
            <Switch 
              :model-value="statusValue" 
              @update:model-value="statusChange" 
              class="ml-auto"
            />
            <p 
              v-if="statusError && statusMeta.dirty"
              class="text-xs px-2 text-red-500 transition-all duration-300"
            >
              {{ statusError }}
            </p>
          </FormControl>
        </FormItem>
      </FormField>

      <div class="space-y-10">
        <Separator orientation="vertical" class="bg-slate-200 h-[1px]"/>
        <Separator orientation="vertical" class="bg-slate-200 h-[1px]"/>
      </div>

      <div class="w-full space-y-3">
        <h2 class="font-bold">Harga, Variasi, & Stok Ketersediaan</h2>
        <div class="flex max-md:flex-col max-md:space-y-10 md:space-x-10 p-4 rounded-lg border border-slate-200">
          <FormField name="variants[0].stock">
            <FormItem>
              <FormLabel class="font-semibold">
                Stok
                <span class="text-red-500 text-lg">*</span>
              </FormLabel>
              <FormControl>
                <Input 
                  class="bg-slate-100 outline-none focus-visible:ring-0.5" 
                  :model-value="stockValue" 
                  @update:model-value="(val) => stockChange(Number(val))"
                  placeholder="Masukkan stok" 
                />
                <p 
                  v-if="stockError && stockMeta.dirty"
                  class="text-xs px-2 text-red-500 transition-all duration-300"
                >
                  {{ stockError }}
                </p>
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>

          <FormField name="variants[0].capital_price">
            <FormItem>
              <FormLabel class="font-semibold">
                Harga Modal
                <span class="text-red-500 text-lg">*</span>
              </FormLabel>
              <FormControl>
                <Input 
                  class="bg-slate-100 outline-none focus-visible:ring-0.5" 
                  :model-value="capitalValue"
                  @update:model-value="(val) => capitalChange(Number(val))"
                  placeholder="Masukkan harga modal" 
                />
                <p 
                  v-if="capitalError && capitalMeta.dirty"
                  class="text-xs px-2 text-red-500 transition-all duration-300"
                >
                  {{ capitalError }}
                </p>
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>

          <FormField name="variants[0].sell_price">
            <FormItem>
              <FormLabel class="font-semibold">
                Harga Jual
                <span class="text-red-500 text-lg">*</span>
              </FormLabel>
              <FormControl>
                <Input 
                  class="bg-slate-100 outline-none focus-visible:ring-0.5" 
                  :model-value="sellValue" 
                  @update:model-value="(val) => sellChange(Number(val))"  
                  placeholder="Masukkan harga jual" 
                />
                <p 
                  v-if="sellError && sellMeta.dirty"
                  class="text-xs px-2 text-red-500 transition-all duration-300"
                >
                  {{ sellError }}
                </p>
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>

          <FormField name="variants[0].special_price">
            <FormItem>
              <FormLabel class="font-semibold">
                Harga Spesial
                <span class="text-red-500 text-lg">*</span>
              </FormLabel>
              <FormControl>
                <Input 
                  class="bg-slate-100 outline-none focus-visible:ring-0.5" 
                  :model-value="specialValue" 
                  @update:model-value="(val) => specialChange(Number(val))" 
                  placeholder="Masukkan harga spesial" 
                />
                <p 
                  v-if="specialError && specialMeta.dirty"
                  class="text-xs px-2 text-red-500 transition-all duration-300"
                >
                  {{ specialError }}
                </p>
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>
        </div>
      </div>
    </form>
  </Form>
</template>