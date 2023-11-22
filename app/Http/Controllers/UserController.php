<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            "title" => "Users",
            "users" => User::all()
        ]);
    }

    public function edit(User $user, Role $role)
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => $role->all()->sortBy("user_id")
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        // User::where('id', $request->id)->update($validatedData);
        // $user->update($validatedData);

        // $user->roles()->sync($this->mapIngredients($validatedData['checked_roles']));
        // $user->roles()->sync($this->);

        $user->roles()->sync($request->input('checked_roles', []));

        return redirect('/users');
    }
}
