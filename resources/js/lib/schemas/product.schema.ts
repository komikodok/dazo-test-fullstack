import { z } from 'zod';

export const productSchema = z.object({
  name: z.string().min(1, 'Nama produk harus diisi'),
  category_id: z.string().min(1, 'Kategori harus dipilih'),
  sku: z.string().min(1, 'SKU harus diisi'),
  status: z.boolean().default(true),
  stock: z.number().min(0, 'Stok tidak boleh negatif'),
  cost_price: z.number().min(0, 'Harga beli tidak boleh negatif'),
  sell_price: z.number().min(0, 'Harga jual tidak boleh negatif'),
  special_price: z.number().min(0).optional().nullable(),
  imageUrl: z.string().url('URL gambar tidak valid').optional().nullable(),
  variants: z.string().optional().nullable(),
  type: z.string().default('simple'),
  createdAt: z.date().optional().default(new Date())
});