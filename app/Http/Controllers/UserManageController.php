<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserGroup;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class UserManageController extends Controller
{
    public function list(Request $request): Response
    {
        $userList = $this->getUserList($request);
        $userGroupList = $this->getUserGroupList();

        return Inertia::render('Admin/User/UserList', [
            'userList' => $userList,
            'userGroupList' => $userGroupList,
            'request' => $request->all(),
        ]);
    }

    public function getUserList(Request $request)
    {
        if (Auth::user()->group_level == 99) {
            $query = User::with('group')->whereNotIn('group_level', [99]);
        } else {
            $query = User::with('group')->whereNotIn('group_level', [11,99]);
        }
        $query->filter($request->only(['group', 'status', 'searchKind', 'searchString']));

        $pageRows = $request->input('pageRows', 15);
        return $query->orderBy('id', 'desc')->paginate($pageRows)->withQueryString();
    }

    public function getUserGroupList()
    {
        if (Auth::user()->group_level == 99) {
            return UserGroup::where('level', '<', 99)->orderBy('level')->get();
        } else {
            return UserGroup::where('level', '<', 11)->orderBy('level')->get();
        }
    }

    public function changeGroup(Request $request)
    {
        try {
            User::whereIn('id', $request->selectedUsersIds)->update(['group_level' => $request->newGroup]);
        } catch (Exception $e) {
            Debugbar::error('UserManage.changeGroup : ' . $e->getMessage());
        }
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
