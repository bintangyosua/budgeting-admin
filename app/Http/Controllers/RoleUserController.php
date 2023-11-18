<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleUserController extends Controller
{
    public function index()
    {
        return view('role_user', [
            'users' => User::all(),
            'roles' => Role::all()
        ]);
    }

    public function match_role_and_user_id(Request $request)
    {
        $user_id = User::where('id', 'user_id')->first();
        $role_id = Role::where('id', 'role_id')->first();

        $user_id->roles()->attach($role_id->id);
    }
}
