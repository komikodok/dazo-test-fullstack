<script setup lang="ts">
import SidebarButton from '@/components/sidebar/SidebarButton.vue';
import { 
    Popover ,
    PopoverTrigger,
    PopoverContent
} from '@/components/ui/popover';
import Button from '@/components/ui/button/Button.vue';
import { 
    ShoppingBag, 
    ChevronDown,
    Menu
} from 'lucide-vue-next';
import { ref } from 'vue';

const openSidebar = ref<boolean>(true)
const openMenu = ref<boolean>(false)

</script>

<template>
    <div 
        class="md:relative absolute z-10 flex-shrink-0 transition-all duration-700 space-y-1 h-full overflow-hidden bg-white shadow-[1px_0_10px_#cbd5e1]"
        :class="openSidebar ? 'translate-x-0 w-56' : '-translate-x-full w-0'"
    >
    
        <header>
            <h2 class="font-extrabold tracking-[-0.05em] flex items-center text-blue-950 text-4xl px-6 pt-1 pb-2">
                dazo
                <p class="text-3xl">.id</p>
            </h2>
        </header>
    
        <main class="w-full h-full py-2 px-3">
            <Popover>
                <PopoverTrigger as-child class="w-full">
                    <Button 
                        class="flex gap-3 w-full items-center"
                        @click="openMenu = !openMenu"
                    >
                        <ShoppingBag class="size-5"/>
                        <h2 class="font-semibold tracking-tight">Produk</h2>
                        <ChevronDown 
                            class="ml-auto size-4 transition-transform duration-500"
                            :class="openMenu ? 'rotate-180' : 'rotate-0'"
                        />
                    </Button>
                </PopoverTrigger>
                <PopoverContent class="w-[180px] p-2 cursor-pointer flex items-center gap-2 bg-blue-800">
                    <Menu class="size-4 text-white"/>
                    <p class="text-white text-sm">Daftar Produk</p>
                </PopoverContent>
            </Popover>
        </main>
    </div>
    <SidebarButton :open-sidebar="openSidebar" @toggle-sidebar="openSidebar = !openSidebar"/>
</template>