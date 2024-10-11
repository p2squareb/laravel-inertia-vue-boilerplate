<script setup lang="ts">
import {usePage} from "@inertiajs/vue3";
const appName: any = usePage().props.appName;
</script>

<template>
    <img src="/images/logo.png" class="h-8 mr-3" :alt="appName" />
    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{appName}}-LIVT</span>
</template>
