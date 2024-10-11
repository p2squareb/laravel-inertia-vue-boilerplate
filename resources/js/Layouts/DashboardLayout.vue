<script setup lang="ts">
import DashboardNavbar from "@/Layouts/partials/DashboardNavbar.vue";
import DashboardSidebar from "@/Layouts/partials/DashboardSidebar.vue";
import DashboardFooter from "@/Layouts/partials/DashboardFooter.vue";
</script>

<template>
    <DashboardNavbar />
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <DashboardSidebar />
        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <slot />
            <DashboardFooter />
        </div>
    </div>
</template>
