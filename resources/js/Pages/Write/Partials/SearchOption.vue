<script setup lang="ts">
defineProps<{
    board: {
        use_rate: boolean;
        use_comment: boolean;
        use_category: boolean;
    };
    isWrite: boolean;
}>();
</script>

<template>
    <div class="items-center justify-between md:flex">
        <div class="items-center md:flex md:space-x-3 mb-3 lg:mb-0">
            <div class="flex items-center space-x-3">
                <div class="relative w-full">
                    <select id="pageOrder" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block p-[7px] pr-8 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <option value="created_at">최신순</option>
                        <option value="hit">조회순</option>
                        <option v-if="board.use_rate" value="rate">추천순</option>
                        <option v-if="board.use_comment" value="comment">댓글순</option>
                    </select>
                </div>
                <div class="relative w-full">
                    <select id="pagePeriod" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block p-[7px] pr-8 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <option value="all">전체</option>
                        <option value="7">7일</option>
                        <option value="30">30일</option>
                        <option value="3m">3개월</option>
                        <option value="6m">6개월</option>
                        <option value="1y">1년</option>
                    </select>
                </div>
                <div class="relative w-full">
                    <select id="pageRows" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block p-[7px] pr-8 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <option value="15">15개</option>
                        <option value="30">30개</option>
                        <option value="50">50개</option>
                        <option value="100">100개</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="items-center md:flex md:space-x-3">
            <ul class="mt-3 text-sm font-medium text-center text-gray-500 rounded-md shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
                <li class="w-full focus-within:z-10">
                    @if ($category == '')
                    <button class="active rounded-s-md inline-block w-full p-3 text-gray-900 bg-gray-100 border-r border-gray-200 dark:border-gray-700 focus:outline-none dark:bg-gray-700 dark:text-white">전체</button>
                    @else
                    <button class="rounded-s-md inline-block w-full p-3 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-900 dark:hover:bg-gray-700">전체</button>
                    @endif
                </li>
                @foreach($categories as $key => $value)
                <li class="w-full focus-within:z-10">
                    @if ($category === $value)
                    <button class="active @if ($lastCategoryKey === $key) rounded-e-md @endif inline-block w-full p-3 text-gray-900 bg-gray-100 border-r border-gray-200 dark:border-gray-700 rounded-s-md active focus:outline-none dark:bg-gray-700 dark:text-white" aria-current="page">{{ $value }}</button>
                    @else
                    <button class="@if ($lastCategoryKey === $key) rounded-e-md @endif inline-block w-full p-3 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-900 dark:hover:bg-gray-700" aria-current="page">{{ $value }}</button>
                    @endif
                </li>
                @endforeach
            </ul>
            <div class="flex items-center">
                <div class="relative w-full">
                    <input type="search" id="searchString" class="block p-[7px] w-full md:w-[270px] text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="제목+내용 검색"/>
                    <button type="button" class="absolute top-0 end-0 px-3 py-[7px] text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </div>
            <div v-if="isWrite" class="hidden md:flex items-center">
                <div class="relative w-full">
                    <button type="button" class="inline-flex text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-3 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700">
                        <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>글쓰기
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
