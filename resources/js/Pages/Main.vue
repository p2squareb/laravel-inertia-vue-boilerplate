<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";

defineOptions({
    layout: AppLayout,
});
</script>

<template>
    <Head title="Welcome" />
    <main class="grow">
        <section class="py-4 bg-white dark:bg-gray-900 lg:pt-12 lg:pb-16">
            <div class="px-4 mx-auto max-w-8xl lg:px-4 lg:text-center">
                <a class="inline-flex items-center justify-between px-1 py-1 pr-4 mb-5 text-sm text-gray-700 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white hover:bg-gray-200" role="alert" href="/blocks/e-commerce/">
                    <span class="text-xs bg-blue-700 dark:bg-blue-600 rounded-full text-white px-4 py-1.5 mr-3">New</span>
                    <span class="mr-2 text-sm font-medium">알림 내용들 모듈jjj</span>
                    <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"></path>
                    </svg>
                </a>
                <h1 class="mb-4 text-4xl font-bold tracking-tight text-gray-900 lg:font-extrabold lg:text-6xl lg:leading-none dark:text-white lg:text-center xl:px-36 lg:mb-7">
                    Laravel, Inertia, Vue, Tailwind</h1>
                <p class="mb-10 text-lg font-normal text-gray-500 dark:text-gray-400 lg:text-center lg:text-xl xl:px-60">
                    정리중
                </p>
            </div>
        </section>
    </main>
</template>

