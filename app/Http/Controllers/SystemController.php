<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class SystemController extends Controller
{
    public function basic(Request $request): Response
    {
        $basic = System::where('title', 'basic')->orderByDesc('id')->first();
        $data = json_decode($basic->content);

        return Inertia::render('Admin/System/Basic', [
            'data' => $data,
        ]);
    }

    public function basicUpdate(Request $request): void
    {
        $configData = [
            'basic' => [
                'site_name' => $request->site_name,
                'domain_name' => $request->domain_name,
                'sq_email' => $request->sq_email,
                'use_smtp' => $request->use_smtp ?? '0',
                'use_external_email' => $request->use_external_email ?? '0',
                'use_dormant' => $request->use_dormant ?? '0',
            ],
            'image' => [
                'image_resize' => $request->image_resize,
                'image_width_max' => $request->image_width_max,
            ],
        ];

        System::insert([
            'register_ip' => request()->ip(),
            'register_id' => 'system',
            'title' => 'basic',
            'content' => json_encode($configData),
        ]);

        Cache::forget("config.basic");
    }

    public function external(Request $request): Response
    {
        $external = System::where('title', 'external')->orderByDesc('id')->first();
        $data = json_decode($external->content);

        return Inertia::render('Admin/System/External', [
            'data' => $data,
        ]);
    }

    public function policyTerms(Request $request): Response
    {
        $policyTerms = System::where('title', 'policy')->orderByDesc('id')->first();
        $data = json_decode($policyTerms->content);

        return Inertia::render('Admin/System/PolicyTerms', [
            'data' => $data,
        ]);
    }

    public function updatePolicyTerms(Request $request): void
    {
        $configData = [
            'policy' => [
                'terms' => $request->terms,
                'policy' => $request->policy,
            ],
        ];

        System::insert([
            'register_ip' => request()->ip(),
            'register_id' => 'system',
            'title' => 'policy',
            'content' => json_encode($configData),
        ]);

        Cache::forget("config.policy");
    }
}
