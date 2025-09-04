import { describe, it, expect, vi, beforeEach, afterEach } from 'vitest'
import { mount } from '@vue/test-utils'
import DeleteProduct from '@/components/product/DeleteProduct.vue'
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog'
import DialogClose from '@/components/ui/dialog/DialogClose.vue'
import Button from '@/components/ui/button/Button.vue'

vi.mock('axios', () => ({
  default: {
    delete: vi.fn()
  }
}))

vi.mock('@inertiajs/vue3', () => ({
  router: {
    visit: vi.fn()
  }
}))

vi.mock('ziggy-js', () => ({
  route: vi.fn((name, params) => `/${name}/${params.id}`)
}))

vi.mock('@/components/ui/dialog', () => ({
  Dialog: {
    template: '<div><slot /></div>'
  },
  DialogContent: {
    template: '<div><slot /></div>'
  },
  DialogDescription: {
    template: '<div><slot /></div>'
  },
  DialogFooter: {
    template: '<div><slot /></div>'
  },
  DialogHeader: {
    template: '<div><slot /></div>'
  },
  DialogTitle: {
    template: '<div><slot /></div>'
  },
  DialogTrigger: {
    template: '<div><slot /></div>'
  }
}))

vi.mock('@/components/ui/dialog/DialogClose.vue', () => ({
  default: {
    template: '<button><slot /></button>'
  }
}))

vi.mock('@/components/ui/button/Button.vue', () => ({
  default: {
    template: '<button><slot /></button>',
    props: ['class', 'onClick']
  }
}))

describe('DeleteProduct.vue', () => {
  let axiosMock: any
  let routerMock: any
  let routeMock: any
  let consoleErrorSpy: any

  beforeEach(async () => {
    axiosMock = (await import('axios')).default.delete
    routerMock = (await import('@inertiajs/vue3')).router.visit
    routeMock = (await import('ziggy-js')).route
    
    consoleErrorSpy = vi.spyOn(console, 'error').mockImplementation(() => {})
    
    vi.clearAllMocks()
    axiosMock.mockReset()
    routerMock.mockReset()
    routeMock.mockReset()
  })

  afterEach(() => {
    consoleErrorSpy.mockRestore()
  })

  it('renders dialog with correct content', () => {
    const wrapper = mount(DeleteProduct, {
      props: {
        id: '123'
      },
      global: {
        stubs: {
          Dialog: true,
          DialogContent: true,
          DialogDescription: true,
          DialogFooter: true,
          DialogHeader: true,
          DialogTitle: true,
          DialogTrigger: true,
          DialogClose: true,
          Button: true
        }
      }
    })

    expect(wrapper.exists()).toBe(true)
    expect(wrapper.props('id')).toBe('123')
  })

  it('logs error to console when deletion fails', async () => {
    const wrapper = mount(DeleteProduct, {
      props: {
        id: '123'
      }
    })

    const error = new Error('Delete failed')
    
    axiosMock.mockRejectedValueOnce(error)

    await wrapper.vm.handleDelete()

    expect(consoleErrorSpy).toHaveBeenCalledTimes(1)
    expect(consoleErrorSpy).toHaveBeenCalledWith(error)
    
    expect(routerMock).not.toHaveBeenCalled()
  })

  it('renders trigger slot content', () => {
    const wrapper = mount(DeleteProduct, {
      props: {
        id: '123'
      },
      slots: {
        default: '<button>Delete Product</button>'
      },
      global: {
        stubs: {
          Dialog: true,
          DialogTrigger: true,
          DialogContent: true,
          DialogDescription: true,
          DialogFooter: true,
          DialogHeader: true,
          DialogTitle: true,
          DialogClose: true,
          Button: true
        }
      }
    })

    expect(wrapper.html()).toContain('Delete Product')
  })

  it('has correct dialog title and description', async () => {
    const wrapper = mount(DeleteProduct, {
      props: {
        id: '123'
      },
      global: {
        stubs: {
          Dialog: {
            template: '<div><slot name="trigger" /><slot name="content" /></div>'
          },
          DialogContent: {
            template: '<div><slot /></div>'
          },
          DialogHeader: {
            template: '<div><slot /></div>'
          },
          DialogTitle: {
            template: '<h2><slot /></h2>'
          },
          DialogDescription: {
            template: '<p><slot /></p>'
          }
        }
      }
    })

    expect(wrapper.text()).toContain('Yakin ingin menghapus produk?')
    expect(wrapper.text()).toContain('Setelah dihapus, produk ini tidak bisa dikembalikan')
  })
})