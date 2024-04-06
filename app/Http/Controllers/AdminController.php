<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $tickets = Ticket::all();
        return view('admin.admin-dashboard', compact('tickets'));
    }
    public function createUser()
    {
        $roles = Role::all();
        return view('admin.User Management.create-user', compact('roles'));
    }
    public function storeUser(Request $request)
    {
        $validatedData = $request->validate([
            'nom_complet' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|integer',
        ]);

        User::create([
            'nom_complet' => $validatedData['nom_complet'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => $validatedData['role_id'],
        ]);
        return back()->with('success', 'Vous avez bien créé un compte');
    }
    public function listUsers()
    {
        $currentUserId = Auth::id();
        $users = User::where('id', '!=', $currentUserId)->get();
        return view('admin.User Management.list-users', compact('users'));
    }
}
