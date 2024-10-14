<script setup lang="ts">
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";

defineOptions({
    layout: AppLayout,
});

defineProps<{
    mustVerifyEmail?: boolean;
    email_verified_at?: string;
    status?: string;
}>();
</script>

<template>
    <Head title="프로필" />
    <main>
        <div class="flex flex-col items-center px-6 pt-8 mx-auto md:h-screen dark:bg-gray-900">

            <UpdateProfileInformationForm
                :must-verify-email="mustVerifyEmail"
                :email_verified_at="email_verified_at"
                :status="status"
                class="max-w-xl"
            />

            <UpdatePasswordForm class="max-w-xl" />

            <DeleteUserForm class="max-w-xl" />

        </div>
    </main>
</template>
