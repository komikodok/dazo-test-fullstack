import { z } from "zod"
import { productSchema } from "../schemas/product.schema"

export interface IVariants {
    name?: string
    capital_price?: number
    sell_price?: number
    special_price?: number
    stock?: number
}

export interface ICategory {
    _id: string
    name: string
}

export interface IProduct {
    _id: string
    name: string
    category_id: ICategory
    sku: string
    status: boolean
    variants: IVariants[]
    type: string
    createdAt: string
}