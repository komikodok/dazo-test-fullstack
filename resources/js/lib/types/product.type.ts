export interface IVariants {
    capital_price?: number
    sell_price?: number
    special_price?: number
    stock?: number
}

export interface ICategory {
    id: string
    name: string
}

export interface IProduct {
    id: string
    name: string
    category: ICategory
    sku: string
    status: boolean
    variants: IVariants[]
    type: string
    created_at: string
    updated_at: string
}

export interface IPaginatedProduct<T> {
  current_page: number
  data: T[]
  first_page_url: string
  from: number | null
  last_page: number
  last_page_url: string
  links: {
    url: string | null
    label: string
    active: boolean
  }[]
  next_page_url: string | null
  path: string
  per_page: number
  prev_page_url: string | null
  to: number | null
  total: number
}
