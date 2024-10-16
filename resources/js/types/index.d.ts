export interface User {
    id: number;
    name: string;
    nickname: string;
    email: string;
    email_verified_at?: string;
    status: number;
    profile_photo_path?: string;
    created_at: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
};
