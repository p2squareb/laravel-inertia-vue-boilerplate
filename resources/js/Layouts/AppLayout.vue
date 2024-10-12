<script setup lang="ts">
import AppNavbar from "@/Layouts/partials/AppNavbar.vue";
</script>

<template>
    <div class="flex flex-col min-h-screen bg-white dark:bg-gray-900">
        <AppNavbar />
        <slot />
    </div>
</template>
