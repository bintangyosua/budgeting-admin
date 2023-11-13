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
}
