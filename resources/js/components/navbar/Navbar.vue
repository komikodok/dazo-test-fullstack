<script setup lang="ts">
import {
  NavigationMenu,
  NavigationMenuItem,
  NavigationMenuList,
} from '@/components/ui/navigation-menu'
import { ChevronDown } from 'lucide-vue-next';
import { Wifi } from 'lucide-vue-next';
import { BookOpen } from 'lucide-vue-next';
import { Bell } from 'lucide-vue-next';
import { MessageSquare } from 'lucide-vue-next';
import gsap from 'gsap';

function handleMouseEnter(e: MouseEvent) {
    gsap.to(e.currentTarget, {
        rotation: "+=2",
        scale: 1.03,
        yoyo: true,
        repeat: -1,
        ease: 'power1.inOut',
    })
}

function handleMouseLeave(e: MouseEvent) {
    gsap.killTweensOf(e.currentTarget)

    gsap.to(e.currentTarget, {
        rotate: 0,
        scale: 1,
        ease: 'power1'
    })
    
}
</script>

<template>
    <NavigationMenu class="ml-auto flex md:mr-6 p-2">
        <NavigationMenuList class="space-x-3">
            <NavigationMenuItem class="cursor-pointer">
                <div @mouseenter="handleMouseEnter" @mouseleave="handleMouseLeave" class="bg-blue-50 flex justify-center p-1 items-center gap-1 rounded-md">
                    <Wifi class="w-4 h-4 text-blue-700"/>
                    <span class="text-blue-700 text-xs">10</span>
                </div>
            </NavigationMenuItem>
            <NavigationMenuItem class="cursor-pointer">
                <BookOpen @mouseenter="handleMouseEnter" @mouseleave="handleMouseLeave" class="size-4"/>
            </NavigationMenuItem>
            <NavigationMenuItem class="cursor-pointer">
                <div @mouseenter="handleMouseEnter" @mouseleave="handleMouseLeave" class="relative">
                    <Bell class="size-4"/>
                    <div class="rounded-full w-2 h-2 absolute top-0 right-0 flex justify-center items-center bg-white">
                        <div class="rounded-full w-1 h-1 bg-red-500"></div>
                    </div>
                </div>
            </NavigationMenuItem>
            <NavigationMenuItem class="cursor-pointer">
                <div @mouseenter="handleMouseEnter" @mouseleave="handleMouseLeave" class="relative">
                    <MessageSquare class="size-4 -scale-x-100" />
                    <div class="rounded-full w-2 h-2 absolute top-0 -right-1 flex justify-center items-center bg-white">
                        <div class="rounded-full w-1 h-1 bg-red-500"></div>
                    </div>
                </div>
            </NavigationMenuItem>
            <NavigationMenuItem class="cursor-pointer">
                <div class="bg-blue-50 p-1 flex justify-center items-center gap-1 rounded-md">
                    <div class="w-6 h-6 rounded-lg bg-sky-200 flex justify-center items-center">
                        <img src="/profile.png" alt="profile" class="w-5 h-5 object-cover">
                    </div>
                    <div class="flex gap-2 justify-center items-center">
                        <span class="font-semibold text-[8px] rounded-md bg-white px-3 py-1 text-[#1D4ED8]">Starter Package</span>
                        <ChevronDown class="size-4 text-blue-700 transition-transform duration-300 hover:rotate-180"/>
                    </div>
                </div>
            </NavigationMenuItem>
        </NavigationMenuList>
    </NavigationMenu>
</template>