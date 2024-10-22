<template>
    <div v-if="editor" class="w-full border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
        <div class="px-3 py-2 border-b dark:border-gray-600">
            <div class="flex flex-wrap items-center">
                <div class="flex items-center space-x-1 rtl:space-x-reverse flex-wrap">
                    <button
                        type="button"
                        class="p-1.5 rounded cursor-pointer text-gray-700 dark:text-gray-300 "
                        :class="{ 'text-gray-900 dark:text-white bg-gray-300 dark:bg-gray-900': editor.isActive('bold') }"
                        @click="editor.chain().focus().toggleBold().run()"
                    >
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5h4.5a3.5 3.5 0 1 1 0 7H8m0-7v7m0-7H6m2 7h6.5a3.5 3.5 0 1 1 0 7H8m0-7v7m0 0H6"/>
                        </svg>
                        <span class="sr-only">Bold</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="px-4 py-2 bg-white rounded-b-lg dark:bg-gray-800">
            <div class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400">
                <editor-content :editor="editor"/>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import { watch } from "vue";

interface TextareaProps {
    modelValue?: string
    textareaMinHeight?: number
}

const props = withDefaults(defineProps<TextareaProps>(), {
    modelValue: '',
    textareaMinHeight: 80,
})

const emit = defineEmits(['update:modelValue'])

const editor = useEditor({
    content: props.modelValue,
    extensions: [StarterKit],

    editorProps: {
        attributes: {
            class: `prose prose-sm sm:prose lg:prose-lg xl:prose-2xl mx-auto focus:outline-none min-h-${props.textareaMinHeight}`,
        },
    },
    onUpdate({ editor }) {
        emit('update:modelValue', editor.getHTML());
    },
})

watch(() => props.modelValue, (newValue) => {
    if (editor && editor.value?.getHTML() !== newValue) {
        editor.value?.commands.setContent(newValue);
    }
});
</script>
