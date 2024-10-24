import { Ref, computed, ref } from 'vue';

/**
 * 체크박스 관련 기능을 제공하는 훅
 * @param items 체크박스 아이템 목록
 * @param idKey 각 아이템의 고유 ID를 나타내는 키 (기본값: 'id')
 * @returns 체크박스 관련 상태와 메서드
 */
export function useAllCheckboxes<T extends { [key: string]: any }>(items: Ref<T[]>, idKey: keyof T = 'id') {
    // 선택된 아이템의 ID를 저장하는 배열
    const selectedItemIds = ref<T[keyof T][]>([]);

    // 모든 아이템이 선택되었는지 확인하는 computed 속성
    const allChecked = computed(() => {
        return selectedItemIds.value.length === items.value.length;
    });

    // 모든 체크박스 선택/해제 토글 함수
    const toggleAllCheckboxes = () => {
        if (allChecked.value) {
            // 모두 선택된 상태면 모두 해제
            selectedItemIds.value = [];
        } else {
            // 모두 선택되지 않은 상태면 모두 선택
            selectedItemIds.value = items.value.map(item => item[idKey]);
        }
    };

    // 개별 체크박스 선택/해제 토글 함수
    const toggleCheckbox = (itemId: T[keyof T]) => {
        const index = selectedItemIds.value.indexOf(itemId);
        if (index > -1) {
            // 이미 선택된 아이템이면 선택 해제
            selectedItemIds.value.splice(index, 1);
        } else {
            // 선택되지 않은 아이템이면 선택
            selectedItemIds.value.push(itemId);
        }
    };

    return {
        selectedItemIds,
        allChecked,
        toggleAllCheckboxes,
        toggleCheckbox
    };
}
