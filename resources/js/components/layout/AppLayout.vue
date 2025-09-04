<script setup lang="ts">
import Navbar from '@/components/navbar/Navbar.vue'
import Sidebar from '@/components/sidebar/Sidebar.vue'
</script>

<template>
  <div class="flex h-screen w-screen font-inter">
    <Sidebar />

    <div class="flex flex-col flex-1">
      <header class="flex items-center px-4">
        <Navbar />
      </header>

      <main class="overflow-y-auto">
        <slot />
      </main>
    </div>
  </div>
</template>
