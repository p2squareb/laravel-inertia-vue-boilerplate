<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SystemController extends Controller
{
    public function basic(Request $request): Response
    {
        return Inertia::render('Admin/System/Basic');
    }
}
