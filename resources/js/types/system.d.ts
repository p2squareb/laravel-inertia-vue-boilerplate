interface SystemBasic {
    basic: {
        domain_name: string;
        site_name: string;
        sq_email: string;
        use_dormant: string;
        use_external_email: string;
        use_smtp: string;
    },
    image: {
        image_resize: string;
        image_width_max: string;
    }
}

interface SystemExternal {
    socialLogin: {
        use_sns: string;
        google: {
            client_id: string;
        };
    }
}

interface SystemPolicy {
    policy: {
        terms: string;
        policy: string;
    }
}
