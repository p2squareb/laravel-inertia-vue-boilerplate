<script setup lang="ts">
import {usePage} from "@inertiajs/vue3";
const appName: any = usePage().props.appName;
</script>

<template>
    <img src="/images/logo.png" class="h-7 mr-2" :alt="appName" />
    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{appName}}-LIVT</span>
</template>
