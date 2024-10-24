<script setup lang="ts">
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import ButtonColor from '@/Components/ButtonColor.vue';
import TextInput from '@/Components/TextInput.vue';
import {router, useForm} from '@inertiajs/vue3';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

defineProps<{
    canResetPassword?: boolean;
    status?: string;
    socialite: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <Head title="로그인" />
    <main>
        <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
            <Link href="/" class="flex items-center justify-center mb-3 font-semibold lg:mb-5 dark:text-white"><ApplicationLogo /></Link>
            <div class="w-full max-w-md p-6 sm:p-8 bg-white rounded-md shadow dark:bg-gray-800">
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="email" value="이메일" class="block mb-2" />
                        <TextInput type="email" id="email" v-model="form.email" class="block w-full p-[7px]" required placeholder="이메일을 입력해주세요." />
                        <InputError :message="form.errors.email" />
                    </div>
                    <div class="mt-5">
                        <InputLabel for="password" value="비밀번호" class="block mb-2" />
                        <TextInput type="password" id="password" v-model="form.password" class="block w-full p-[7px]" required autocomplete="current-password" />
                        <InputError :message="form.errors.password" />
                    </div>
                    <div class="flex items-start mt-5">
                        <div class="flex items-center h-5">
                            <Checkbox id="remember" name="remember" v-model:checked="form.remember" />
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="remember" class="font-medium text-gray-900 dark:text-white">로그인 상태 유지</label>
                        </div>
                        <Link :href="route('password.request')" class="ml-auto text-sm text-blue-700 hover:underline dark:text-blue-500">비밀번호 찾기</Link>
                    </div>
                    <ButtonColor class="w-full mt-5 px-5 py-[7px] text-base font-medium text-center" :color="'blue'" :disabled="form.processing">로그인하기</ButtonColor>
                </form>
                <div v-if="socialite === '1'">
                    <div class="mt-5 text-sm font-medium text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-500 rounded-md py-3 px-4">
                        <label class="block mb-3 text-sm font-bold text-gray-900 dark:text-white">SNS 간편 로그인</label>
                        <div class="flex w-full justify-between">
                            <a href="/signup/naver?next_page=%2F" class="p-2 sm:p-3 rounded" style="background-color: rgb(30, 200, 0);"><img alt="naver" src="/images/icon/naver-logo.png" class="w-7 h-7"></a>
                            <a href="/signup/kakao?next_page=%2F" class="p-2 sm:p-3 rounded" style="background-color: rgb(249, 224, 0);"><img alt="kakao" src="/images/icon/kakao-logo.png" class="w-7 h-7"></a>
                            <a href="/signup/facebook?next_page=%2F" class="p-2 sm:p-3 rounded" style="background-color: rgb(24, 119, 242);"><img alt="facebook" src="/images/icon/facebook-logo.png" class="w-7 h-7"></a>
                            <a href="/signup/google?next_page=%2F" class="p-2 sm:p-3 rounded" style="background-color: rgb(255, 255, 255); border: 1px solid rgb(228, 229, 237);"><img alt="google" src="/images/icon/google-logo.png" class="w-7 h-7"></a>
                            <a href="/signup/apple?next_page=%2F" class="p-2 sm:p-3 rounded" style="background-color: rgb(0, 0, 0);"><img alt="apple" src="/images/icon/apple-logo.png" class="w-7 h-7"></a>
                        </div>
                    </div>
                    <ButtonColor @click="router.visit(route('register'));" class="w-full mt-5 px-5 py-[7px] text-base font-medium text-center" :color="'red'">회원가입</ButtonColor>
                </div>
                <div v-else>
                    <ButtonColor @click="router.visit(route('register'));" class="w-full mt-5 px-5 py-[7px] text-base font-medium text-center" :color="'red'">회원가입</ButtonColor>
                </div>
            </div>
        </div>
    </main>
</template>
