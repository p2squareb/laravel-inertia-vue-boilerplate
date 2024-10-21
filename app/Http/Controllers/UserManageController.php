<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserManageController extends Controller
{
    public function list(Request $request): Response
    {
        return Inertia::render('Admin/User/UserList');
    }

    public function read(Request $request): Response
    {
        return Inertia::render('Admin/User/UserRead');
    }

    public function groupList(Request $request): Response
    {
        return Inertia::render('Admin/User/UserGroupList');
    }

    public function prohibitList(Request $request): Response
    {
        return Inertia::render('Admin/User/UserProhibitList');
    }

    public function dormantList(Request $request): Response
    {
        return Inertia::render('Admin/User/UserDormantList');
    }

    public function withdrawalList(Request $request): Response
    {
        return Inertia::render('Admin/User/UserWithdrawalList');
    }

}
