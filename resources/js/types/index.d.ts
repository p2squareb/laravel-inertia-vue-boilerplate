export interface User {
    id: number;
    name: string;
    nickname: string;
    email: string;
    email_verified_at?: string;
    status: number;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
};
