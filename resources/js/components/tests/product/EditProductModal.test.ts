import { mount } from '@vue/test-utils'
import { describe, it, expect } from 'vitest'
import EditProductModal from '@/components/product/EditProductModal.vue'

const ProductFormStub = {
  props: ['id', 'event'],
  template: '<div class="product-form-stub">{{ id }}</div>'
}

describe('EditProductModal.vue', () => {
  const props = { id: '123' }

  it('renders slot content', () => {
    const wrapper = mount(EditProductModal, {
      props,
      global: {
        stubs: {
          ProductForm: ProductFormStub
        }
      },
      slots: {
        default: '<button class="trigger">Open</button>'
      }
    })
    expect(wrapper.find('button.trigger').exists()).toBe(true)
  })

  it('renders dialog title and ProductForm', async () => {
    const wrapper = mount(EditProductModal, {
      props,
      attachTo: document.body,
      global: {
        stubs: {
          ProductForm: ProductFormStub
        }
      },
      slots: {
        default: '<button class="trigger">Open</button>'
      }
    })

    await wrapper.find('button.trigger').trigger('click')

    expect(wrapper.html()).toContain('Edit Produk')

    const form = wrapper.findComponent(ProductFormStub)
    expect(form.exists()).toBe(true)
    expect(form.text()).toBe('123')
  })

  it('renders action buttons', async () => {
    const wrapper = mount(EditProductModal, {
      props,
      attachTo: document.body,
      global: {
        stubs: {
          ProductForm: ProductFormStub
        }
      },
      slots: {
        default: '<button class="trigger">Open</button>'
      }
    })

    await wrapper.find('button.trigger').trigger('click')

    const cancelBtn = wrapper.findComponent({ name: 'DialogClose' })
    const submitBtn = wrapper.find('button[type="submit"]')

    expect(cancelBtn.exists()).toBe(true)
    expect(cancelBtn.text()).toBe('Batal')
    expect(submitBtn.exists()).toBe(true)
    expect(submitBtn.text()).toBe('Edit')
  })
})
