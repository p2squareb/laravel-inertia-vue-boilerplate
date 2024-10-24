<script setup lang="ts">
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Breadcrumb from "@/Pages/Admin/Partials/Breadcrumb.vue";
import Selectbox from "@/Components/Selectbox.vue";
import Checkbox from "@/Components/Checkbox.vue";
import ButtonColor from "@/Components/ButtonColor.vue";
import PaginationLinks from "@/Components/PaginationLinks.vue";
import { UserGroup, PaginatedUserList } from "@/types/user";
import { onMounted, ref, watch, computed } from "vue";
import { router } from '@inertiajs/vue3';
import debounce from 'lodash.debounce';
import { useAllCheckboxes } from '@/utils/helper';
import dayjs from "dayjs";
import { notify } from "@/Components/Toastify";


defineOptions({
    layout: DashboardLayout,
});

const props = defineProps<{
    userList: PaginatedUserList;
    userGroupList: UserGroup[];
    request: Record<string, string>;
}>();

const pageRows = ref(props.request.pageRows || props.userList.per_page.toString());
const group = ref(props.request.group || '');
const status = ref(props.request.status || '');
const searchKind = ref(props.request.searchKind || '');
const searchString = ref(props.request.searchString || '');

const updateSearch = () => {
    router.get(route('admin.user.list'), {
        pageRows: pageRows.value,
        group: group.value,
        status: status.value,
        searchKind: searchKind.value,
        searchString: searchString.value,
    }, {
        preserveState: true,
        preserveScroll: true,
    });
};
const debouncedUpdateSearch = debounce(updateSearch, 500);
watch([pageRows, group, status, searchKind], updateSearch);

const newGroup = ref('');
const changeUserGroup = () => {
    if (selectedUsers.value.length === 0 || !newGroup.value) {
        notify('warning', '회원을 선택하고 변경할 그룹을 선택해주세요.');
        return false;
    }
    router.post(route('admin.user.changeGroup'), {
        newGroup: newGroup.value,
        selectedUsersIds: selectedUsers.value,
    }, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            notify('success', '선택한 회원들의 그룹이 변경되었습니다.');
            selectedUsers.value = [];
            newGroup.value = '';
            updateSearch();
        },
        onError: () => {
            notify('error', '그룹 변경에 실패하였습니다.');
        },
    });
};

const prohibitUser = () => {
    console.log('prohibitUser');
};

const { selectedItemIds: selectedUsers, allChecked, toggleAllCheckboxes, toggleCheckbox } = useAllCheckboxes(computed(() => props.userList.data));
</script>

