<script setup lang="ts">
import AppLayout from '@/components/layout/AppLayout.vue';
import ProductCreateHeader from '@/components/product/ProductCreateHeader.vue';
import ProductForm from '@/components/product/ProductForm.vue';
import {
  Breadcrumb,
  BreadcrumbItem,
  BreadcrumbLink,
  BreadcrumbList,
  BreadcrumbSeparator,
} from '@/components/ui/breadcrumb'
</script>

<template>
    <AppLayout>
        <div class="w-full px-6 bg-slate-100">
            <div class="w-full h-20 flex items-center">
                <Breadcrumb class="w-full h-20 flex items-center">
                  <BreadcrumbList>
                    <BreadcrumbItem>
                        <BreadcrumbLink class="text-blue-800 opacity-50 hover:opacity-100 transition-all duration-300" href="/products">
                            Daftar Produk
                        </BreadcrumbLink>
                    </BreadcrumbItem>
                    <BreadcrumbSeparator />
                    <BreadcrumbItem>
                        <BreadcrumbLink class="text-blue-800" href="/products/create">
                            Tambah Produk
                        </BreadcrumbLink>
                    </BreadcrumbItem>
                  </BreadcrumbList>
              </Breadcrumb>
            </div>

            <ProductCreateHeader />

            <div class="w-full h-full bg-white rounded-lg">
                <div class="px-6 py-4">
                    <h2 class="font-semibold text-lg text-black/90">Informasi Produk</h2>
                </div>

                <div class="px-6 py-4">
                    <ProductForm />
                </div>
            </div>
        </div>
    </AppLayout>
</template>