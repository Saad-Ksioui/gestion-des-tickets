<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Statut;
use App\Models\Ticket;
use App\Models\Priorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $statuts = Statut::all();
        $tickets = Ticket::all();
        return view('admin.admin-dashboard', compact('tickets', 'statuts'));
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
    public function listStatuts()
    {
        $statuts = Statut::all();
        return view('admin.Statut Management.list-statuts', compact('statuts'));
    }
    public function storeStatut(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string',
        ]);
        Statut::create(['nom' => $validatedData["nom"]]);
        return redirect()->route('list-statuts')->with("success", "Le statut a été ajouté avec succès");
    }
    public function editStatut($id)
    {
        $statut = Statut::where('id', $id)->first();
        return view('admin.Statut Management.edit-statut', compact('statut'));
    }
    public function updateStatut(Request $request, $id)
    {
        $statut = Statut::where('id', $id);
        $validatedData = $request->validate([
            'nom'=>'required|string'
        ]);
        $statut->update(['nom' => $validatedData['nom']]);
        return redirect()->route('list-statuts')->with("success", "Le statut a été modifié avec succès");
    }
    public function deleteStatut($id)
    {
        $statut = Statut::where('id', $id);
        $statut -> delete();
        return redirect()->back()->with("warning", "Le statut a été supprimé");
    }
    public function listPriorites()
    {
        $priorites = Priorite::all();
        return view('admin.Priorite Management.list-priorites', compact('priorites'));
    }
    public function storePriorite(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string',
        ]);
        Priorite::create(['nom' => $validatedData["nom"]]);
        return redirect()->route('list-priorites')->with("success", "Le priorite a été ajouté avec succès");
    }
    public function editPriorite($id)
    {
        $priorite = Priorite::where('id', $id)->first();
        return view('admin.Priorite Management.edit-priorite', compact('priorite'));
    }
    public function updatePriorite(Request $request, $id)
    {
        $priorite = Priorite::where('id', $id);
        $validatedData = $request->validate([
            'nom'=>'required|string'
        ]);
        $priorite->update(['nom' => $validatedData['nom']]);
        return redirect()->route('list-priorites')->with("success", "Le priorite a été modifié avec succès");
    }
    public function deletePriorite($id)
    {
        $priorite = Priorite::where('id', $id);
        $priorite -> delete();
        return redirect()->back()->with("warning", "Le priorite a été supprimé");
    }
}
