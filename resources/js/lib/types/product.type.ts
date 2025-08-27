import { z } from "zod"
import { productSchema } from "../schemas/product.schema"

export type ProductSchema = z.infer<typeof productSchema>