<template>
    <div class="px-4 py-6 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-900 dark:border-gray-700">
        <div class="w-full mb-3">
            <Breadcrumb menu-name="회원 관리" current-location="회원 리스트" />
            <div class="sm:flex justify-between">
                <div class="items-center mr-0 sm:mr-2 mb-3 sm:flex sm:space-x-2 sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <Selectbox 
                                v-model="pageRows" 
                                :options="[{value: '15', name: '15개'}, {value: '30', name: '30개'}, {value: '50', name: '50개'}, {value: '100', name: '100개'}]" 
                            />
                        </div>
                    </div>
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <Selectbox 
                                v-model="group"
                                :placeholder="'그룹명'"
                                :options="userGroupList.map(g => ({ value: g.level.toString(), name: g.name }))"
                            />
                        </div>
                    </div>
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <Selectbox 
                                v-model="status" 
                                :placeholder="'회원상태'"  
                                :options="[{value: '1', name: '정상'}, {value: '2', name: '탈퇴'}, {value: '3', name: '정지'}, {value: '4', name: '휴면'}]" 
                            />
                        </div>
                    </div>
                </div>
                <div class="sm:flex items-center sm:space-x-2">
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <Selectbox 
                                v-model="searchKind" 
                                :options="[{value: '', name: '닉네임+이메일'}, {value: 'nickname', name: '닉네임'}, {value: 'email', name: '이메일'}]"
                            />
                        </div>
                    </div>
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <input 
                                v-model="searchString" 
                                @input="debouncedUpdateSearch"
                                @keyup.enter="updateSearch"
                                type="search" 
                                id="searchString" 
                                class="block p-[7px] w-full md:w-[270px] text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                                placeholder="검색어를 입력해주세요."
                            />
                            <button 
                                type="button" 
                                @click="updateSearch"
                                class="absolute top-0 end-0 px-3 py-[7px] text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700"
                            >
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                                <span class="sr-only">검색</span>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <button type="button" class="inline-flex w-full items-center justify-center px-3 py-[6px] text-sm font-medium text-center text-white rounded-md bg-blue-700 hover:bg-blue-800 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700">
                                <svg class="w-6 h-6 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                회원 등록(미개발)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sm:flex mt-3">
                <div class="sm:flex items-center sm:space-x-2">
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <Selectbox 
                                v-model="newGroup"
                                :placeholder="'변경할 그룹 선택'"
                                :options="userGroupList.map(g => ({ value: g.level.toString(), name: g.name }))"
                            />
                        </div>
                    </div>
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <ButtonColor 
                                @click="changeUserGroup"  
                                class="inline-flex w-full px-3 py-[8px] text-sm font-medium text-center justify-center sm:w-auto" 
                                :color="'indigo'"
                            >그룹 변경</ButtonColor>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center mb-3 md:mb-0 dark:text-gray-700">|</div>
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <ButtonColor 
                                @click="changeUserGroup"  
                                class="inline-flex w-full px-3 py-[8px] text-sm font-medium text-center justify-center sm:w-auto" 
                                :color="'indigo'"
                            >이용정지(미개발)</ButtonColor>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center mb-3 md:mb-0 dark:text-gray-700">|</div>
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <ButtonColor 
                                @click="changeUserGroup"  
                                class="inline-flex w-full px-3 py-[8px] text-sm font-medium text-center justify-center sm:w-auto" 
                                :color="'indigo'"
                            >포인트 지급/차감(미개발)</ButtonColor>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <Checkbox id="checkbox-all" @change="toggleAllCheckboxes" :checked="allChecked" />
                                    </div>
                                </th>
                                <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-white">회원</th>
                                <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-white">그룹</th>
                                <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-white min-w-[100px]">가입유형</th>
                                <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-white min-w-[80px]">포인트</th>
                                <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-white min-w-[100px]">가입일</th>
                                <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-white">상태</th>
                                <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-white">최근 로그인 / 접속 IP</th>
                                <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-white">-</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(user, uidx) in userList.data" :key="uidx" class="hover:bg-gray-100 dark:hover:bg-gray-800">
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <Checkbox :id="`checkbox-${user.id}`" @change="toggleCheckbox(user.id)" :checked="selectedUsers.includes(user.id)" />
                                    </div>
                                </td>
                                <td class="flex items-center p-4 space-x-3 whitespace-nowrap">
                                    <img v-if="user.profile_photo_path" class="w-8 h-8 rounded-full" :src="`/storage/profiles/${user.profile_photo_path}`" :alt="`${user.nickname}의 아바타`">
                                    <svg v-else class="w-8 h-8 text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                    </svg>
                                    <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ user.nickname }}</div>
                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ user.email }}</div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ user.group.name }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ user.social_type }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ user.point }}pt</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ dayjs(user.created_at).format('YYYY.MM.DD') }}</td> 
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex flex-row items-center justify-center">
                                        <div v-if="user.status === 1" class="h-2.5 w-2.5 rounded-full bg-green-400 mr-2"></div>
                                        <div v-else-if="user.status === 2" class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></div>
                                        <div v-else-if="user.status === 3" class="h-2.5 w-2.5 rounded-full bg-orange-400 mr-2"></div>
                                        <div v-else-if="user.status === 4" class="h-2.5 w-2.5 rounded-full bg-neutral-500 mr-2"></div>
                                        {{ user.status === 1 ? '정상' : user.status === 2 ? '탈퇴' : user.status === 3 ? '정지' : user.status === 4 ? '휴면' : '' }} 
                                    </div>
                                </td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ dayjs(user.last_login_at).format('YYYY.MM.DD HH:mm') }}<br>{{ user.login_ip }}
                                </td>
                                <td class="p-4 text-center space-x-2 whitespace-nowrap">
                                    <button type="button" class="inline-flex items-center px-3 py-[7px] text-sm font-semibold text-center text-white rounded-md bg-teal-700 hover:bg-teal-800 dark:bg-teal-600 dark:hover:bg-teal-700">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>상세(미개발)
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <PaginationLinks :paginator="userList" />
    <!-- <x-modal modalId="create-user-modal" maxWidth="xl">
        <livewire:admin.user.user-create/>
    </x-modal>
    <x-modal modalId="prohibit-user-modal" maxWidth="xl">
        <livewire:admin.user.user-prohibit-update :prohibit-selected-user="$selectedRows" :key="rand()"/>
    </x-modal> -->
</template>

