<script setup lang="ts">
import gsap from 'gsap';
import { ChevronLeft } from 'lucide-vue-next';

const { openSidebar } = defineProps<{
    openSidebar: boolean
}>()

const emit = defineEmits<{
    (e: 'toggle-sidebar'): void
}>()

function handleToggleSidebar(e: MouseEvent) {
    if (!openSidebar) {
        gsap.to(e.currentTarget, {
            boxShadow: '4px 0 5px #cbd5e1',
            left: '208px',
            delay: 0.1,
            duration: 0.6,
        })
    } else {
        gsap.to(e.currentTarget, {
            left: '12px',
            delay: 0.1,
            duration: 0.6,
        })
    }

    emit('toggle-sidebar')
}
</script>

<template>
    <div 
        @click="handleToggleSidebar" 
        class="cursor-pointer absolute left-52 top-0 w-10 h-10 flex justify-center items-center rounded-full bg-white transition-transform duration-500"
    >
        <div class="border-[0.01px] border-gray-900/60 w-6 h-6 rounded-full flex justify-center items-center">
            <ChevronLeft 
                class="size-3 transition-transform duration-500 text-gray-900" stroke-width="3"
                :class="openSidebar ? 'rotate-180' : 'rotate-0'"
            />
        </div>
    </div>
</template>