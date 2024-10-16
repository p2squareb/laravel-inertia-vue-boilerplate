<script setup lang="ts">
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
import { switchTheme, getTheme } from "@/theme";
import { ref } from "vue";

// 테마 상태 관리
const currentTheme = ref(getTheme());

// 테마 전환 함수
const toggleTheme = () => {
    switchTheme();
    currentTheme.value = getTheme(); // 테마 상태 업데이트
};
</script>

<template>
    <header class="sticky top-0 z-40 flex-none w-full mx-auto bg-white border-b border-gray-200 dark:border-gray-700 dark:bg-gray-900">
        <div
            id='banner'
            tabIndex='-1'
            class='z-50 flex justify-center w-full px-4 py-3 border border-b border-gray-200 bg-gray-50 dark:border-gray-600 lg:py-4 dark:bg-gray-700'>
            <div class='items-center md:flex'>
                <p class='text-sm font-medium text-gray-900 md:my-0 dark:text-white'>
                    <span class='bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 hidden md:inline'>New</span>
                    We have launched Flowbite Blocks featuring over 450+ website sections!
                    <a href="/blocks/" class='inline-flex items-center ml-2 text-sm font-medium text-blue-600 md:ml-2 dark:text-blue-500 hover:underline'>
                        Check it out
                        <svg class="w-3 h-3 ml-1.5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </p>
            </div>
        </div>
        <div class="flex items-center justify-between w-full px-3 py-3 mx-auto max-w-8xl lg:px-4">
            <div class="flex items-center">
                <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar" class="p-2 mr-2 text-gray-500 rounded cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    <svg id="toggleSidebarMobileClose" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <div class="flex items-center justify-between">
                    <Link href="/" class="flex"><ApplicationLogo /></Link>
                </div>
                <ul id="flowbiteMenu" class="flex-col hidden pt-6 lg:flex-row lg:self-center lg:py-0 lg:flex ml-12">
                    <li class="mb-3 lg:px-2 xl:px-2 lg:mb-0">
                        <Link :href="route('write.list', {tableId: 'test'})" class="text-base font-medium text-gray-900 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500">게시판</Link>
                    </li>
                    <li class="mb-3 lg:px-2 xl:px-2 lg:mb-0">
                        <a href="" class="text-base font-medium text-gray-900 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500">Blocks</a>
                    </li>
                    <li class="mb-3 lg:px-2 xl:px-2 lg:mb-0">
                        <a href="" class="text-base font-medium text-gray-900 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500">Figma</a>
                    </li>
                    <li class="mb-3 lg:px-2 xl:px-2 lg:mb-0">
                        <a href="" class="text-base font-medium text-gray-900 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500">Icons</a>
                    </li>
                    <li class="mb-3 lg:px-2 xl:px-2 lg:mb-0">
                        <a href="" class="text-base font-medium text-gray-900 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500">Blog</a>
                    </li>
                    <li class="hidden mb-3 lg:px-2 xl:px-2 lg:mb-0 xl:block">
                        <a href="" class="text-base font-medium text-gray-900 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500">Pro version</a>
                    </li>
                </ul>
            </div>

            <div class="flex items-center">
                <button type="button" @click="toggleTheme" class="text-gray-500 inline-flex items-center justify-center dark:text-gray-400 hover:bg-gray-100 w-10 h-10 dark:hover:bg-gray-700 focus:outline-none rounded-lg text-sm p-2">
                    <svg v-if="currentTheme === 'dark'" class="w-8 h-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 15a5 5 0 1 0 0-10 5 5 0 0 0 0 10Zm0-11a1 1 0 0 0 1-1V1a1 1 0 0 0-2 0v2a1 1 0 0 0 1 1Zm0 12a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1ZM4.343 5.757a1 1 0 0 0 1.414-1.414L4.343 2.929a1 1 0 0 0-1.414 1.414l1.414 1.414Zm11.314 8.486a1 1 0 0 0-1.414 1.414l1.414 1.414a1 1 0 0 0 1.414-1.414l-1.414-1.414ZM4 10a1 1 0 0 0-1-1H1a1 1 0 0 0 0 2h2a1 1 0 0 0 1-1Zm15-1h-2a1 1 0 1 0 0 2h2a1 1 0 0 0 0-2ZM4.343 14.243l-1.414 1.414a1 1 0 1 0 1.414 1.414l1.414-1.414a1 1 0 0 0-1.414-1.414ZM14.95 6.05a1 1 0 0 0 .707-.293l1.414-1.414a1 1 0 1 0-1.414-1.414l-1.414 1.414a1 1 0 0 0 .707 1.707Z"/>
                    </svg>
                    <svg v-else class="w-8 h-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.8 13.75a1 1 0 0 0-.859-.5A7.488 7.488 0 0 1 10.52 2a1 1 0 0 0 0-.969A1.035 1.035 0 0 0 9.687.5h-.113a9.5 9.5 0 1 0 8.222 14.247 1 1 0 0 0 .004-.997Z"/>
                    </svg>
                </button>

                <a href="https://github.com/p2squareb" target="_blank" data-tooltip-target="tooltip-github-2" class="hidden sm:inline-flex items-center justify-center text-gray-500 w-10 h-10 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg text-sm " >
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd"/>
                    </svg>
                </a>

                <div v-if="$page.props.auth.user" class="flex items-center">
                    <button type="button" data-dropdown-toggle="notification-dropdown" class="relative inline-flex items-center p-2 text-gray-500 rounded-md hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
                        <span class="sr-only">View notifications</span>
                        <svg aria-hidden="true" class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path></svg>

                        <span class="sr-only">Notifications Count</span>
                        <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-1 -end-1 dark:border-gray-900">
                            23
                        </div>
                    </button>
