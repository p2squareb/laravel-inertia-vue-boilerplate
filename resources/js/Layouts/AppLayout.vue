<script setup lang="ts">
import AppNavbar from "@/Layouts/partials/AppNavbar.vue";
</script>

<template>
    <div class="flex flex-col bg-white dark:bg-gray-900 text-sm text-gray-900 dark:text-white">
        <AppNavbar />
        <slot />
    </div>
</template>
