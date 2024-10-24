<script setup lang="ts">
import {computed} from "vue";

const props = withDefaults(
    defineProps<{
        color?: 'blue' | 'gray' | 'red' | 'indigo' | 'green' | 'yellow';
    }>(),
    {
        color: 'blue',
    }
)

const buttonClass = computed(() => {
    return {
        'rounded-md text-white bg-blue-700 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700': props.color === 'blue',
        'bg-gray-700': props.color === 'gray',
        'rounded-md text-white bg-red-700 hover:bg-red-800 dark:bg-red-600 dark:hover:bg-red-700': props.color === 'red',
        'rounded-md text-white bg-indigo-700 hover:bg-indigo-800 dark:bg-indigo-600 dark:hover:bg-indigo-700': props.color === 'indigo',
        'bg-green-700': props.color === 'green',
        'bg-yellow-700': props.color === 'yellow',
    }
});
</script>

<template>
    <button :class="buttonClass"><slot /></button>
</template>