<!--                    <div class="hidden overflow-hidden z-50 my-4 max-w-sm text-base list-none bg-white rounded divide-y divide-gray-100 shadow-lg dark:divide-gray-600 dark:bg-gray-700" id="notification-dropdown">
                        <div>
                            @forelse($notifications as $notification)
                            <div :key="{{ $notification->id }}" class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-800 dark:border-gray-600">
                                <div class="flex-shrink-0">
                                    @if ($notification->user->profile_photo_path)
                                    <img class="w-10 h-10 rounded-full" src="/storage/profiles/{{ $notification->user->profile_photo_path }}" alt="{{ $notification->user->nickname }}'s avatar">
                                    @else
                                    <svg class="w-10 h-10 text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                    </svg>
                                    @endif
                                </div>
                                <div class="pl-3 w-full">
                                    <div wire:click="markAsRead({{ $notification->id }}, 'link', '{{ $notification->refer_url }}')" class="text-gray-700 font-normal text-sm mb-1 dark:text-gray-300 cursor-pointer">
                                        {!! str_replace($notification->send_nickname, '<span class="font-semibold text-gray-900 dark:text-white">' . $notification->send_nickname . '</span>', $notification->message) !!}
                                    </div>
                                    <div class="flex justify-end text-xs font-medium text-blue-700 dark:text-blue-400">
                                        <p>{{ humanReadableDate($notification->created_at, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-800 dark:border-gray-600">
                                <div class="w-full">
                                    <div class="text-gray-500 font-normal text-sm dark:text-gray-400">알림 내역이 없습니다.</div>
                                </div>
                            </div>
                            @endforelse
                        </div>
                        @if (count($notifications) > 0)
                        <div class="flex items-center justify-between py-3 px-6 text-sm font-normal text-center text-gray-900 hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-800">
                            <div wire:click="markAsRead({{ $notification->id }}, 'all_view')" class="inline-flex items-center">
                                <svg aria-hidden="true" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                                전체보기
                            </div>
                            <div wire:click="markAsRead({{ $notification->id }}, 'all_read')" class="inline-flex items-center cursor-pointer">
                                <svg class="mr-2 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="m4 15.6 3.055-3.056A4.913 4.913 0 0 1 7 12.012a5.006 5.006 0 0 1 5-5c.178.009.356.027.532.054l1.744-1.744A8.973 8.973 0 0 0 12 5.012c-5.388 0-10 5.336-10 7A6.49 6.49 0 0 0 4 15.6Z"/>
                                    <path d="m14.7 10.726 4.995-5.007A.998.998 0 0 0 18.99 4a1 1 0 0 0-.71.305l-4.995 5.007a2.98 2.98 0 0 0-.588-.21l-.035-.01a2.981 2.981 0 0 0-3.584 3.583c0 .012.008.022.01.033.05.204.12.402.211.59l-4.995 4.983a1 1 0 1 0 1.414 1.414l4.995-4.983c.189.091.386.162.59.211.011 0 .021.007.033.01a2.982 2.982 0 0 0 3.584-3.584c0-.012-.008-.023-.011-.035a3.05 3.05 0 0 0-.21-.588Z"/>
                                    <path d="m19.821 8.605-2.857 2.857a4.952 4.952 0 0 1-5.514 5.514l-1.785 1.785c.767.166 1.55.25 2.335.251 6.453 0 10-5.258 10-7 0-1.166-1.637-2.874-2.179-3.407Z"/>
                                </svg>
                                모두 읽음
                            </div>
                        </div>
                        @endif
                    </div>-->

                    <Dropdown align="right" width="40" class="mt-1">
                        <template #trigger>
                            <span class="inline-flex rounded-md">
                                <button type="button" class="flex mx-3 text-sm bg-gray-300 dark:bg-gray-800 rounded-full md:mr-0 flex-shrink-0">
                                    <img v-if="$page.props.auth.user.profile_photo_path" class="w-8 h-8 rounded-full" :src="`/storage/profiles/${$page.props.auth.user.profile_photo_path}`" :alt="`${$page.props.auth.user.nickname}'s avatar`">
                                    <svg v-else class="w-8 h-8 text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                    </svg>
                                </button>
                            </span>
                        </template>
                        <template #content>
                            <DropdownLink :href="route('profile.edit')">
                                <svg class="w-5 h-5 text-gray-800 dark:text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M10 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h2m10 1a3 3 0 0 1-3 3m3-3a3 3 0 0 0-3-3m3 3h1m-4 3a3 3 0 0 1-3-3m3 3v1m-3-4a3 3 0 0 1 3-3m-3 3h-1m4-3v-1m-2.121 1.879-.707-.707m5.656 5.656-.707-.707m-4.242 0-.707.707m5.656-5.656-.707.707M12 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                                <span class="dark:text-gray-100">프로필 설정</span>
                            </DropdownLink>
                            <DropdownLink :href="route('mypage.overview')">
                                <svg class="w-5 h-5 mr-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M5.024 3.783A1 1 0 0 1 6 3h12a1 1 0 0 1 .976.783L20.802 12h-4.244a1.99 1.99 0 0 0-1.824 1.205 2.978 2.978 0 0 1-5.468 0A1.991 1.991 0 0 0 7.442 12H3.198l1.826-8.217ZM3 14v5a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-5h-4.43a4.978 4.978 0 0 1-9.14 0H3Zm5-7a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm0 2a1 1 0 0 0 0 2h8a1 1 0 1 0 0-2H8Z" clip-rule="evenodd"/>
                                </svg>
                                <span class="dark:text-gray-100">마이페이지</span>
                            </DropdownLink>
                            <DropdownLink v-if="$page.props.auth.user.group_level > 10" :href="route('admin.dashboard')">
                                <svg class="w-5 h-5 mr-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5Zm16 14a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2ZM4 13a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6Zm16-2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v6Z"/>
                                </svg>
                                <span class="dark:text-gray-100">관리자 페이지</span>
                            </DropdownLink>
                            <DropdownLink :href="route('logout')" method="post" as="button">
                                <svg class="w-5 h-5 text-gray-800 dark:text-white mr-1 rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v9m-5 0H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2M8 9l4-5 4 5m1 8h.01"/>
                                </svg>
                                <span class="dark:text-gray-100">로그아웃</span>
                            </DropdownLink>
                        </template>
                    </Dropdown>
<!--
                    <div class="hidden z-50 my-4 w-52 list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" id="userMenuDropdown">
                        <div class="py-3 px-4">
                            <span class="block text-sm font-semibold text-gray-900 dark:text-white">{{ auth()->user()->nickname }}</span>
                            <span class="block text-sm font-light text-gray-700 truncate dark:text-gray-300">{{ auth()->user()->email }}</span>
                        </div>
                        <ul class="py-1 font-light" aria-labelledby="userMenuDropdownButton">
                            <li>
                                <a href="{{ route('profile.show') }}" class="flex py-2 px-4 text-sm font-semibold text-gray-800 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white">
                                    <svg class="w-5 h-5 text-gray-800 dark:text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M10 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h2m10 1a3 3 0 0 1-3 3m3-3a3 3 0 0 0-3-3m3 3h1m-4 3a3 3 0 0 1-3-3m3 3v1m-3-4a3 3 0 0 1 3-3m-3 3h-1m4-3v-1m-2.121 1.879-.707-.707m5.656 5.656-.707-.707m-4.242 0-.707.707m5.656-5.656-.707.707M12 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    </svg>
                                    <span class="dark:text-gray-100">프로필 설정</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('mypage.overview') }}" class="flex py-2 px-4 text-sm font-semibold text-gray-800 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white">
                                    <svg class="w-5 h-5 mr-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M5.024 3.783A1 1 0 0 1 6 3h12a1 1 0 0 1 .976.783L20.802 12h-4.244a1.99 1.99 0 0 0-1.824 1.205 2.978 2.978 0 0 1-5.468 0A1.991 1.991 0 0 0 7.442 12H3.198l1.826-8.217ZM3 14v5a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-5h-4.43a4.978 4.978 0 0 1-9.14 0H3Zm5-7a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm0 2a1 1 0 0 0 0 2h8a1 1 0 1 0 0-2H8Z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="dark:text-gray-100">마이페이지</span>
                                </a>
                            </li>
                            @if (auth()->user()->group_level >= 11)
                            <li>
                                <a href="{{ route('admin.dashboard') }}" class="flex py-2 px-4 text-sm font-semibold text-gray-800 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white">
                                    <svg class="w-5 h-5 mr-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5Zm16 14a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2ZM4 13a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6Zm16-2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v6Z"/>
                                    </svg>
                                    <span class="dark:text-gray-100">관리자 페이지</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                        <ul class="py-1 font-light text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <a href="{{ route('logout') }}" @click.prevent="$root.submit();" class="flex items-center py-2 px-4 text-sm font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white">
                                        <svg class="w-5 h-5 text-gray-800 dark:text-white mr-1 rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v9m-5 0H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2M8 9l4-5 4 5m1 8h.01"/>
                                        </svg>
                                        <span class="dark:text-gray-100">로그아웃</span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>-->
<!--                    <Link :href="route('logout')" method="post" as="button" class="flex items-center py-2 px-4 text-sm font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white">
                        <svg class="w-5 h-5 text-gray-800 dark:text-white mr-1 rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v9m-5 0H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2M8 9l4-5 4 5m1 8h.01"/>
                        </svg>
                        <span class="dark:text-gray-100">로그아웃</span>
                    </Link>-->
                </div>
                <div v-else class="flex items-center">
                    <Link :href="route('login')" class="p-2 text-gray-500 rounded-md hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="24px" height="24px" viewBox="0 0 512 512" preserveAspectRatio="xMidYMid meet">
                            <g transform="translate(0,512) scale(0.1,-0.1)" fill="currentColor" stroke="none">
                                <path d="M2380 4943 c-511 -45 -921 -413 -1016 -910 -20 -106 -22 -290 -4 -393 80 -465 439 -828 906 -916 119 -22 355 -15 464 14 245 65 450 195 597 377 111 138 179 272 225 443 29 111 36 346 14 466 -75 398 -346 718 -724 856 -129 47 -333 75 -462 63z"/>
                                <path d="M3636 2715 c-134 -37 -295 -157 -316 -236 -28 -103 47 -199 155 -199 53 0 89 16 125 55 14 15 48 38 75 51 49 23 58 24 310 24 290 0 307 -4 374 -71 75 -74 71 -24 71 -885 l0 -772 -28 -53 c-36 -69 -95 -114 -167 -129 -36 -8 -136 -10 -283 -8 -252 4 -271 8 -343 72 -59 54 -95 69 -151 64 -122 -12 -183 -144 -115 -247 32 -48 130 -124 202 -156 102 -45 144 -50 445 -50 267 0 290 1 355 22 194 62 341 215 390 408 22 88 22 1598 0 1694 -47 200 -216 369 -416 416 -86 20 -609 20 -683 0z"/>
                                <path d="M2055 2224 c-496 -50 -1016 -203 -1438 -421 -122 -64 -174 -112 -215 -201 l-27 -57 0 -475 c0 -474 0 -475 23 -532 46 -113 159 -205 281 -228 46 -8 2341 -16 2341 -7 0 1 -7 36 -16 77 -15 75 -12 166 7 218 7 19 0 31 -55 85 -69 67 -119 155 -137 236 l-10 49 -177 5 c-239 7 -317 33 -427 142 -207 204 -187 540 42 716 107 82 148 93 371 97 150 3 192 6 192 17 0 37 45 150 81 205 23 33 40 63 38 64 -2 2 -64 9 -138 15 -176 15 -573 12 -736 -5z"/>
                                <path d="M3225 2026 c-56 -25 -88 -70 -93 -129 -6 -70 7 -93 107 -192 45 -44 81 -83 81 -87 0 -5 -186 -8 -414 -8 -412 0 -413 0 -446 -22 -50 -34 -72 -71 -77 -125 -5 -59 25 -117 77 -147 33 -20 54 -21 448 -26 l413 -5 -81 -80 c-96 -94 -110 -118 -110 -182 0 -88 68 -153 160 -153 22 0 53 6 68 14 32 18 485 472 501 503 16 31 14 109 -3 141 -21 39 -465 477 -503 496 -39 19 -87 20 -128 2z"/>
                            </g>
                        </svg>
                    </Link>
                </div>
            </div>
        </div>
    </header>
</template>
