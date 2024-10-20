import { defineStore } from "pinia";

export const useDashboardSideMenuStore = defineStore({
    id: "dashboard-side-menu",
    state: () => ({
        menu: [
            {
                icon: "HomeIcon",
                pageName: "dashboard",
                title: "Dashboard",
                subMenu: [
                    {
                        icon: "",
                        pageName: "dashboard-overview-1",
                        title: "Overview 1",
                    },
                ],
            }
        ]
    }),
});
