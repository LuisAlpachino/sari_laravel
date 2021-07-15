<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function users(Request $request) {

        $users = User::where('status', 'ACTIVO')->orderBy('created_at', 'desc')->paginate(15);
        foreach ($users as $user) {
            $role = $user->getRoleNames();
            $user->role = $role[0];
        }
        return view('layouts.dashboard.users', [
            'users' => $users
        ]);
    }

    public function  view_new(){
        $roles = Role::all();
        return view('layouts.dashboard.user_register_view', [
            'roles' => $roles
        ]);
    }

    public function save(Request $request) {
        // dd($request);

        $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'unique:App\Models\User,email|required|email',
            'password' => 'required|string',
            'status' => 'required|string',
            'phone' => 'required|string',
            'position' => 'required|string',
            'role' => 'required|string'
        ]);

        $user = User::Create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'last_name' => $request->lastname,
            'status' => $request->status,
            'phone' => $request->phone,
            'position' => $request->position,
        ]);

        $user->assignRole($request->role);

        return redirect()->route('users')->with(['message' => 'Usuario guardado con éxito.']);


    }

}
