export interface Board {
    table_id: string;
    table_name: string;
    status: boolean;
    use_category: boolean;
    category_list?: null|string;
    write_level: number
    use_comment: boolean;
    use_rate: boolean;
    use_report: boolean;
    skin?: null|string;
    article_count: number;
    comment_count: number;
}

export interface Write {
    id: bigint;
    created_at: string;
    updated_at: string;
    board_id: bigint;
    categories: string;
    is_notice: boolean;
    subject: string;
    content: string
    hit: number;
    rate_up: number;
    rate_down: number;
    comment_count: number;
    user_id: bigint;
    writer: string;
    has_image: boolean;
    has_video: boolean;
}
