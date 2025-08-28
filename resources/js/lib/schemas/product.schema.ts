import { z } from 'zod';


const VariantSchema = z.object({
  name: z.string().nullable(),
  capital_price: z.number().nullable(),
  sell_price: z.number().nullable(),
  special_price: z.number().nullable(),
  stock: z.number().nullable() 
})

export const ProductSchema = z.object({
  name: z.string().min(1, 'Nama produk harus diisi'),
  category_id: z.string().min(1, 'Kategori harus dipilih'),
  sku: z.string().min(1, 'SKU harus diisi'),
  status: z.boolean().default(true),
  variants: z.array(VariantSchema).default([]),
  type: z.string().default('simple'),
  createdAt: z.date().optional().default(new Date())
});