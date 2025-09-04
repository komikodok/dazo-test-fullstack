import { mount } from '@vue/test-utils'
import { describe, it, expect, vi } from 'vitest'
import ProductCreateHeader from '@/components/product/ProductCreateHeader.vue'

// Stub Link dari Inertia supaya tidak error
const LinkStub = {
  props: ['href'],
  template: '<a :href="href"><slot /></a>'
}

// Mock route dari Ziggy
vi.mock('ziggy-js', () => ({
  route: (name: string) => `/mocked/${name.replace('.', '/')}`
}))

describe('ProductCreateHeader.vue', () => {
  it('renders title', () => {
    const wrapper = mount(ProductCreateHeader, {
      global: { stubs: { Link: LinkStub } }
    })
    expect(wrapper.text()).toContain('Tambah Produk')
  })

  it('renders "Kembali" link with correct href', () => {
    const wrapper = mount(ProductCreateHeader, {
      global: { stubs: { Link: LinkStub } }
    })
    const link = wrapper.findComponent(LinkStub)
    expect(link.exists()).toBe(true)
    expect(link.attributes('href')).toBe('/mocked/products/index')
    expect(link.text()).toContain('Kembali')
  })

  it('renders submit button with correct text', () => {
    const wrapper = mount(ProductCreateHeader, {
      global: { stubs: { Link: LinkStub } }
    })
    const btn = wrapper.find('button[type="submit"]')
    expect(btn.exists()).toBe(true)
    expect(btn.text()).toContain('Tambah Produk')
  })
})
