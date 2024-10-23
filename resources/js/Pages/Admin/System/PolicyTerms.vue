<script setup lang="ts">
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Breadcrumb from "@/Pages/Admin/Partials/Breadcrumb.vue";
import {useForm} from "@inertiajs/vue3";
import {notify} from "@/Components/Toastify";
import {ref} from "vue";
import TextEditor from "@/Components/TextEditor.vue";
import Button from "@/Components/Button.vue";


defineOptions({
    layout: DashboardLayout,
});

const props = defineProps<{
    data: SystemPolicy;
}>();

const policyTermsTab = ref('terms');

const form = useForm({
    terms: props.data.policy.terms,
    policy: props.data.policy.policy,
});

const submit = () => {
    form.post(route('admin.system.policy-terms.update'), {
        preserveScroll: true,
        onSuccess: () => {
            notify('success', '서비스 약관 내용이 변경되었습니다.');
        },
    });
};

</script>

<template>

    <div class="px-4 py-6 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-900 dark:border-gray-700">
        <div class="w-full mb-3">
            <Breadcrumb menu-name="시스템 설정" current-location="서비스 약관" />
            <form @submit.prevent="submit">
                <div x-data="{ policyTermsTab: 'terms' }" class="p-3 my-7 bg-white border border-gray-200 rounded-md shadow-sm col-span-full dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px">
                            <li class="me-2">
                                <button
                                    @click.prevent="policyTermsTab = 'terms'"
                                    :class="{
                                        'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500': policyTermsTab === 'terms',
                                        'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300': policyTermsTab !== 'terms'
                                    }"
                                    class="inline-block p-4 border-b-2 rounded-t-lg"
                                >이용약관</button>
                            </li>
                            <li class="me-2">
                                <button
                                    @click.prevent="policyTermsTab = 'policy'"
                                    :class="{
                                        'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500': policyTermsTab === 'policy',
                                        'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300': policyTermsTab !== 'policy'
                                    }"
                                    class="inline-block p-4 border-b-2 rounded-t-lg"
                                >개인정보처리방침</button>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <div v-if="policyTermsTab === 'terms'" class="py-4 rounded-md bg-gray-50 dark:bg-gray-800">
                            <label for="terms" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
                            <TextEditor v-model="form.terms" :textareaMinHeight="80" />
                        </div>
                        <div v-if="policyTermsTab === 'policy'" class="py-4 rounded-md bg-gray-50 dark:bg-gray-800">
                            <label for="policy" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
                            <TextEditor v-model="form.policy" :textareaMinHeight="80" />
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-full text-right pt-8">
                        <Button class="px-5 py-[7px] text-sm font-medium text-center" :color="'blue'" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            서비스 약관 적용하기
                        </Button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
