<script setup lang="ts" xmlns:wire="http://www.w3.org/1999/xhtml">
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Breadcrumb from "@/Pages/Admin/Partials/Breadcrumb.vue";
import {useForm} from "@inertiajs/vue3";
import {notify} from "@/Components/Toastify";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";

defineOptions({
    layout: DashboardLayout,
});

const props = defineProps<{
    data: SystemExternal;
}>();

const form = useForm({
    use_sns: props.data.socialLogin.use_sns,
    google_client_id: props.data.socialLogin.google.client_id,
});

const submit = () => {
    form.post(route('admin.system.basic.update'), {
        preserveScroll: true,
        onSuccess: () => {
            notify('success', '기본 환경설정이 변경되었습니다.');
        },
    });
};
</script>

<template>
    <div class="px-4 py-6 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-900 dark:border-gray-700">
        <div class="w-full mb-3">
            <Breadcrumb menu-name="시스템 설정" current-location="서비스 약관" />
            <form @submit.prevent="submit">
                <div class="p-3 sm:p-6 my-3 bg-white border border-gray-200 rounded-md shadow-sm col-span-full dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center mb-5">
                        <div class="flex flex-col">
                            <h3 class="text-base font-semibold dark:text-white">간편 로그인 연동 </h3>
                        </div>
                        <label for="use_sns" class="flex cursor-pointer">
                            <Checkbox checked="checked" id="use_sns" v-model="form.use_sns" />
                            <div class="relative w-11 h-6 ml-10 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <InputLabel for="google_client_id" value="구글 Client ID" class="block mb-2" />
                            <TextInput type="text" id="google_client_id" v-model="form.google_client_id" class="block w-full p-[7px]" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">미개발</label>
                            <input type="text" name="last-name" id="last-name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Green" required>
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-full text-right pt-8">
                        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-5 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700">저장</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

