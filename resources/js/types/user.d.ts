export interface UserGroup {
    id: number;
    name: string;
    level: number;
    comment: string;
}

export interface User {
    id: number;
    status: number;
    name: string;
    nickname: string;
    email: string;
    email_verified_at?: string;
    group_level: number;
    group: UserGroup;
    point: number;
    social_type: string;
    last_login_at?: string;
    login_ip?: string;
    leaved_at?: string;
    profile_photo_path?: string | null;
    created_at: string;
    //user_group: UserGroup;
}

export interface PaginatedUserList {
    current_page: number;
    data: User[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: {
        active: boolean;
        label: string;
        url: string;
    }[];
    next_page_url: string;
    path: string;
    per_page: number;
    prev_page_url: string;
    to: number;
    total: number;
}
