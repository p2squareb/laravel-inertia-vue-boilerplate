<script setup lang="ts">
import HeaderDefault from "@/Layouts/partials/HeaderDefault.vue";
</script>

<template>
    <div class="flex flex-col min-h-screen bg-white dark:bg-gray-900">
        <HeaderDefault />
        <slot />
    </div>
</template>
