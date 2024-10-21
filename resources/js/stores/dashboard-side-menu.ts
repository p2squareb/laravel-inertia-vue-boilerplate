import { defineStore } from "pinia";

export const useDashboardSideMenuStore = defineStore({
    id: "dashboard-side-menu",
    state: () => ({
        menu: [
            {
                icon: "DashboardIcon",
                pageName: "dashboard",
                title: "대시보드",
                link: "/admin"
            },
            {
                icon: "LayoutIcon",
                pageName: "layouts",
                title: "시스템 설정",
                link: "",
                subMenu: [
                    {
                        icon: "",
                        pageName: "stacked",
                        title: "기본 환경설정",
                        link: "/admin/system/basic",
                    },
                    {
                        icon: "",
                        pageName: "sidebar",
                        title: "서비스 약관",
                        link: "/admin/system/external",
                    },
                    {
                        icon: "",
                        pageName: "sidebar",
                        title: "외부서비스 설정",
                        link: "/admin/system/policy-terms",
                    },
                ],
            },
            {
                icon: "CrudIcon",
                pageName: "crud",
                title: "회원 관리",
                link: "",
                subMenu: [
                    {
                        icon: "",
                        pageName: "products",
                        title: "회원 리스트",
                        link: "/admin/user/list",
                    },
                    {
                        icon: "",
                        pageName: "users",
                        title: "회원 그룹",
                        link: "/admin/user/group-list",
                    },
                    {
                        icon: "",
                        pageName: "users",
                        title: "정지회원 리스트",
                        link: "/admin/user/prohibit-list",
                    },
                    {
                        icon: "",
                        pageName: "users",
                        title: "휴면회원 리스트",
                        link: "/admin/user/dormant-list",
                    },
                    {
                        icon: "",
                        pageName: "users",
                        title: "탈퇴회원 리스트",
                        link: "/admin/user/withdrawal-list",
                    },
                ],
            },
            {
                icon: "SettingIcon",
                pageName: "settings",
                title: "포인트 관리",
                link: "",
                subMenu: [
                    {
                        icon: "",
                        pageName: "profile",
                        title: "포인트 설정",
                        link: "",
                    },
                    {
                        icon: "",
                        pageName: "notification",
                        title: "포인트 내역",
                        link: "",
                    },
                ],
            },
            {
                icon: "PageIcon",
                pageName: "pages",
                title: "게시판 관리",
                link: "",
                subMenu: [
                    {
                        icon: "",
                        pageName: "pricing",
                        title: "게시판 리스트",
                        link: "",
                    },
                    {
                        icon: "",
                        pageName: "mainternance",
                        title: "게시글 관리",
                        link: "",
                    },
                    {
                        icon: "",
                        pageName: "404Error",
                        title: "댓글 관리",
                        link: "",
                    },
                    {
                        icon: "",
                        pageName: "500Error",
                        title: "신고 내역",
                        link: "",
                    },
                ],
            },
            {
                icon: "PageIcon",
                pageName: "pages",
                title: "1:1 문의 관리",
                link: "",
                subMenu: [
                    {
                        icon: "",
                        pageName: "pricing",
                        title: "1:1 문의",
                        link: "",
                    },
                ],
            },
        ]
    }),
});
