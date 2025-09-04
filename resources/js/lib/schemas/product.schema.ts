import { z } from 'zod';


const VariantSchema = z.object({
  capital_price: z.number().nullable(),
  sell_price: z.number().nullable(),
  special_price: z.number().nullable(),
  stock: z.number().nullable() 
})

export const ProductSchema = z.object({
  name: z.string().min(2, 'Nama produk harus lebih dari 2 karakter'),
  category: z.string().min(1, 'Kategori harus diisi'),
  sku: z.string().min(2, 'SKU harus lebih dari 2 karakter').max(100, 'SKU maksimal 100 karakter'),
  status: z.boolean().default(false),
  variants: z.array(VariantSchema),
  type: z.string().min(2, 'Tipe produk harus lebih dari 2 karakter'),
  created_at: z.date().optional().default(new Date()),
  updated_at: z.date().optional()
});